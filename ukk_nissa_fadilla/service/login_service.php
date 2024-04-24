<?php
session_start();
include '../config/connection.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

$check = mysqli_num_rows($sql);

if ($check > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';
    if ($sql) {
        $row = mysqli_fetch_assoc($sql);
        if ($row) {
            $_SESSION['userid'] = $row['id'];
        }
    }
    echo "
        <script>
            location.href='../admin/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('username or password is wrong');
            location.href='../user/login.php';
        </script>
    ";
}