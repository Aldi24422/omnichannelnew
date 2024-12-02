<?php
// Mulai sesi PHP
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login dengan pesan error
    header("Location: ../pages/login.php?error=unauthorized");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../includes/head.php");
    ?>
</head>

<body>
    <!-- Tap on top starts -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- Tap on top ends -->

    <!-- Page-wrapper Start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start -->
        <?php
        require_once("../includes/header.php");
        ?>
        <!-- Page Header Ends -->

        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start -->
            <?php
            require_once("../includes/sidebar.php");
            ?>
            <!-- Page Sidebar Ends -->

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Dashboard</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html"><i data-feather="home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="knowledgebase-bg">
                                <img class="bg-img-cover bg-center" src="../assets/images/sby/bg-1.png" alt="loginpage">
                            </div>
                            <div class="knowledgebase-search">
                                <div>
                                    <h1>Aplikasi Omnichannel</h1>
                                    <h3>Disdukcapil Surabaya</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 1 -->
                        <div class="col-sm-6 col-xl-4 xl-50 col-lg-6 box-col-6">
                            <div class="card social-widget-card">
                                <div class="card-body">
                                    <div class="redial-social-widget radial-bar-70" data-label="50%">
                                        <img src="../assets/images/sby/1.png" alt="">
                                    </div>
                                    <h5 class="b-b-light">Whatsapp</h5>
                                    <div class="row">
                                        <div class="col text-center b-r-light">
                                            <span>Belum Ditanggapi</span>
                                            <h4 class="counter mb-0">6589</h4>
                                        </div>
                                        <div class="col text-center">
                                            <span>Total Selesai</span>
                                            <h4 class="counter mb-0">75269</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-sm-6 col-xl-4 xl-50 col-lg-6 box-col-6">
                            <div class="card social-widget-card">
                                <div class="card-body">
                                    <div class="redial-social-widget radial-bar-70" data-label="50%">
                                        <img src="../assets/images/sby/2.png" alt="">
                                    </div>
                                    <h5 class="b-b-light">Instagram</h5>
                                    <div class="row">
                                        <div class="col text-center b-r-light">
                                            <span>Belum Ditanggapi</span>
                                            <h4 class="counter mb-0">6589</h4>
                                        </div>
                                        <div class="col text-center">
                                            <span>Total Selesai</span>
                                            <h4 class="counter mb-0">75269</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-sm-6 col-xl-4 xl-50 col-lg-6 box-col-6">
                            <div class="card social-widget-card">
                                <div class="card-body">
                                    <div class="redial-social-widget radial-bar-70" data-label="50%">
                                        <img src="../assets/images/sby/4.png" alt="">
                                    </div>
                                    <h5 class="b-b-light">Twitter (X)</h5>
                                    <div class="row">
                                        <div class="col text-center b-r-light">
                                            <span>Belum Ditanggapi</span>
                                            <h4 class="counter mb-0">1234</h4>
                                        </div>
                                        <div class="col text-center">
                                            <span>Total Selesai</span>
                                            <h4 class="counter mb-0">4369</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends -->
            </div>
            <!-- Footer Start -->
            <?php
            require_once("../includes/footer.php");
            ?>
        </div>
    </div>

    <?php
    require_once("../includes/script.php");
    ?>
</body>

</html>