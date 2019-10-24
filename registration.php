<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    
    <form method="post">
        E-mail: <br/> <input type="text" name="email" /><br/>
        Login: <br/> <input type="text" name="login" /><br/>
        Password: <br/> <input type="password" name="password" /><br/>
        Repeat password: <br/> <input type="password" name="password_r" /><br/>
        Name: <br/> <input type="text" name="name" /><br/>
        Surname: <br/> <input type="text" name="surname" /><br/>
        <label><input type="checkbox" name="reg">Accept the regulations</label>
        <div class="g-recaptcha" data-sitekey="6LeKZr8UAAAAAKtSJvJmWXBmuIX0Lh4INs_8RG0I"></div>
        <input type="submit" value="Send" />
    </form>

</body>
</html>