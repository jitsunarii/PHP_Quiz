<?php
include('functions.php');
$pdo = connect_to_do();

$lid = $_GET['lid'];
try {
    $sql = 'SELECT COUNT(*) FROM user_table WHERE lid = :lid';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo 'NG';
    } else {
        echo 'OK';
    }
} catch (PDOException $e) {
    echo 'error';
}
