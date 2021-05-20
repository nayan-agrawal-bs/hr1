<?php 

    $servername='localhost';
    $username='root';
    $password='Bigstep@123';
    $database='emp';

    $conn=new mysqli($servername,$username,$password,$database);


    if ($conn->connect_error){
        die('connetcion failed: '. $conn->connect_error);
    }
    mysqli_autocommit($conn,FALSE);
?>