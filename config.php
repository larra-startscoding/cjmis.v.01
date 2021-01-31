<?php
    $connection=mysqli_connect('localhost','root','','cj_database');

    //check connection
    if(mysqli_connect_errno()){
        echo "Database connection failed: " . mysqli_connect_error();
    }
?>