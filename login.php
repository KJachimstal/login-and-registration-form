<?php
    require_once "connection.php";
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error number: ".$connection->connect_errno;
    }
?>