<?php
session_start();
require_once "../config/config.php";
$error = array();

try {
    $conn = new PDO("mysql:host=".host.";dbname=".database, dbUserName, dbUserPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    $error[0] = "Sorry we can't connect to the database right now";
    exit();
}

    require_once "crud.php";
    return new crud($conn,$error);

?>