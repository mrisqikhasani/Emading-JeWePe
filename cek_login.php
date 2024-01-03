<?php 
// $pass = password_hash("jewepe123", PASSWORD_DEFAULT);
// var_dump($pass);
// die;

include('admin/config_query.php');

$db = new database();

// inisialisasi sessions
session_start();

// cek Session aktif
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
    header('location: admin/index.php');
} else {

    // Cek apakah form disubmit
    if (isset($_POST['submit'])) {
        // menghilangkan 
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);
        
        
        //cek username apakah kosong
        if(!empty(trim($username)) && !empty(trim($password))) {
            // Select data user berdasarkan username
            
            $query = $db->get_data_users($username);
            
            if($query) {
                $rows = mysqli_num_rows($query);
            } else {
                $rows = 0;                
            }

            // cek ketersedian username
            if ($rows != 0) {
                $getData = $query->fetch_assoc();
                // cek apakah password sama dengan yang inputkan atau tidak 
                if (password_verify($password, $getData['password'])) {

                    $_SESSION['username'] = $username;
                    $_SESSION['id_users'] = $getData['id_users'];
                    header('location:admin/index.php');
                
                } else {
                    header('location:login.php?pesan=gagal');
                }
            } else {
                header("location:login.php?pesan=notfound");
            }
        } else {
            header("location:login.php?pesan=empty");
        }
    } else {
        header("location:login.php?pesan=empty");
    }
}
?>