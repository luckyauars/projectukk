<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE Username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['Password'];

        // Periksa kecocokan password yang dimasukkan dengan password yang tersimpan
        if(password_verify($password, $stored_password)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Password salah. Silakan coba lagi.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }
}

mysqli_close($conn);
?>