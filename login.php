<?php

session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $validUsername = "admin";
    $validPassword = "password";

    if($username == $validUsername && $password == $validPassword){
        $_SESSION['user_id'] = "admin";
        header("Location: dashboard.php");
        exit;
    }else{
        $errorMessage = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php
        if(isset($errorMessage)){
            echo "<p class='error'>$errorMessage</p>";
        }
        ?>

        <form action="login.php" method="post" >
            <label for="username">User Name : </label>
            <input type="text" name="username" id="username" required>
            
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" required>

            <br>
            <button type="submit" >Login</button>
        </form>
    </div>
</body>
</html>

