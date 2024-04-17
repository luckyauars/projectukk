<?php
// Include koneksi ke database
include "koneksi.php";

// Inisialisasi variabel error
$error = '';

// Cek apakah ID gambar telah diterima dari parameter URL
if (isset($_GET['id'])) {
    // Ambil ID gambar dari parameter URL
    $idGambar = $_GET['id'];

    // Query untuk mengambil data gambar berdasarkan ID
    $queryGambar = "SELECT * FROM foto WHERE FotoID = $idGambar";
    $resultGambar = $conn->query($queryGambar);

    // Periksa apakah query berhasil dieksekusi dan data gambar ditemukan
    if ($resultGambar && $resultGambar->num_rows > 0) {
        // Ambil data gambar dari hasil query
        $gambar = $resultGambar->fetch_assoc();

        // Tangkap pengiriman formulir edit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data yang dikirimkan oleh pengguna
            $judulFoto = $_POST['judulFoto'];
            $deskripsiFoto = $_POST['deskripsiFoto'];

            // Query untuk memperbarui informasi gambar di database
            $queryUpdate = "UPDATE foto SET JudulFoto = '$judulFoto', DeskripsiFoto = '$deskripsiFoto' WHERE FotoID = $idGambar";

            // Jalankan query update
            if ($conn->query($queryUpdate) === TRUE) {
                // Redirect kembali ke halaman utama setelah berhasil mengedit
                header("Location: index.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat mengupdate data: " . $conn->error;
            }
        }
    } else {
        // Gambar tidak ditemukan, tampilkan pesan error
        $error = "Gambar tidak ditemukan";
    }
} else {
    // ID gambar tidak ditemukan dalam parameter URL, tampilkan pesan error
    $error = "ID Gambar tidak ditemukan";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="uicss/editstyle.css">
</head>

<body>
    <!-- Navigation bar and layout structure -->

    <main>
        <!-- Main content area -->
        <div class="form-container">
            <h1>Edit Gambar</h1>
            <?php
            // Tampilkan pesan error jika ada
            if (!empty($error)) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            ?>
            <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $gambar['FotoID']); ?>">
                <div class="form-group">
                    <label for="judulFoto">Judul Foto</label>
                    <input type="text" id="judulFoto" name="judulFoto" value="<?php echo $gambar['JudulFoto']; ?>" required="" >
                </div>
                <div class="form-group">
                    <label for="deskripsiFoto">Deskripsi Foto</label>
                    <textarea class="form-control" id="deskripsiFoto" name="deskripsiFoto" rows="3" required><?php echo $gambar['DeskripsiFoto']; ?></textarea>
                </div>
                <button type="submit" class="form-submit-btn">Simpan Perubahan</button>
            </form>
        </div>
    </main>

    <!-- Footer section and scripts -->
</body>

</html>