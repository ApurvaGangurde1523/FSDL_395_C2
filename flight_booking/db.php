<?php

$host = "localhost";
$user = "root";
$password = "ag44";
$database = "flight_db";

$conn = new mysqli($host,$user,$password,$database);

if($conn->connect_error)
{
    die("Connection Failed: ".$conn->connect_error);
}

?>