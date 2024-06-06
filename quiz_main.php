<?php
include('functions.php');
//データの確認
// var_dump($_POST);
// exit();
if (
    !isset($_POST["category"]) || $_POST["category"] === '' ||
    !isset($_POST["difficulty"]) || $_POST["difficulty"] === ''
) {
    exit('ParamError');
}


$category = intval($_POST["category"]);
$difficulty = intval($_POST["difficulty"]);

$pdo = connect_to_do();
$sql = 'SELECT * FROM quiz_table WHERE category_id=:category AND difficulty_id=:difficulty';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':difficulty', $difficulty, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// var_dump($result);
// echo "</pre>";
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
            overflow-y: auto;
        }


        #quiz_Rest {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1000px;
            width: 100%;
            text-align: center;
            margin-bottom: 100px;
        }

        #quiz_Rest h1 {
            font-size: 28px;
            margin: 0;
            color: #007BFF;
        }

        #quiz_Screen {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1000px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #007BFF;
        }

        ol {
            padding-left: 0;
            list-style: none;
        }

        li {
            font-size: 25px;
            margin: 60px 0;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-style: italic;
            font-family: 'Georgia', serif;
            color: #555;
        }

        li:hover {
            background-color: #007BFF;
            color: #fff;
        }

        #result {
            margin-top: 20px;
            display: none;
        }

        .circle {
            width: 50px;
            height: 50px;
            border: 3px solid red;
            border-radius: 50%;
        }

        .cross {
            width: 50px;
            height: 50px;
            position: relative;
        }

        .cross::before,
        .cross::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 3px;
            background-color: blue;
        }

        .cross::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .cross::after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        #result_Screen {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1000px;
            width: 100%;
            text-align: left;
            margin-top: 20px;
        }

        #result_Screen h1 {
            font-size: 40px;
            margin-bottom: 20px;
            color: #007BFF;
        }

        #result_Screen .result-block {
            margin-bottom: 20px;
        }

        #result_Screen .result-content {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .correct-text {
            color: red;
        }

        .incorrect-text {
            color: blue;
        }

        #result_Screen h2 {
            font-size: 30px;
            color: #333;
        }

        #result_Screen p {
            font-size: 20px;
            margin: 10px 0;
        }
    </style>

</head>

<body>
    <!-- クイズ画面 -->
    <div id="quiz_Rest"></div>
    <div id="quiz_Screen"></div>
    <div id="result"></div>
    <!-- リザルト画面 -->
    <div id="result_Screen" style="display: none;"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*************************************************************************************************
 変数の設定
**************************************************************************************************/
        // phpからデータをもらう
        let data = <?= json_encode($result) ?>;
        console.log(data);
        //クイズが何問目かカウント(問題数表示用)
        let count_Quiz = 0;
        //クイズに何問正解したかカウント(リザルト画面表示用)
        let correctCount = 0;
        //正解した問題の情報を入れる配列（リザルト画面表示用）
        let history = [];

        let create_Quiz;

        function recreate_Quiz() {
            count_Quiz++;
            let create_Quiz = Math.floor(Math.random() * data.length);
            Quiz = data[create_Quiz];
            create_Q = Quiz.question;
            create_OP_1 = Quiz.option1;
            create_OP_2 = Quiz.option2;
            create_OP_3 = Quiz.option3;
            create_OP_4 = Quiz.option4;
            $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
            $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
            data.splice(create_Quiz, 1);
            $("li").click(after_Answer);
        }

        /****************************************************************************************************************
        関数の設定
        *******************************************************************************************************************/
        //まるかバツを表示→問題表示or終了させる関数
        function displayResult(correct) {
            console.log(data);
            const resultDiv = $("#result");
            if (correct) {
                resultDiv.html('<div class="circle"></div>');
                correctCount++;
            } else {
                resultDiv.html('<div class="cross"></div>');
            }
            resultDiv.show();
            setTimeout(() => {
                resultDiv.hide();
                if (count_Quiz < 10) {
                    recreate_Quiz();
                    // $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
                    // $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
                    // $("li").click(after_Answer);
                } else {
                    $("#quiz_Rest").html('<h1>クイズ終了</h1>');
                    $("#quiz_Screen").empty();
                    displayFinalResult();
                }
            }, 1000);
        }
        //回答した問題を保存,正解不正解を記録する関数
        function after_Answer() {
            $("li").off("click");
            const selectedOption = $(this).data('option');
            const correctAnswer = Quiz.answer;
            const correct = selectedOption == correctAnswer;
            history.push({
                question: create_Q,
                correct: correct,
                answer: Quiz["option" + correctAnswer],
                explanation: Quiz.explanation
            });
            displayResult(correct);

        }
        //リザルト画面を作成する関数
        function displayFinalResult() {
            const resultScreen = $("#result_Screen");
            let resultHtml = `<h1>正答数 ${correctCount}/${count_Quiz} 問</h1>`;
            history.forEach((pick, i) => {
                resultHtml += `<div class="result-block">
          <h2>第${i + 1}問: <span class="${pick.correct ? 'correct-text' : 'incorrect-text'}">${pick.correct ? "正解" : "不正解"}</span></h2>
          <div class="result-content">
          <p>問題: ${pick.question}</p>
          <p>答え: ${pick.answer}</p>
          <p>解説: ${pick.explanation}</p>
          </div>
        </div>`;
            });
            resultScreen.html(resultHtml);
            resultScreen.show();
        }
        /************************************************************************************************************************************
        読み込んだ時の処理
         *************************************************************************************************************************************/
        $(document).ready(function() {
            recreate_Quiz();
        });
    </script>
</body>

</html>