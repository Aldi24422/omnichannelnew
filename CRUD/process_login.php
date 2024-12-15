<?php
session_start();
require_once("koneksi.php");

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validasi input
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($username) || empty($password)) {
    $_SESSION['error_message'] = "Username dan password tidak boleh kosong!";
    header("Location: ../pages/login.php");
    exit();
}

// Query SQL
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute(); 
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        // Redirect ke dashboard
        header("Location: ../pages/index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Password salah!";
        header("Location: ../pages/login.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Username tidak ditemukan!";
    header("Location: ../pages/login.php");
    exit();
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nama', $nama);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':role', $role);
$stmt->execute();

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);

    try {
        // Jika password diubah, update dengan password baru yang di-hash
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET nama = :nama, username = :username, role = :role, password = :password WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            // Jika password tidak diubah, update tanpa mengubah password
            $sql = "UPDATE users SET nama = :nama, username = :username, role = :role WHERE id = :id";
            $stmt = $conn->prepare($sql);
        }

        // Bind parameter lainnya
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);

        // Eksekusi query
        $stmt->execute();

        // Redirect ke halaman daftar user dengan pesan sukses
        header("Location: ../pages/user.php?success=edit");
        exit();
    } catch (PDOException $e) {
        // Tangani error jika terjadi
        echo "Error: " . $e->getMessage();
    }
}
?>
