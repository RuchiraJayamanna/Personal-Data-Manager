<?php

session_start();
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
require_once 'config.php';
require_once 'functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formData =array_map('sanitizeInput', $_POST);
    $errors = validateForm($formData);

    if(empty($errors)) {
       saveFormDataToDatabase($formData);
    }
    header("Location: dashboard.php?success=1");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Register Form</h1>
        <p>Fill in the form below to Register.</p>

        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "<p class='success'>Thank you for submitting your form.</p>";
        }
        ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="fist_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="address">Postal Address:</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city">
            </div>

            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country">
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone">

            <div class="form-group">
                <label for="comments"> Comments:</label>
                <textarea name="comments" id="comments" cols="130" rows="5"></textarea>
            </div>
            <br>
            <br>
            <button type="submit" class="dashboard-button">Submit Form</button>
        </form>
        <a href="dashboard.php" class="dashboard-button">Go To Dashboard</a>
    </div>
</body>

</html>