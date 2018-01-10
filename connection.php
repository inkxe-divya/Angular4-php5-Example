<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-type");

    
    $host = "localhost";
    $user = "root"; 
    $password = "riaxecom"; 
    $dbname = "mysql";

    $con = mysqli_connect($host, $user, $password,$dbname);

    if (!$con)
        {
    die("Connection failed: " . mysqli_connect_error());
        }
    
     
?>