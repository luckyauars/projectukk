<?php
include "koneksi.php";

$queryFoto = "SELECT * FROM foto";
$resultFoto = $conn->query($queryFoto);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GaleriKita</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin: 50px;
        align-items: center;
        grid-gap: 30px;
    }



    .grid>article {
        box-shadow: 10px 5px 5px 0px black;
        border-radius: 30px;
        text-align: center;
        background: rgb(44, 44, 44);
        width: 200px;
        transition: transform;
        -webkit-transition: transform;
        -moz-transition: transform;
        -ms-transition: transform;
        -o-transition: transform;
    }

    .grid>article img {
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        /*width: 100%;*/
    }

    .konten {
        cursor: progress;
    }

    .grid>article:hover {
        transform: scale(1.2);
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
    }

    @media (max-width:1000px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width:800px) {
        .grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-5" href="indexx.php">GaleriKit</a>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">UTAMA</div>
                        <a class="nav-link" href="indexx.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>
                            Galeri
                        </a>
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Foto Terakhir
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="upload.php">
                            <div class="sb-nav-link-icon"><span class="mdi mdi-view-gallery-outline"></span></div>
                            Upload Image
                        </a>
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="login.php">
                            <div class="sb-nav-link-icon"><span class="mdi mdi-account-cowboy-hat-outline"></span></div>
                            Akun
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                </div>
                <p class="text-center">Lucky Aulia Arisdi Project UKK-2024</p>
                <div class="container">
                    <main class="grid">
                        <article>
                            <img src="uploads/index.jpeg" width="200px" height="200px">
                            <div class="konten">
                                <h2> Contoh </h2>
                                <p> Merupaka Contoh </p>
                            </div>
                        </article>
                        <article>
                            <img src="uploads/inilah-cara-merawat-anak-kucing-yang-tepat.jpg" width="200px" height="200px">
                            <div class="konten">
                                <h2> Contoh </h2>
                                <p> Merupaka Contoh </p>
                            </div>
                        </article>
                        <article>
                            <img src="uploads/ular tangga.jpg" width="200px" height="200px">
                            <div class="konten">
                                <h2> Contoh </h2>
                                <p> Merupaka Contoh </p>
                            </div>
                        </article>
                        <?php
                        while ($row = $resultFoto->fetch_assoc()) {
                            echo '<article>';
                            echo '<img src="uploads' . $row['image'] . '" width="200px" height="200px">';
                            echo '<div class="konten">';
                            echo '<h2>' . $row['JudulFoto'] . '</h2>';
                            echo '<p>' . $row['DeskripsiFoto'] . '</p>';
                            echo '</div>';
                            echo '</article>';
                        }
                        ?>
                    </main>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>