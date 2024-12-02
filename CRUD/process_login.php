<?php
session_start(); // Ensure session starts
require_once("koneksi.php"); // Include database connection

// Get data from form
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Prepare the SQL statement
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);

// Bind parameters and execute the statement
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Verify password (plain text)
    if ($password === $user['password']) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        // Set remember me cookie if requested
        if (!empty($_POST['remember_me'])) {
            setcookie("username", $username, time() + (86400 * 30), "/", "", true, true); // Secure and HttpOnly cookie
        }

        // Redirect to the dashboard
        header("Location: ../pages/index.php");
        exit();
    } else {
        // Password verification failed
        $_SESSION['error_message'] = "Password salah!";
        header("Location: ../pages/login.php");
        exit();
    }
} else {
    // Username not found
    $_SESSION['error_message'] = "Username tidak ditemukan!";
    header("Location: ../pages/login.php");
    exit();
}
?>
