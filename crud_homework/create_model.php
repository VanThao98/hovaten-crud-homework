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
        header('Location: index.php'); // Chuyển hướng về trang danh sách học sinh sau khi thêm mới
        exit();
    } catch (Exception $e) {
        // Xử lý lỗi nếu có
        echo "Error: " . $e->getMessage();
    }
} else {
    // Nếu không phải là yêu cầu POST, có thể xử lý tùy ý, ví dụ: hiển thị thông báo hoặc chuyển hướng
    echo "Invalid request.";
}
?>