<?php

$crud = require_once "../core/init.php";

if (!isset($_SESSION["userId"]) &&  !$crud->checkCookie()) {
    die();
}

if( $_SERVER["REQUEST_METHOD"] == "POST" )
{
   switch($_POST["action"])
   {
       case "fetchAllPerson":
            echo $crud->fetchAllPersons();
            break;

        case "insert":
            echo $crud->addPerson();
            break;

        case "fetchPerson":
            echo $crud->fetchPerson();
            break;

        case "delete":
            echo $crud->deletePerson();
            break;
            
        case "update":
            echo $crud->updatePerson();
            break;
    }
    
}
