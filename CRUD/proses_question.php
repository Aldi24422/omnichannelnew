<?php
require_once 'pertanyaan.php';

$action = $_GET['action'] ?? '';

if ($action === 'add') {
    addPertanyaan($_POST['keyword'], $_POST['jawaban']);
} elseif ($action === 'edit') {
    updatePertanyaan($_POST['id'], $_POST['keyword'], $_POST['jawaban']);
} elseif ($action === 'delete') {
    deletePertanyaan($_POST['id']);
}

header('Location: ../pages/chat_bot.php');
exit();
?>
