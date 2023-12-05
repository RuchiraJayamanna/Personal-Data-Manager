<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once("functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idToEdit = $_POST['id'];
    $formData = array_map('sanitizeInput', $_POST);

    if(updateFormDataInDatabase($idToEdit, $formData)){
        header("Location: dashboard.php");
        exit;
    }else{
        $errorMessage = "Error updating record";
    }
}

if(isset($_GET['id'])){
    $idToEdit = $_GET['id'];
    $formDataToEdit = getFormDataById($idToEdit);
}else{
    header("Location: dashboard.php");
    exit;
}

function getFormDataById($id){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM `form_data` WHERE `id` = {$id}";
    $result = $conn->query($sql);

    if($result->num_rows== 1){
        $formData = $result->fetch_assoc();
        $conn->close();
        return $formData;
    }else{
        $conn->close();
        return null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0"> 
    <title>Edit the Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Edit Form</h1>
        <p>Edit the form below.</p>
        <?php
        if(isset($errorMessage)){
            echo "<p class='error'>$errorMessage</p>";
        }
        ?>

        <form action="edit.php" method="post">
           <input type="hidden" name="id" value="<?php echo $formDataToEdit['id'];?>">

            <div class="form-group">
                <label for="first_name">First Name :</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $formDataToEdit['first_name'];?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name :</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $formDataToEdit['last_name'];?>" required>
            </div>
            
            <div class="form-group">
            	<label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $formDataToEdit['email'];?>">
            </div>

            <div class="form-group">
                <label for="address">Postal Address :</label>
                <input type="text" id="address" name="address" value="<?php echo $formDataToEdit['address'];?>">
            </div>

            <div class="form-group">
            	<label for="city">City :</label>
                <input type="text" id="city" name="city" value="<?php echo $formDataToEdit['city'];?>">
            </div>

            <div class="form-group">
            	<label for="country">Country :</label>
                <input type="text" id="country" name="country" value="<?php echo $formDataToEdit['country'];?>">
            </div>

            <div class="form-group">
            	<label for="postal_code">Postal Code :</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo $formDataToEdit['postal_code'];?>">
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number :</label>
                <input type="text" id="phone" name="phone" value="<?php echo $formDataToEdit['phone'];?>">
            </div>
            
            <div class="form-group">
                <label for="comments">Comments :</label>
                <textarea name="comments" id="comments" cols="130" rows="5"><?php echo $formDataToEdit['comments'];?></textarea>
            </div>
            <br>
            <br>
            <button type="submit" class="dashboard-button">Update Form</button>
        </form>
    </div>
</body>
</html>
