<?php
require "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek_email = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($con, $cek_email);

    if(mysqli_num_rows($result) > 0){
        $response['value'] = 0;
        $response['message'] = 'email sudah digunakan';
        echo json_encode($response);
    } else {
        $query ="INSERT INTO user (email, password) VALUES ('email', '$password')";
        if(mysqli_query($con, $query)){
            $response['value'] = 1;
            $response['message'] = 'Registrasi Berhasil';
            echo json_encode($response);
        } else {
            $response['value'] = 0;
            $response['message'] = 'Registrasi gagal';
            echo json_encode($response);
        }
    }
}
?>