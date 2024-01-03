<?php 
include('config_query.php');


session_start();
// cek session
if (isset($_SESSION["username"]) || $_SESSION["id_users"]){
    $db=new database();

    $id_artikel = $_GET['id'];

    $query = $db->delete_artikel($id_artikel);

    $msg = "Successfully Deleted";
    header("location:index.php?pesan=$msg");
    
}
?>