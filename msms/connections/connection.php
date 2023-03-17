<?php

Function connection(){

    $host = "localhost";
    $username = "root";
    $password = '072419';#"072419";
    $database = "kpsinsurance_system";
    
    $con =new mysqli($host,$username,$password,$database);

    if($con->connect_error){
            echo $con->connect_error;
    }else{

        return $con;
    }
}

function pdo_con(){
    $servername = "localhost";
    $username = "root";
    $password = '072419';
    $dbname = "kpsinsurance_system";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname",$username,$password);
    return $conn;
}