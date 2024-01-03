<?php 
include("../config_query.php");

$db = new database();

session_start();

// cek session id
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
    // cek apakah ada aksesnya terdapat parameter id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = $db->get_data_artikel($id);

    }
} else {
    header('location:index.php');
}


?>