<?php
require 'koneksi.php';

session_start();
unset($_SESSION['rentalps']);
session_destroy();
header("Location: login.php");
?>