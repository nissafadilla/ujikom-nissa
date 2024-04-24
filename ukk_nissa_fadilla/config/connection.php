<?php

$hostname = 'localhost';
$user = 'root';
$password = '';
$db = 'ukk_gallery_website';

$connection = mysqli_connect($hostname, $user, $password, $db, 3306);

if (!$connection) {
    echo "Gagal";
}