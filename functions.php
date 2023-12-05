<?php

require_once 'config.php';
function sanitizeInput($data){
    return htmlspecialchars(trim($data));
}

function validateForm($data){
    $errors=[];
    if(empty($data['first_name'])){
        $errors['first_name'] = "First name is required";
    }
    if(empty($data['last_name'])){
        $errors['last_name'] = "Last name is required";
    }
    if(empty($data['email'])){
        $errors['email'] = "Email is required";
    }
    if(empty($data['address'])){
        $errors['address'] = "Postal Address is required";
    }
    if(empty($data['city'])){
        $errors['city'] = "City is required";
    }
    if(empty($data['country'])){
        $errors['country'] = "Country is required";
    }
    if(empty($data['postal_code'])){
        $errors['postal_code'] = "Postal Code is required";
    }
    if(empty($data['phone'])){
        $errors['phone'] = "Phone Number is required";
    }
    
    return $errors;
}

function saveFormDataToDatabase($data){

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    foreach($data as &$value){
        $value = $conn->real_escape_string($value);
    }

    $sql="INSERT INTO `form_data` (`first_name`, `last_name`, `email`, `address`, `city`, `country`, `postal_code`, `phone`, `comments`) VALUES ('{$data['first_name']}', '{$data['last_name']}', '{$data['email']}', '{$data['address']}', '{$data['city']}', '{$data['country']}', '{$data['postal_code']}', '{$data['phone']}', '{$data['comments']}');";
    
    if($conn->query($sql) === TRUE){
        header("Location: index.php?success=1");
        exit;

    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function getFormDataFromDatabase(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `form_data`";
    $result = $conn->query($sql);

    if(!$result){
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $rows = [];
    
    if($result->num_rows > 0){
      $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    $conn->close();
    return $rows;
}

function updateFormDataInDatabase($id,$data){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    foreach($data as &$value){
        $value = $conn->real_escape_string($value);
    }

    $sql = "UPDATE `form_data` SET `first_name` = '{$data['first_name']}', `last_name` = '{$data['last_name']}', `email` = '{$data['email']}', `address` = '{$data['address']}', `city` = '{$data['city']}', `country` = '{$data['country']}', `postal_code` = '{$data['postal_code']}', `phone` = '{$data['phone']}', `comments` = '{$data['comments']}' WHERE `form_data`.`id` = {$id};";

    if($conn->query($sql) === TRUE){
        header("Location: dashboard.php?success=1");
        exit;

    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function deleteFormDataFromDatabase($id){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `form_data` WHERE `form_data`.`id` = {$id}";

    if($conn->query($sql) === TRUE){
        header("Location: dashboard.php?success=1");
        exit;

    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

