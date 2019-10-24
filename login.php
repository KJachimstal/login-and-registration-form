<?php
    require_once "connection.php";
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error number: ".$connection->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE login='$login' and password='$password'";
        if($result = $connection->query($query))
        {
            $user_count = $result->fetch_assoc();
            if($user_count > 0)
            {
                
            }
            else
            {
                
            }
        }

        $connection->close();
    }
?>