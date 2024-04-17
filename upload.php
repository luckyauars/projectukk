<?php
include "koneksi.php";

// Cek apakah form upload file telah disubmit
if (isset($_FILES["fileToUpload"]) && isset($_POST['submit'])) {
    $target_dir = "uploads";
    $file_name = $_FILES["fileToUpload"]["name"];
    $target_file = $target_dir . basename($file_name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Ambil nilai dari input judul dan deskripsi
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];

            $sql = "INSERT INTO foto (image, JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, AlbumID, UserID) 
                    VALUES (?, ?, ?, NOW(), ?, 1, 1)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $file_name, $judul, $deskripsi, $target_file);
            if (mysqli_stmt_execute($stmt)) {
                echo "The file " . $file_name . " has been uploaded and data has been inserted into database.";
                header("Location: indexx.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="uploadstyle/style.css">
    <title>Gallery Foto</title>
</head>

<body>
    <div class="container">
        <div class="heading">Upload Image</div>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <div class="input-field">
                <input required="" autocomplete="off" type="text" name="judul" id="judul" />
                <label for="judul">Judul</label>
            </div>
            <div class="input-field">
                <input required="" autocomplete="off" type="text" name="deskripsi" id="deskripsi" />
                <label for="deskripsi">Deskripsi</label>
            </div>
            <div class="btn-container">
                <button class="btn" name="submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
