<?php
require_once 'koneksi.php';

// Fetch All Data
function getAllPertanyaan() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM pertanyaan ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add Data
function addPertanyaan($keyword, $jawaban, $lampiran = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO pertanyaan (keyword, jawaban, lampiran) VALUES (:keyword, :jawaban, :lampiran)");
    $stmt->execute(['keyword' => $keyword, 'jawaban' => $jawaban, 'lampiran' => $lampiran]);
}

// Update Data
function updatePertanyaan($id, $keyword, $jawaban, $lampiran = null) {
    global $conn;
    $stmt = $conn->prepare("UPDATE pertanyaan SET keyword = :keyword, jawaban = :jawaban, lampiran = :lampiran WHERE id = :id");
    $stmt->execute(['keyword' => $keyword, 'jawaban' => $jawaban, 'lampiran' => $lampiran, 'id' => $id]);
}

// Delete Data
function deletePertanyaan($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM pertanyaan WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>
