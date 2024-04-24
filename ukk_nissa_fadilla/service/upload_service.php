<?php
session_start();
include '../config/connection.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploadDate = date('Y-m-d');
    $userId = $_SESSION['userid'];
    $picture = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $location = '../image/';
    $filePath = rand().'-'.$picture;

    move_uploaded_file($tmp, $location.$filePath);

    $sql = mysqli_query($connection,
        "INSERT INTO pictures (title, description, upload_date, file_path, user_id) VALUES ('$title', '$description', '$uploadDate', '$filePath', '$userId')");

    echo "
        <script>
            location.href='../admin/upload.php';
        </script>
    ";
}