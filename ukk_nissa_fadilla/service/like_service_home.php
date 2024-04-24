<?php
session_start();
include '../config/connection.php';

$pictureId = $_GET['pictureId'];
$userId = $_SESSION['userid'];
$likeDate = date('Y-m-d');

$checkLike = mysqli_query($connection, "SELECT * FROM likes WHERE picture_id='$pictureId' AND user_id='$userId'");

if (mysqli_num_rows($checkLike) == 1) {
    while ($row = mysqli_fetch_array($checkLike)) {
        $id = $row['id'];
        $query = mysqli_query($connection, "DELETE FROM likes WHERE id='$id'");
        echo "
            <script>
                location.href='../admin/home.php';
            </script>
        ";
    }
} else {
    $query = mysqli_query($connection, "INSERT INTO likes (picture_id, user_id, like_date) VALUES ('$pictureId', '$userId', '$likeDate')");

    echo "
    <script>
        location.href='../admin/home.php';
    </script>
";
}