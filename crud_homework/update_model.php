<?php
require_once './database/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $profile = $_POST['profile'];
    
    if(isset($name)){
        $name = htmlspecialchars($_POST['name']);
        echo $name;
        }
        if(isset( $age)){
            $age = htmlspecialchars($_POST['age']);
            echo  $age;
        }
        if(isset($email )){
            $email  = htmlspecialchars($_POST['email']);
            echo  $email ;
        }
        if(isset(  $profile)){
            $profile= htmlspecialchars($_POST['profile']);
            echo    $profile;
        }
   
    updateStudent($id, $name, $age, $email, $profile);

    header('Location: index.php');
    exit();

}
?>