<?php
ob_start(); // Aktifkan output buffering
session_start();
include '../CRUD/koneksi.php'; // Perbaiki path jika diperlukan

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login jika belum login
    header("Location: ../CRUD/login.php");
    exit; // Menghentikan eksekusi lebih lanjut
}

$username = $_SESSION['username']; // Ambil username dari sesi
$name = "";
$role = "";

try {
    // Ambil data pengguna dari database
    $sql = "SELECT nama, role FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR); // Gunakan bindValue untuk mencegah SQL Injection
    $stmt->execute();

    // Memeriksa apakah pengguna ditemukan
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $user['nama']; // Ambil nama pengguna
        $role = $user['role']; // Ambil role pengguna
    } else {
        // Jika pengguna tidak ditemukan di database, redirect ke login
        session_destroy();
        header("Location: ../CRUD/login.php");
        exit;
    }
} catch (PDOException $e) {
    // Tampilkan pesan kesalahan jika terjadi masalah database
    die("Kesalahan saat mengambil data pengguna: " . $e->getMessage());
}
?>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #e5e5e5;
    margin: 0;
    padding: 0;
}

.whatsapp-container {
    background-color: white;
    width: 100%;
    max-width: 600px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
}

.whatsapp-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

.whatsapp-header h1 {
    font-size: 18px;
    color: #25d366;
    margin: 0;
}

.whatsapp-instructions {
    padding: 20px 0;
}

.whatsapp-instructions ol {
    padding-left: 20px;
    text-align: left;
}

.whatsapp-qr-code img {
    width: 200px;
    height: 200px;
}

.whatsapp-keep-signed {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

.whatsapp-keep-signed input {
    margin-right: 10px;
}

.whatsapp-help-link a {
    text-decoration: none;
    color: #25d366;
    font-weight: bold;
}

</style>

<!-- HTML mulai di sini -->
<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search ..." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.php"><img class="img-fluid" src="../assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="nav-right col-12 pull-right right-header p-0">
            <ul class="nav-menus">
                <li> <span class="header-search"><i data-feather="search"></i></span></li>
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media"><img class="b-r-10" src="../assets/images/dashboard/profile.jpg" alt="">
                        <div class="media-body">
                            <span><?php echo htmlspecialchars($username); ?></span>
                            <p class="mb-0 font-roboto"><?php echo htmlspecialchars($role); ?> <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="#"><i data-feather="user"></i><span>Profile </span></a></li>
                        <li><a href="../CRUD/logout.php"><i data-feather="log-in"></i><span>Log Out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
                <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                <div class="ProfileCard-details">
                    <div class="ProfileCard-realName">{{name}}</div>
                </div>
            </div>
        </script>
        <script class="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
        </script>
    </div>
</div>
