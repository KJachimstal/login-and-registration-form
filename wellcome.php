<?php
    session_start();

    if(isset($_SESSION['success_registration']))
    {
        header('Location:index.php');
        exit();
    }
    else
    {
        unset($_SESSION['success_registration']);
    }

    if(isset($_SESSION['f_email'])) unset($_SESSION['f_email']);
    if(isset($_SESSION['f_login'])) unset($_SESSION['f_login']);
    if(isset($_SESSION['f_password'])) unset($_SESSION['f_password']);
    if(isset($_SESSION['f_password_r'])) unset($_SESSION['f_password_r']);
    if(isset($_SESSION['f_name'])) unset($_SESSION['f_name']);
    if(isset($_SESSION['f_surname'])) unset($_SESSION['f_surname']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ThanksForRegistration</title>
</head>
<body>
    <h1>Thanks for create account!</h1>
    
    <a href="index.php">Login</a>
</body>
</html>