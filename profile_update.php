<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$username = $_POST['username'];
$lid = $_POST['lid'];
$email = $_POST['email'];
$lpw = $_POST['lpw'];

$sql = 'UPDATE user_table SET username = :username, lid = :lid, email = :email';
if ($lpw) {
    $sql .= ', lpw = :lpw';
    $lpw = password_hash($lpw, PASSWORD_DEFAULT);
}
$sql .= ' WHERE id = :id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
if ($lpw) {
    $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
}
$stmt->bindValue(':id', $_SESSION['chk_ssid'], PDO::PARAM_INT);
$stmt->execute();

header('Location: profile.php');
exit();
