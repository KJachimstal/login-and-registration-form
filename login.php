<?php
    session_start();

    if(!isset($_POST['login']) && !isset($_POST['password']))
    {
        header('Location:index.php');
        exit();
    }

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

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if($result = $connection->query(sprintf("SELECT * FROM users WHERE login='%s'",
        mysqli_real_escape_string($connection, $login))))
        {
            $user_count = $result->num_rows;
            if($user_count > 0)
            {
                $row = $result->fetch_assoc();

                if(password_verify($password, $row['password']))
                {
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    
                    unset($_SESSION['error']);
                    $result->close();
                    header('Location:account.php');
                }
                else
                {
                    $_SESSION['error'] = '<br/><font color="red">Wrong login or password!</font>';
                    header('Location:index.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<br/><font color="red">Wrong login or password!</font>';
                header('Location:index.php');
            }
        }

        $connection->close();
    }
?>