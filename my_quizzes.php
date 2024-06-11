<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$sql = 'SELECT * FROM quiz_table WHERE user_id = :user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['chk_ssid'], PDO::PARAM_INT);
$stmt->execute();
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイクイズ一覧</title>
</head>

<body>
    <h1>マイクイズ一覧</h1>
    <table>
        <thead>
            <tr>
                <th>クイズ名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizzes as $quiz) : ?>
                <tr>
                    <td><?= htmlspecialchars($quiz['quiz_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <a href="quiz_edit.php?id=<?= $quiz['id'] ?>">編集</a>
                        <a href="quiz_delete.php?id=<?= $quiz['id'] ?>" onclick="return confirm('本当に削除しますか？');">削除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>