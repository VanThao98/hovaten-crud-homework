<?php
require_once('database/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $image_url = $_POST['image_url'];

    $studentData = array(
        'name' => $name,
        'age' => $age,
        'email' => $email,
        'profile' => $image_url,
    );

    try {
        createStudent($studentData);
        header('Location: index.php'); 
        exit();
    } catch (Exception $e) {
       
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>