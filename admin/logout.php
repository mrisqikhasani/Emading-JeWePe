<?php 
session_start();

// unset Semua session variable
unset($_SESSION['username']);
unset($_SESSION['id_users']);

// unset all
session_unset();

// Destroy session
session_destroy();

// arahkan halaman login
header('location:../login.php?pesan=logout');
exit;

?>