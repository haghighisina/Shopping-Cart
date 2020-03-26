<?php

function CreateDB()
{
    $server = "127.0.0.1";
    $user   = "root";
    $pass   = "";
    $db     = "product";

    $con = mysqli_connect($server, $user, $pass);


    if (!$con){
        die("Connection was Failed". mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $db";

    if (mysqli_query($con, $sql)){
        $GLOBALS['con'] = $con    = mysqli_connect($server, $user, $pass, $db);

        $sql = "
            CREATE TABLE IF NOT EXISTS stuff(
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Pname varchar(25) NOT NULL,
            Image VARCHAR(100),
            Price FLOAT 
            );
        ";

        if (mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Something went wrong";
        }

    }else{
        echo "Something went Wrong". mysqli_error($con);
    }
}
