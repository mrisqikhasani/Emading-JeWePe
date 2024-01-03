<?php 
include("../config_query.php");

$db = new database();

session_start();

// cek session id
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
    // cek apakah ada aksesnya terdapat parameter id
    if (isset($_GET['id'])) {
        $id_artikel = $_GET['id'];
        // cek artikel pada database
        $query = $db->get_data_artikel('id_artikel', $id_artikel);

        $rows=mysqli_num_rows($query);

        // jika ada maka lakukan update
        if ($rows != 0){
            $current_status = $query->fetch_assoc();


            // melakukan cek status publish sebelumnya
            if ($current_status['status_publish'] == 'publish') {
                $db->update_status_artikel($id_artikel, 'draft');
            } else if($current_status['status_publish'] === 'draft') {
                $db->update_status_artikel($id_artikel, 'publish');
            }

            $msg = 'Status publish berhasil diubah';
            header("location:../index.php?pesan=$msg");

        } else {
            $msg = 'artikel tidak tersedia';
            header("locatlion:index.php?pesan=$msg");
        }

    }
} else {
    header('location:index.php');
}


?>