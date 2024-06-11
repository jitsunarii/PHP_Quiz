<?php
include('functions.php');
$pdo = connect_to_do();
// var_dump($_POST);
// exit();
$username = $_POST['username'];
$lid = $_POST['lid'];
$lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT);

// lidの重複確認
$sql = 'SELECT COUNT(*) FROM user_table WHERE lid = :lid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->fetchColumn();

$sql = 'INSERT INTO user_table(username,lid,lpw) VALUES(:username,:lid,:lpw)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);

$status = $stmt->execute();


if ($status == false) {
    $error = $stmt->errorInfo();
    if ($error[1] == 1062) {
        echo "<p>同じログインIDが既に存在します。別のログインIDを使用してください。</p>";
    } else {
        echo json_encode(["sql error" => "{$error[2]}"]);
    }
    exit();
} else {
    header('Location:login.php');
}
