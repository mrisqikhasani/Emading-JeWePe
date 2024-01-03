<?php 

$host= 'localhost';
$username= 'root';
$password = '';
$database = "db_emading";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    echo 'terhubung';
} else {
    echo "not connected";
}



?>