<?php 

$crud = require_once "../core/init.php";

    if (isset($_GET["userId"])) {
        $userId = $_GET["userId"];
        session_destroy();
        if( isset($_COOKIE[$userId]) )$crud->clearCookie();
        header("location:login.php");
        die();
    }

?>