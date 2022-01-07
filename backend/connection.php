<?php
    $servername = "localhost";
    $username = "root";
    $server_password = "";
    $databse = "project_SignUp";

    $conn = mysqli_connect($servername, $username, $server_password, $databse);
    if (!$conn)
    {
        die("Unable to connect". mysqli_connect_error());
    } 
?>