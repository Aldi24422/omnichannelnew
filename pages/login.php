<?php
session_start(); // Mulai sesi

// Ambil pesan error dari URL
$error_message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'unauthorized') {
        $error_message = "Silakan login untuk mengakses halaman.";
    } elseif ($_GET['error'] == 'invalid') {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("../includes/head.php"); ?>
    <script>
        // JavaScript untuk toggle visibility password
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var toggleText = document.getElementById('toggle-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleText.innerText = 'Hide Password';
            } else {
                passwordField.type = 'password';
                toggleText.innerText = 'Show Password';
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7">
                <img class="bg-img-cover bg-center" src="../assets/images/login/4.png" alt="loginpage">
            </div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo text-start" href="index.html">
                                <img class="img-fluid for-light" src="../assets/images/sby/logo-disdukcapil-kecil-1.png" alt="logo">
                                <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="logo">
                            </a>
                        </div>
                        <div class="login-main">
                            <!-- Pesan Error -->
                            <?php if (!empty($error_message)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($error_message); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Form Login -->
                            <form class="theme-form" method="POST" action="../CRUD/process_login.php">
                                <h4>APLIKASI OMNICHANNEL</h4>
                                <p>Disdukcapil Surabaya</p>

                                <!-- Input Username -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" required placeholder="Masukkan Username">
                                </div>

                                <!-- Input Password -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" id="password" name="password" required placeholder="*********">
                                    <!-- Tulisan Dinamis Show/Hide Password -->
                                    <div style="text-align: right; margin-top: 5px;">
                                        <a href="#" id="toggle-password" onclick="togglePassword(); return false;" style="text-decoration: none; font-size: 14px;">Show Password</a>
                                    </div>
                                </div>

                                <!-- Tombol Login -->
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit" value="login" style="margin-top: 15px;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../includes/script.php"); ?>
    </div>
</body>

</html>