<?php 
// membuat class dengan nama database

class database{
    var $host= 'localhost';
    var $username= 'root';
    var $password = '';
    var $database = "db_emading";
    var $koneksi = "";

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if(mysqli_connect_errno()) {
            echo "Koneksi database Gagal :".mysqli_connect_error();
        }
    }

    // cek data pada tb users
    public function get_data_users($username)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username = '$username'");

        return $data;
    } 

    // ambil data dari tb artikel
    public function get_data_artikel($field, $value){
        $data = mysqli_query($this->koneksi, "SELECT * FROM artikel WHERE $field = '$value'");
        return $data;
    }

    // get all data dari tb artikel
    public function get_all_data_artikel(){
        $data = mysqli_query($this->koneksi, "SELECT * FROM artikel ");
        return $data;
    }

    // insert artikel
    public function post_artikel($header, $judul, $body, $status_publish, $id_users)
    {
        $data = $this->koneksi->prepare("INSERT INTO artikel (header, judul, body, status_publish, id_users) VALUES (?, ?, ?, ?, ?)");
        $data->bind_param("ssssi", $header, $judul, $body, $status_publish, $id_users);
        $data->execute();
        $data->close();
        return $data;
    }

    // update artikel by id 
    public function update_artikel($id_artikel, $header, $judul, $body ) 
    {
        /** update artikel by id without image cover*/
        $data = $this->koneksi->prepare("UPDATE artikel SET header=?, judul=?, body=?, updated_at=CURRENT_TIMESTAMP WHERE id_artikel=?");
        $data->bind_param("sssi", $header, $judul, $body, $id_artikel);
        $data->execute();
        $data->close();
        return $data;
    }

    public function delete_artikel($id)
    {
        $data = $this->koneksi->prepare('DELETE FROM artikel WHERE id_artikel =?');
        $data->bind_param('s', $id);
        $data->execute();
        $data->close();
        return $data;
    }

}



?>