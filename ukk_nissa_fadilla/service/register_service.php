<?php

include '../config/connection.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$address = $_POST['address'];

$sql = mysqli_query($connection, "INSERT INTO users (username, password, email, full_name, address) VALUES ('$username', '$password', '$email', '$fullName', '$address')");

if ($sql) {
    echo "
        <script>
            location.href='../user/login.php';
        </script>
    ";
}