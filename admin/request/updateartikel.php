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
        $id_artikel = $_POST['id_artikel'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $image_name= $_FILES['cover']['name'];

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
                    $query = $db->update_artikel($id_artikel, $new_image_name ,$title, $body);

                    $msg = 'Successfully Update';
                    header("location:../index.php?pesan=$msg");
                }
            } else {
                header("location:..index.php?pesan$error");
            }
            
        } else {
            // jika tidak terdapat image maka insert dengan string kosong pada field header
            $query = $db->update_artikel($id_artikel,"default.png" ,$title, $body);
            $msg = 'Successfully Update';
            header("location:../index.php?pesan=$msg");
        }
} else {
    header('location:../index.php');
}

?>