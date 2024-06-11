<?php
session_start();
include('functions.php');
$pdo = connect_to_do();
if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$quiz_name = $_POST['quiz_name'];

$sql = 'INSERT INTO quiz_table(user_id, quiz_name) VALUES(:user_id, :quiz_name)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['chk_ssid'], PDO::PARAM_INT);
$stmt->bindValue(':quiz_name', $quiz_name, PDO::PARAM_STR);
$stmt->execute();
$quiz_id = $pdo->lastInsertId();

for ($i = 1; $i <= 10; $i++) {
    $question = $_POST["question$i"];
    $choice1 = $_POST["choice1_$i"];
    $choice2 = $_POST["choice2_$i"];
    $choice3 = $_POST["choice3_$i"];
    $choice4 = $_POST["choice4_$i"];
    $answer = $_POST["answer$i"];
    $explanation = $_POST["explanation$i"];

    $sql = 'INSERT INTO question_table(quiz_id, question, choice1, choice2, choice3, choice4, answer, explanation) VALUES(:quiz_id, :question, :choice1, :choice2, :choice3, :choice4, :answer, :explanation)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':quiz_id', $quiz_id, PDO::PARAM_INT);
    $stmt->bindValue(':question', $question, PDO::PARAM_STR);
    $stmt->bindValue(':choice1', $choice1, PDO::PARAM_STR);
    $stmt->bindValue(':choice2', $choice2, PDO::PARAM_STR);
    $stmt->bindValue(':choice3', $choice3, PDO::PARAM_STR);
    $stmt->bindValue(':choice4', $choice4, PDO::PARAM_STR);
    $stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
    $stmt->bindValue(':explanation', $explanation, PDO::PARAM_STR);
    $stmt->execute();
}

header('Location: quiz_main.php');
exit();
