<?php
    session_start();
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
            $user_count = $result->num_rows;
            if($user_count > 0)
            {
                $row = $result->fetch_assoc();
                $_SESSION['email'] = $row['email'];
                $_SESSION['login'] = $row['login'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                
                $result->close();
            }
            else
            {
                
            }
        }

        $connection->close();
    }
?>