<?php
// POSTデータ確認
if (
  !isset($_POST['category']) || $_POST['category'] === '' ||
  !isset($_POST['difficulty']) || $_POST['difficulty'] === '' ||
  !isset($_POST['quiz']) || $_POST['quiz'] === '' ||
  !isset($_POST['A_1']) || $_POST['A_1'] === '' ||
  !isset($_POST['A_2']) || $_POST['A_2'] === '' ||
  !isset($_POST['A_3']) || $_POST['A_3'] === '' ||
  !isset($_POST['A_4']) || $_POST['A_4'] === '' ||
  !isset($_POST['answer']) || $_POST['answer'] === '' ||
  !isset($_POST['explanation']) || $_POST['explanation'] === ''
) {
  exit('ParamError');
}
$category = intval($_POST['category']);
$difficulty = intval($_POST['difficulty']);
$quiz = $_POST['quiz'];
$A_1 = $_POST['A_1'];
$A_2 = $_POST['A_2'];
$A_3 = $_POST['A_3'];
$A_4 = $_POST['A_4'];
$Answer = $_POST['answer'];
$explanation = $_POST['explanation'];

// 各種項目設定
$dbn = 'mysql:dbname=gs_DB_work;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

//カテゴリIDの取得
/*****************************************************************************************************
'SELECT id FROM category WHERE category = :category'
$pdo->prepareでPDOクラスのメソッドprepareを使いSQL文実行。
SELECT id FROM category=>categoryテーブルからidカラムの値を取得。
WHERE category = :category=>条件の指定。
 *****************************************************************************************************/
$category_stmt = $pdo->prepare('SELECT id FROM category_table WHERE id = :id');
//:categoryに実際の値をバインド。PDO::PARAM_STRは値の型を指定。（この場合、文字列型）
$category_stmt->bindValue(':id', $category, PDO::PARAM_STR);
//prepareしているSQL文を実行
$category_stmt->execute();
/*
fetchメソッドでクエリの実行結果を取得
PDO::FETCH_ASSOCにより、連想配列として結果を取得することを指定
カラム名をキーとして、アクセス可能
*/
$category_result = $category_stmt->fetch(PDO::FETCH_ASSOC);

//TODO:起きたエラー:$category_idがみつからない
//TODO:解決→データベース内のカテゴリー名と、htmlのoptionタグのvalueを同じ表記に変更
//category_result確認用のコード
if (!$category_result) {
  exit('Category_resultが見つかりません');
}
$category_id = $category_result['id'];
//var_dump(category_id) //array(1) { ["id"]=> int(2) }


// 難易度IDの取得
$difficulty_stmt = $pdo->prepare('SELECT id FROM difficulty_table WHERE id = :id');
$difficulty_stmt->bindValue(':id', $difficulty, PDO::PARAM_STR);
$difficulty_stmt->execute();
$difficulty_result = $difficulty_stmt->fetch(PDO::FETCH_ASSOC);
$difficulty_id = $difficulty_result['id'];

// SQL作成&実行

//TODO:起きたエラー:answerカラムに不正な整数値が入力
//エラー文:Incorrect integer value: 'a' for column `gs_db_work`.`quiz_table`.`answer` at row 1"}
//TODO:解決→データベース内のカテゴリー名と、htmlのoptionタグのvalueを同じ表記に変更
$sql = 'INSERT INTO quiz_table (category_id, difficulty_id, question, option1, option2, option3, option4, answer, explanation, created_at,updated_at) VALUES (:category_id, :difficulty_id, :quiz, :A_1, :A_2, :A_3, :A_4, :answer, :explanation, now(),now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$stmt->bindValue(':difficulty_id', $difficulty_id, PDO::PARAM_INT);
$stmt->bindValue(':quiz', $quiz, PDO::PARAM_STR);
$stmt->bindValue(':A_1', $A_1, PDO::PARAM_STR);
$stmt->bindValue(':A_2', $A_2, PDO::PARAM_STR);
$stmt->bindValue(':A_3', $A_3, PDO::PARAM_STR);
$stmt->bindValue(':A_4', $A_4, PDO::PARAM_STR);
$stmt->bindValue(':answer', $Answer, PDO::PARAM_STR);
$stmt->bindValue(':explanation', $explanation, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 実行後の処理
if ($status) {
  header("Location: quiz_input.php");
} else {
  exit('InsertError');
}
