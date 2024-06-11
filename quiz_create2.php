<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ作成</title>
</head>

<body>
    <form action="quiz_create_act.php" method="POST">
        <fieldset>
            <legend>クイズ作成</legend>
            <div>
                <input type="text" name="quiz_name" placeholder="クイズ名" required>
            </div>
            <?php for ($i = 1; $i <= 10; $i++) : ?>
                <div>
                    <h3>問題<?= $i ?></h3>
                    <input type="text" name="question<?= $i ?>" placeholder="問題文" required>
                    <input type="text" name="choice1_<?= $i ?>" placeholder="選択肢1" required>
                    <input type="text" name="choice2_<?= $i ?>" placeholder="選択肢2" required>
                    <input type="text" name="choice3_<?= $i ?>" placeholder="選択肢3" required>
                    <input type="text" name="choice4_<?= $i ?>" placeholder="選択肢4" required>
                    <input type="text" name="answer<?= $i ?>" placeholder="正答" required>
                    <textarea name="explanation<?= $i ?>" placeholder="解説" required></textarea>
                </div>
            <?php endfor; ?>
            <div>
                <button type="submit">作成</button>
            </div>
        </fieldset>
    </form>
</body>

</html>