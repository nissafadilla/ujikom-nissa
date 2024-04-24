<?php
session_start();
include '../config/connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id-delete'];
    $query = mysqli_query($connection, "SELECT * FROM pictures WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    if (is_file('../image/'.$data['file_path'])) {
        unlink('../image/'.$data['file_path']);
    }

    $sql = mysqli_query($connection, "DELETE FROM pictures WHERE id='$id'");

    echo "
        <script>
            location.href='../admin/upload.php';
        </script>
    ";
}