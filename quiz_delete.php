<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

$sql = 'DELETE FROM quiz_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$sql = 'DELETE FROM question_table WHERE quiz_id = :quiz_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':quiz_id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: my_quizzes.php');
exit();
