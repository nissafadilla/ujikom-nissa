<?php
session_start();
include '../config/connection.php';

if (isset($_POST['submit'])) {

    $userId = $_SESSION['userid'];
    $pictureId = $_POST['picture-id'];
    $comment = $_POST['comment'];
    $commentDate = date('Y-m-d');

    $sql = mysqli_query($connection, "INSERT INTO comments (picture_id, user_id, comment, comment_date) VALUES ('$pictureId', '$userId', '$comment', '$commentDate')");

    echo "
    <script>
        location.href='../admin/comment.php?picture={$_GET['picture']}&pictureTitle={$_GET['pictureTitle']}&pictureId={$_GET['pictureId']}&description={$_GET['description']}&uploadDate={$_GET['uploadDate']}';
    </script>
    ";
}