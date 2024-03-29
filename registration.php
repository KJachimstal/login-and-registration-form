<?php
    session_start();

    if(isset($_POST['email']))
    {
        $verification = true;

        //Email verification
        $email = $_POST['email'];
        $filtered_email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($filtered_email, FILTER_VALIDATE_EMAIL) == false) || ($filtered_email != $email))
        {
            $verification = false;
            $_SESSION['err_email'] = "Please enter a valid mail!";
        } 

        //Login verification
        $login = $_POST['login'];

        if(strlen($login) < 3 || strlen($login) > 20)
        {
            $verification = false;
            $_SESSION['err_login'] = "Login must be between 3 and 20 characters!";
        }

        if(ctype_alnum($login) == false)
        {
            $verification = false;
            $_SESSION['err_login'] = "Login must contain only letters and numbers!";
        }

        //Password verification
        $password = $_POST['password'];
        $password_r = $_POST['password_r'];

        if(strlen($password) < 8 || strlen($password) > 20)
        {
            $verification = false;
            $_SESSION['err_password'] = "Password must be between 8 and 20 characters!";
        }

        if($password != $password_r)
        {
            $verification = false;
            $_SESSION['err_password'] = "Passwords do not match!";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Name verification
        $name = $_POST['name'];

        if(strlen($name) < 3 || strlen($name) > 20)
        {
            $verification = false;
            $_SESSION['err_name'] = "Name must be between 3 and 20 characters!";
        }

        //Surname verification
        $surname = $_POST['surname'];

        if(strlen($surname) < 3 || strlen($surname) > 20)
        {
            $verification = false;
            $_SESSION['err_surname'] = "Surname must be between 3 and 20 characters!";
        }

        //Checkbox verification
        if(!isset($_POST['reg']))
        {
            $verification = false;
            $_SESSION['err_reg'] = "You have to accept the regulations!";
        }

        //CAPTCHA verification
        $captcha = "6LeKZr8UAAAAABx4OMRa0yT8n9cgOzR_J2o5IpTE";

        $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$captcha.'&response='.$_POST['g-recaptcha-response']);
        $answer = json_decode($check);

        if($answer->success == false)
        {
            $verification = false;
            $_SESSION['err_captcha'] = "You have to confirm you are not a robot!";
        }

        //Remember form values
        $_SESSION['f_email'] = $email;
        $_SESSION['f_login'] = $login;
        $_SESSION['f_password'] = $password;
        $_SESSION['f_password_r'] = $password_r;
        $_SESSION['f_name'] = $name;
        $_SESSION['f_surname'] = $surname;

        if(isset($_POST['reg']))
        {
            $_SESSION['f_checkbox'] = true;
        }

        //Checking for duplicate users
        require_once "connection.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($connection->connect_errno!=0)
            {
                throw new Exception();
            }
            else
            {
                $result = $connection->query("SELECT * FROM users WHERE login='$login'");

                if(!$result)
                {
                    throw new Exception($connection->error);
                }

                $user_count = $result->num_rows;
                if($user_count > 0)
                {
                    $verification = false;
                    $_SESSION['err_login'] = "This login already exists!";
                }


                $result = $connection->query("SELECT * FROM users WHERE email='$email'");

                if(!$result)
                {
                    throw new Exception($connection->error);
                }

                $user_count = $result->num_rows;
                if($user_count > 0)
                {
                    $verification = false;
                    $_SESSION['err_email'] = "This email already exists!";
                }

                if($verification == true)
                {
                    if($connection->query("INSERT INTO users VALUES (NULL, '$email', '$login', '$hashed_password', '$name', '$surname')"))
                    {
                        $_SESSION['success_registration'];
                        header('Location: wellcome.php');
                    } 
                    else
                    {
                        throw new Exception($connection->error);
                    }
                }

                $connection->close();
            }
        }
        catch(Exception $connect_exception)
        {
            echo '<span style="color:red">Database connection error!</span>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .error
        {
            color:red;
            margin:10px 0px 10px 0px;
        }
    </style>
</head>
<body>
    
    <form method="post">
        E-mail: <br/> <input type="text" name="email" value="<?php
            if(isset($_SESSION['f_email']))
            {
                echo $_SESSION['f_email'];
            }
        ?>" /><br/>

        <?php
            if(isset($_SESSION['err_email']))
            {
                ECHO '<div class="error">'.$_SESSION['err_email'].'</div>';
                unset($_SESSION['err_email']);
            }
        ?>
        
        Login: <br/> <input type="text" name="login" value="<?php
            if(isset($_SESSION['f_login']))
            {
                echo $_SESSION['f_login'];
            }
        ?>" /><br/>

        <?php
            if(isset($_SESSION['err_login']))
            {
                ECHO '<div class="error">'.$_SESSION['err_login'].'</div>';
                unset($_SESSION['err_login']);
            }
        ?>

        Password: <br/> <input type="password" name="password" value="<?php
            if(isset($_SESSION['f_password']))
            {
                echo $_SESSION['f_password'];
            }
        ?>" /><br/>

        <?php
            if(isset($_SESSION['err_password']))
            {
                ECHO '<div class="error">'.$_SESSION['err_password'].'</div>';
                unset($_SESSION['err_password']);
            }
        ?>

        Repeat password: <br/> <input type="password" name="password_r" value="<?php
            if(isset($_SESSION['f_password_r']))
            {
                echo $_SESSION['f_password_r'];
            }
        ?>" /><br/>
        Name: <br/> <input type="text" name="name" value="<?php
            if(isset($_SESSION['f_name']))
            {
                echo $_SESSION['f_name'];
            }
        ?>" /><br/>

        <?php
            if(isset($_SESSION['err_name']))
            {
                ECHO '<div class="error">'.$_SESSION['err_name'].'</div>';
                unset($_SESSION['err_name']);
            }
        ?>

        Surname: <br/> <input type="text" name="surname" value="<?php
            if(isset($_SESSION['f_surname']))
            {
                echo $_SESSION['f_surname'];
            }
        ?>" /><br/>

        <?php
            if(isset($_SESSION['err_surname']))
            {
                ECHO '<div class="error">'.$_SESSION['err_surname'].'</div>';
                unset($_SESSION['err_surname']);
            }
        ?>

        <label><input type="checkbox" name="reg" <?php
            if(isset($_SESSION['f_checkbox']))
            {
                echo "checked";
            }
        ?>>Accept the regulations</label>

        <?php
            if(isset($_SESSION['err_reg']))
            {
                ECHO '<div class="error">'.$_SESSION['err_reg'].'</div>';
                unset($_SESSION['err_reg']);
            }
        ?>

        <div class="g-recaptcha" data-sitekey="6LeKZr8UAAAAAKtSJvJmWXBmuIX0Lh4INs_8RG0I"></div>

        <?php
            if(isset($_SESSION['err_captcha']))
            {
                ECHO '<div class="error">'.$_SESSION['err_captcha'].'</div>';
                unset($_SESSION['err_captcha']);
            }
        ?>

        <input type="submit" value="Send" />
    </form>

</body>
</html>