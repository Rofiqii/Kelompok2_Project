<?php

$host = 'localhost';
$user = 'rentalpo_rentalpo';
$pass = 'Celanakotak54321';
$db = 'rentalpo_rentalps';
$port = '3306';

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if(mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    die;
}