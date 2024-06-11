<?php
include('functions.php');
$pdo = connect_to_do();
//  var_dump($_POST);
//  exit();

$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

$sql = 'SELECT *FROM user_table WHERE lid=:lid';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':lid', $lid, PDO::PARAM_STR);
$stmt->execute();
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($Val);
// exit();

if (!$val || !password_verify($lpw, $val['lpw'])) {
    echo "<p>ログイン情報に誤りがあります。</p>";
    echo "<a href='login.php'>戻る</a>";
} else {
    $_SESSION['session_id'] = session_id();
    $_SESSION['chk_ssid'] = $val['id'];
    header('Location:quiz_select.php');
    exit();
}
