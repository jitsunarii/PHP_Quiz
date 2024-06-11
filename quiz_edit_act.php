<?php
session_start();
include('functions.php');
$pdo =
    connect_to_do();

if (!isset($_SESSION['chk_ssid']) || $_SESSION['session_id'] != session_id()) {
    header('Location: login.php');
    exit();
}

$quiz_id = $_POST['quiz_id'];

for ($i = 0; $i < 10; $i++) {
    $question = $_POST["question$i"];
    $choice1 = $_POST["choice1_$i"];
    $choice2 = $_POST["choice2_$i"];
    $choice3 = $_POST["choice3_$i"];
    $choice4 = $_POST["choice4_$i"];
    $answer = $_POST["answer$i"];
    $explanation = $_POST["explanation$i"];

    $sql = 'UPDATE question_table SET question = :question, choice1 = :choice1, choice2 = :choice2, choice3 = :choice3, choice4 = :choice4, answer = :answer, explanation = :explanation WHERE quiz_id = :quiz_id AND id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':question', $question, PDO::PARAM_STR);
    $stmt->bindValue(':choice1', $choice1, PDO::PARAM_STR);
    $stmt->bindValue(':choice2', $choice2, PDO::PARAM_STR);
    $stmt->bindValue(':choice3', $choice3, PDO::PARAM_STR);
    $stmt->bindValue(':choice4', $choice4, PDO::PARAM_STR);
    $stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
    $stmt->bindValue(':explanation', $explanation, PDO::PARAM_STR);
    $stmt->bindValue(':quiz_id', $quiz_id, PDO::PARAM_INT);
    $stmt->bindValue(':id', $i + 1, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: my_quizzes.php');
exit();
