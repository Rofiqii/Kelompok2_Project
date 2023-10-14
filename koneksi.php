<?php

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'rentalps';
$port = '3306';

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if(mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    die;
}