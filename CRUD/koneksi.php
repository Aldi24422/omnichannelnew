<?php
// Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "chatbot_omnichannel";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Create
        if ($action === 'create') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];

            $sql = "INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nama, $username, $password, $role]);
        }

        // Update
        if ($action === 'update') {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $role = $_POST['role'];

            $sql = "UPDATE users SET nama = ?, username = ?, role = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nama, $username, $role, $id]);
        }

        // Delete
        if ($action === 'delete') {
            $id = $_POST['id'];

            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
        }
    }
}

// Fetch Data
$sql = "SELECT * FROM users";
$users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>