<?php 

// memanggil query 
include('../config_query.php');
// memulai session
session_start();

// inisialiasi objek database
$db = new database();

// cek session aktif
if (isset($_SESSION['username']) || isset($_SESSION['id_users'])) {
        // menyimpan nilai input disimpan ke variabel
        $title = $_POST['title'];
        $body = $_POST['body'];
        $status_value = $_POST['submit']; 

        
        // Mengubah value status menjadi value sesuai dengan enum pada database
        if ($status_value == 'Publish') {
            $status = 'publish';
        } else if($status_value == 'Save to Draft') {
            $status = 'draft';
        }

        $image_name= $_FILES['cover']['name'];
        $id_users=$_SESSION['id_users'];

        // cek apakah user input cover image maka text image dimasukan 
        if ($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
            
            // cek apakah ada error
            if($error === 0) {
                $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_ex = strtolower($image_ex);
                $allowed_exs = array('jpg', 'jpeg', 'png');
                
                // cek file yang input user apakah extension pada variabel alllow_exs 
                if(in_array($image_ex, $allowed_exs)){
                    $new_image_name = uniqid("COVER-", true).'.'.$image_ex;
                    $image_path='../../upload/artikel/'.$new_image_name;
                    move_uploaded_file($image_temp, $image_path);
                    
                    // melakukan query dengan pemanggilan method post_artikel
                    $query = $db->post_artikel($new_image_name, $title, $body, $status, $id_users);


                    $msg = 'successfully created';
                    header("location:../index.php?pesan=$msg");
                }
            }
        } else {
            // jika tidak terdapat image maka insert dengan string kosong pada field header
            $query = $db->post_artikel("default.png", $title, $body, $status, $id_users);
            
            $msg = 'successfully created';
            header("location:../index.php?pesan=$msg");
        }
}

?>