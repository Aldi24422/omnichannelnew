<?php
require_once '../CRUD/koneksi.php'; // Koneksi database

header('Content-Type: application/json');

// Query untuk mengambil data keyword dan jawaban
try {
    $stmt = $db->prepare("SELECT keyword, jawaban FROM pertanyaan");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
