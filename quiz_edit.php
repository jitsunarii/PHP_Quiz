<?php
session_start();
include('functions.php');
$pdo = connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$sql = 'SELECT * FROM question_table WHERE quiz_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ編集</title>
</head>

<body>
    <form action="quiz_edit_act.php" method="POST">
        <fieldset>
            <legend>クイズ編集</legend>
            <div>
                <input type="hidden" name="quiz_id" value="<?= $id ?>">
                <?php foreach ($questions as $index => $question) : ?>
                    <div>
                        <h3>問題<?= $index + 1 ?></h3>
                        <input type="text" name="question<?= $index ?>" value="<?= htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <input type="text" name="choice1_<?= $index ?>" value="<?= htmlspecialchars($question['choice1'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <input type="text" name="choice2_<?= $index ?>" value="<?= htmlspecialchars($question['choice2'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <input type="text" name="choice3_<?= $index ?>" value="<?= htmlspecialchars($question['choice3'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <input type="text" name="choice4_<?= $index ?>" value="<?= htmlspecialchars($question['choice4'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <input type="text" name="answer<?= $index ?>" value="<?= htmlspecialchars($question['answer'], ENT_QUOTES, 'UTF-8') ?>" required>
                        <textarea name="explanation<?= $index ?>" required><?= htmlspecialchars($question['explanation'], ENT_QUOTES, 'UTF-8') ?></textarea>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <button type="submit">更新</button>
            </div>
        </fieldset>
    </form>
</body>

</html>