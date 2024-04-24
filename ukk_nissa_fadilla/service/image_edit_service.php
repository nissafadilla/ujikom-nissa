<?php
session_start();
include '../config/connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id-edit'];
    $title = $_POST['title-edit'];
    $description = $_POST['description-edit'];
    $uploadDate = date('Y-m-d');
    $userId = $_SESSION['userid'];
    $picture = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $location = '../image/';
    $filePath = rand().'-'.$picture;

    if ($picture == null) {
        $sql = mysqli_query($connection, "UPDATE pictures SET title='$title', description='$description', upload_date='$uploadDate' WHERE id='$id'");
    } else {
        $query = mysqli_query($connection, "SELECT * FROM pictures WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        if (is_file('../image/'.$data['file_path'])) {
            unlink('../image/'.$data['file_path']);
        }
        move_uploaded_file($tmp, $location.$filePath);
        $sql = mysqli_query($connection, "UPDATE pictures SET title='$title', description='$description', upload_date='$uploadDate', file_path='$filePath' WHERE id='$id'");
    }

    echo "
        <script>
            location.href='../admin/upload.php';
        </script>
    ";
}