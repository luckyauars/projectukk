<?php
$conn = new mysqli("localhost", "root", "", "db_gallery");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$queryUser = "SELECT * FROM user";
$resultUser = $conn->query($queryUser);

$queryFoto = "SELECT * FROM foto";
$resultFoto = $conn->query($queryFoto);

?>