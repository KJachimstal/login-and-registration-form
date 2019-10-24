<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
</head>
<body>

<?php

   echo "<h1>Wellcome ".$_SESSION['name']."!</h1>";
   echo "<h2>Data: </h2>";
   echo "<b>Email:</b> ".$_SESSION['email'];
   echo "<br/> <b>Name:</b> ".$_SESSION['name'];
   echo "<br/> <b>Surname:</b> ".$_SESSION['surname'];
   echo "<br/><br/><a href='logout.php'>Logout</a>";

?>
    
</body>
</html>