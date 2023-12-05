<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once("functions.php");

$formDataList = getFormDataFromDatabase();

if(isset($_GET['action']) && $_GET['action'] == 'delete'&& isset($_GET['id'])){
    $idToDelete = $_GET['id'];
    deleteFormDataFromDatabase($idToDelete);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome to the Dashboard.</p>

        <?php
        if(!empty($formDataList)){
            echo "<table>";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Address</th>";
            echo "<th>City</th>";
            echo "<th>Country</th>";
            echo "<th>Postal Code</th>";
            echo "<th>Phone</th>";
            echo "<th>Comments</th>";
            echo "<th>Actions</th>";
            echo "</tr>";

            foreach($formDataList as $formData){
                echo "<tr>";
                echo "<td>{$formData['first_name']}</td>";
                echo "<td>{$formData['last_name']}</td>";
                echo "<td>{$formData['email']}</td>";
                echo "<td>{$formData['address']}</td>";
                echo "<td>{$formData['city']}</td>";
                echo "<td>{$formData['country']}</td>";
                echo "<td>{$formData['postal_code']}</td>";
                echo "<td>{$formData['phone']}</td>";
                echo "<td>{$formData['comments']}</td>";
                echo "<td><a href='edit.php?id=" . $formData['id'] . "' class='edit-link'>Edit</a> | <a href='dashboard.php?action=delete&id=" . $formData['id'] . "'onclick='Return Confirm(\"Are You Sure?\")' class='delete-link'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }else{
            echo "<p>There are no forms to display.</p>";
        }
        ?>
        <p><a href="logout.php" class="dashboard-button">Logout</a></p>
    </div>
    
</body>
</html>