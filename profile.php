<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$sql = 'SELECT * FROM user_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_SESSION['chk_ssid'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
</head>

<body>
    <form action="profile_update.php" method="POST">
        <fieldset>
            <legend>プロフィール</legend>
            <div>
                <label>ユーザー名</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label>ログインID</label>
                <input type="text" name="lid" value="<?= htmlspecialchars($user['lid'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div>
                <label>新しいパスワード</label>
                <input type="password" name="lpw">
            </div>
            <div>
                <button type="submit">更新</button>
            </div>
        </fieldset>
    </form>
</body>

</html>