<?php
require "koneksi.php";

// Pastikan ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai username dan password yang dikirimkan dari formulir login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk memeriksa kecocokan username dan password
    $query = "SELECT * FROM user WHERE Username='$username'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah ada baris yang sesuai dengan username
    if(mysqli_num_rows($result) == 1) {
        // Ambil data user dari hasil query
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['Password'];

        // Periksa kecocokan password yang dimasukkan dengan password yang tersimpan
        if(password_verify($password, $stored_password)) {
            // Jika cocok, arahkan pengguna ke halaman berikutnya
            header("Location: index.php"); // Ganti index.php dengan halaman yang sesuai
            exit();
        } else {
            // Jika password tidak cocok, tampilkan pesan kesalahan
            echo "Password salah. Silakan coba lagi.";
        }
    } else {
        // Jika tidak ada baris yang sesuai dengan username, tampilkan pesan kesalahan
        echo "Username tidak ditemukan.";
    }
}

// Tutup koneksi database
mysqli_close($conn);
?>