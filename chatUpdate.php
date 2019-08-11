<?php
require "bancoDados.php";
$grupo = $_GET['grupo'];
if (!empty($grupo)) {
    $stmt = $conn->query('SELECT * FROM chat WHERE grupo = ' . $grupo);
    $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($chat);
}