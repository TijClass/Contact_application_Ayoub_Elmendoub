<?php

 $crud = require_once "../core/init.php";

    if ( isset($_POST["submit"]) ){
        $userId = $crud->authUser();
        if( $userId )
        {
            $_SESSION["userId"] = $userId;
            header("location:index.php");
            die();
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>kkk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header class="d-xl-flex py-3" style="background: linear-gradient(73deg, #094c71, #0e5691 100%);">
        <div class="container">
            <div class="row">
                <div class="col col-2">
                    <h1>logo</h1>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </header>
    <main>
        <section>
            <h1 class="text-center my-4 pt-4">Welcome Title</h1>
            <div class="container" style="padding-top: 6rem;">
                <div class="row">
                    <div class="col col-6" style="border-right-style: solid;">
                        <h2 class="mb-4">Welcome sub</h2>
                        <p class="text-left" style="width: 449px;"><br><strong>Lorem Ipsum</strong> is simplys dummy text of the printing atypesetting industry.s sLorem Ipsum has been the industry's standard usmmyext ever since the 1500s, when an unknown psrinter took a galley of tpe and scramssbled
                            it to msake a type specimen book. It h survisvesd not onlsy five centuries, but also the leap intoselecstronic tsypesetting, remaining essentially unschangsed. Its was popularised in the 1960s with thsereleases ofs Letraset
                            sheets containing Lorems Ispsumsagessss, and more recently withdesktop pg ssoftware like Aldus eMaker including versions of Lo
                            <br></p>
                            <a class="btn btn-light mt-2" role="button" href="#"><i class="fa fa-chevron-left"></i>&nbsp; Read more</a></div>
                    <div
                        class="col col-5" style="margin-left: 80px;">
                        <h2 class="mb-5">Login</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group d-flex align-items-xl-end mb-3">
                                <label class="w-25">&nbsp; &nbsp; &nbsp; &nbsp;Email :</label>
                                <input class="form-control w-75" type="text" name="username">
                            </div>
                            <div class="form-group d-flex align-items-xl-end mb-4"> 
                                <label class="w-25">Password :</label>
                                <input class="form-control w-75" type="password" name="password">
                            </div>
                            <div class="form-group d-flex justify-content-xl-center align-items-center">
                                <input class="btn btn-primary mr-3" name="submit" type="submit" value="Login">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <h4 class="text-danger text-center"><?php foreach ($crud->error as $err){echo $err;} ?></h4>
                        </form>

                </div>
            </div>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>