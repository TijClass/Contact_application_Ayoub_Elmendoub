<?php 

class crud
{

    private PDO $conn;
    public array $error;

    public function __construct(PDO $conn, array $error)
    {
        $this->conn = $conn;
        $this->error = $error;
    }
    // Used only for adding admin to test the authentication system
    function addAdmin(){
        $pass = password_hash("admin",PASSWORD_DEFAULT);
        $username = "admin";
        $stmt = $this->conn->prepare( "INSERT users (username,password) VALUES(?,?)");
        $stmt->bindParam(1,$username,PDO::PARAM_STR);
        $stmt->bindParam(2,$pass,PDO::PARAM_STR);
        $stmt->execute();
    }

    public function generateString($len)
    {
        return bin2hex(random_bytes($len));
    }

    function rememberMe($userId)
    {
        $token = $this->generateString(32);
        $tokenHash = password_hash($token, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare( "INSERT rm (userId,token) VALUES(?,?)");
        $stmt->bindParam(1,$userId,PDO::PARAM_INT);
        $stmt->bindParam(2,$tokenHash,PDO::PARAM_STR);
        $stmt->execute();

        $token .= "___".$userId;

        $expTime = new DateTime("+ 1 week");
        setcookie("omma_rm",$token, $expTime->getTimestamp());
    }

    function checkCookie()
    {
        if ( isset($_COOKIE["omma_rm"]) )
        {
            $cookie = explode("___",$_COOKIE["omma_rm"]);
            $stmt = $this->conn->prepare("SELECT userId,token FROM rm WHERE userId = ?");
            $stmt->bindParam(1, $cookie[1], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($cookie[0],$result["token"]))
            {
                $_SESSION["userId"] = $result["userId"];
            }
            else return 0;
        }
        return 0;
    }

    function clearCookie()
    {
        $stmt = $this->conn->prepare("DELETE FROM rm WHERE userId = ?");
        $stmt->bindParam(1, $_GET["userId"], PDO::PARAM_STR);
        $stmt->execute();
    }

    function authUser()
    {
        $stmt = $this->conn->prepare("SELECT userId,password FROM users WHERE username = ?");
        $stmt->bindParam(1, $_POST["username"], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( empty($result) ) $this->error[] = "not registered";
        else{

            if( password_verify($_POST["password"], $result["password"]) )
            {
                if ( isset($_POST["remember"]) ) $this->rememberMe($result["userId"]);
                return $result["userId"];
            }
            else $this->error[] = "Wrong password";
        }
        return false;
    }

    function fetchAllPersons()
    {
        $query = "SELECT * FROM test";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if( $stmt->rowCount() > 0)
        {
            return json_encode($result);
        }
        else return "Data was not inserted please try again";
    }

    function fetchPerson()
    {
		$stmt = $this->conn->prepare( " SELECT * FROM test WHERE id = ?");
        $stmt->bindParam(1, $_POST["id"], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt->rowCount()) {
            return json_encode($result);
        }
        else return "Data was not inserted please try again";
    }
    
    function addPerson()
    {
   
            $stmt = $this->conn->prepare(" INSERT INTO `test`(`fname`, `lname`, `email`, `address`, `phone`, `group`) VALUES (?,?,?,?,?,?)" );
            $stmt->bindParam(1, $_POST["fname"], PDO::PARAM_STR);
            $stmt->bindParam(2, $_POST["lname"], PDO::PARAM_STR);
            $stmt->bindParam(3, $_POST["email"], PDO::PARAM_STR);
            $stmt->bindParam(4, $_POST["address"], PDO::PARAM_STR);
            $stmt->bindParam(5, $_POST["phone"], PDO::PARAM_STR);
            $stmt->bindParam(6, $_POST["group"], PDO::PARAM_STR);
    
            if( $stmt->execute() )
            {
                return "Data was inserted successfully";
            }
            
    }

    function updatePerson()
    {
		$stmt = $this->conn->prepare(" UPDATE `test` SET `fname`= ?,`lname`= ?,`email`= ?,`address`= ?,`phone`= ?,`group`= ? WHERE id = ? ");
        $stmt->bindParam(1, $_POST["fname"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST["lname"], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST["email"], PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST["address"], PDO::PARAM_STR);
        $stmt->bindParam(5, $_POST["phone"], PDO::PARAM_STR);
        $stmt->bindParam(6, $_POST["group"], PDO::PARAM_STR);
        $stmt->bindParam(7, $_POST["id"], PDO::PARAM_INT);

        if( $stmt->execute() )
        {
            return "Update was successfully";
        }
        else return "we can't update this person info right now please try again";
    }

    function deletePerson()
    {
		$stmt = $this->conn->prepare(" DELETE FROM test WHERE id = ? ");
        $stmt->bindParam(1, $_POST["id"], PDO::PARAM_INT);

        if( $stmt->execute() )
        {
            return "this person was deleted successfully";
        }
        else return "we can't delete this person right now please try again";
    }

}