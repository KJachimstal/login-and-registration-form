<?php
    session_start();

    if((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true))
    {
        header('Location:account.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogAndRegistration</title>
</head>
<body>
    <h1>Wellcome to login and registration form!</h1>
    <h2>Please log in or sing up ;)</h2>
    
    <a href="registration.php">Sign in</a>

    <br/><br/>

    <form action="login.php" method="post">
        Login: <br/> <input type="text" name="login" /><br/>
        Password: <br/> <input type="password" name="password" /><br/><br/>
        <input type="submit" value="Login" />
    </form>

    <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
    ?>

</body>
</html>