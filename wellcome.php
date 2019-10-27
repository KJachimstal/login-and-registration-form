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