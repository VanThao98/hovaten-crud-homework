<?php
require_once('./database/database.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteStudent($id);
    header('Location: index.php');}
?>