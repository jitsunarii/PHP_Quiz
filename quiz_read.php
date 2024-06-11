<?php
include('functions.php');
$pdo = connect_to_do();
$sql = 'SELECT * FROM quiz_table ORDER BY category_id ASC ';

$stmt = $pdo->prepare($sql);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
    $output .=
        "<tr>
    <td>{$record["question"]}</td>
    </tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <?= $output ?>
    </table>
</body>

</html>