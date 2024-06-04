<?php
$dbn ='mysql:dbname=gs_DB_work;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';


// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// SQL作成&実行

// SQL作成&実行
$sql = 'SELECT * FROM quiz_table';

$stmt = $pdo->prepare($sql);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
//SQL文の実行が成功したかがわかる
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

 shuffle($result);
$random_result = array_slice($result, 0, 10);
//array_randだと、順番が昇順の範囲でしかランダムにできない
//  $random_keys = array_rand($result, 10);
//$random_resultの配列確認

// echo "<pre>";
// var_dump($random_result);
// echo"</pre>";
// exit();

// $output = "";
// foreach ($result as $record) {
// //$outputに文字列を追加する
//   $output .= "
//     <tr>
//       <td>問題:{$record["question"]}</td>
//     </tr>
//     <tr>
//       <td>1:{$record["option1"]}</td>
//       <td>2:{$record["option2"]}</td>
//       <td>3:{$record["option3"]}</td>
//       <td>4:{$record["option4"]}</td>
//     </tr>
//   ";}
   
  //  var_dump($output);
  //  exit();
 ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz画面</title>
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


    #title_Screen {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    #title_Screen h1 {
      font-size: 36px;
      margin-bottom: 10px;
      color: #007BFF;
    }

    #title_Screen p {
      font-size: 24px;
      margin-bottom: 20px;
    }

     .button-container {
      display: flex;
      justify-content: center;
    }

    .difficulty-btn {
      background-color: #007BFF;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      margin: 20px;
      transition: background-color 0.3s;
    }

    .difficulty-btn:hover {
      background-color: #0056b3;
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
/* body {
  font-family: 'Arial', sans-serif;
  background-color: #f4f4f9;
  color: #333;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

#quiz_Rest {
  background: #fff;
  padding: 20px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  max-width: 600px;
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
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
  max-width: 600px;
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
  font-size: 18px;
  margin: 10px 0;
  cursor: pointer;
  padding: 10px;
  border: 1px solid #007BFF;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
  font-style: italic; /* フォントをイタリックに変更 */
  /* color: #555; /* テキストカラーを変更 */
/* } */

/* li:hover {
  background-color: #007BFF;
  color: #fff;
} */

  /* body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  #quiz_Screen {
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    max-width: 800px;
    width: 100%;
  }

  h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #007BFF;
  }

  ol {
    padding-left: 20px;
  }

  li {
    font-size: 18px;
    margin: 10px 0;
    cursor: pointer;
    list-style-type: decimal;
  }

  li:hover {
    background-color: #e9ecef;
    padding: 5px;
    border-radius: 5px;
  } */

  /* button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 20px;
  } */

  /* button:hover {
    background-color: #0056b3;
  } */
</style>

</head>

<body>
    <div id="title_Screen">
    <h1>クイズゲーム１</h1>
    <p>ジャンル:動物</p>
    <div class="button-container">
    <button class="difficulty-btn" onclick="startGame('初級')">初級</button>
    <button class="difficulty-btn" onclick="startGame('中級')">中級</button>
    <button class="difficulty-btn" onclick="startGame('上級')">上級</button>
  </div>
  </div>
   <div id="quiz_Rest" style="display:none;"></div>
  <div id="quiz_Screen" style="display:none;"></div>
  <div id="result"></div>
  <div id="result_Screen" style="display: none;"></div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
// let data=
// console.log(data);
// //問題をランダムに指定
//  let create_Quiz=Math.floor(Math.random()*data.length);
//  //画面に表示する問題の情報
//  let Quiz=data[create_Quiz];
// // console.log(Quiz);
//  //取り出した問題文
//  let create_Q=Quiz.question;
// //  console.log(create_Q);
//  //選択肢1
//  let create_OP_1=Quiz.option1;
// //  console.log(create_OP_1);
//  //選択肢2
//  let create_OP_2=Quiz.option2;
// //  console.log(create_OP_2);
//  //選択肢3
//  let create_OP_3=Quiz.option3;
// //  console.log(create_OP_3);
//  //選択肢4
//  let create_OP_4=Quiz.option4;
// //  console.log(create_OP_4);
// //問題を作る関数
// function Quiz_Recreate(){
//     //次の問題を用意
// create_Quiz=Math.floor(Math.random()*data.length);

// Quiz=data[create_Quiz];
// //問題文
//  create_Q=Quiz.question;
// //選択肢1
//  create_OP_1=Quiz.option1;
//  //選択肢2
//  create_OP_2=Quiz.option2;
//  //選択肢3
//  create_OP_3=Quiz.option3;
//  //選択肢4
//  create_OP_4=Quiz.option4;
//  //問題を画面に表示させる
// $("#quiz_Screen").append(`<h1>${create_Q}</h1><ol><li>${create_OP_1}</li><li>${create_OP_2}</li><li>${create_OP_3}</li><li>${create_OP_4}</li></ol>`)
// }
// Quiz_Recreate();
// //回答ボタンがおされた時の処理
// $("#send").click
// (()=>{data.splice(create_Quiz,1)
// if(data.length!==0){
//   $("#quiz_Screen").empty();
//   //次の問題を表示
// Quiz_Recreate();
// }else
// //全ての問題が終わった時
// {

// }
// });
//  let data =
//     console.log(data);
//     let create_Quiz = Math.floor(Math.random() * data.length);
//     let Quiz = data[create_Quiz];
//     let create_Q = Quiz.question;
//     let create_OP_1 = Quiz.option1;
//     let create_OP_2 = Quiz.option2;
//     let create_OP_3 = Quiz.option3;
//     let create_OP_4 = Quiz.option4;
//     let count_Quiz=1;

//     function Quiz_Recreate() {
//       create_Quiz = Math.floor(Math.random() * data.length);
//       Quiz = data[create_Quiz];
//       create_Q = Quiz.question;
//       create_OP_1 = Quiz.option1;
//       create_OP_2 = Quiz.option2;
//       create_OP_3 = Quiz.option3;
//       create_OP_4 = Quiz.option4;
//     }

//     function handleAnswer() {
//       data.splice(create_Quiz, 1);
//       if (data.length !== 0) {
//         count_Quiz++;
//         Quiz_Recreate();
//         $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
//         $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li>1.${create_OP_1}</li><li>2.${create_OP_2}</li><li>3.${create_OP_3}</li><li>4.${create_OP_4}</li></ol>`);
//         $("li").click(handleAnswer);
//         console.log(Quiz);
//       } else {
//         console.log("finish");
//       }
//     }
// $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
//     $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li>1.${create_OP_1}</li><li>2.${create_OP_2}</li><li>3.${create_OP_3}</li><li>4.${create_OP_4}</li></ol>`);
//     $("li").click(handleAnswer);
    // let data = ;
    // console.log(data);
    // let create_Quiz = Math.floor(Math.random() * data.length);
    // let Quiz = data[create_Quiz];
    // let create_Q = Quiz.question;
    // let create_OP_1 = Quiz.option1;
    // let create_OP_2 = Quiz.option2;
    // let create_OP_3 = Quiz.option3;
    // let create_OP_4 = Quiz.option4;
    // let count_Quiz = 1;

    // function Quiz_Recreate() {
    //   create_Quiz = Math.floor(Math.random() * data.length);
    //   Quiz = data[create_Quiz];
    //   create_Q = Quiz.question;
    //   create_OP_1 = Quiz.option1;
    //   create_OP_2 = Quiz.option2;
    //   create_OP_3 = Quiz.option3;
    //   create_OP_4 = Quiz.option4;
    // }

    // function displayResult(correct) {
    //   const resultDiv = $("#result");
    //   if (correct) {
    //     resultDiv.html('<div class="circle"></div>');
    //   } else {
    //     resultDiv.html('<div class="cross"></div>');
    //   }
    //   resultDiv.show();
    //   setTimeout(() => {
    //     resultDiv.hide();
    //     if (data.length !== 0) {
    //       count_Quiz++;
    //       Quiz_Recreate();
    //       $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
    //       $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
    //       $("li").click(handleAnswer);
    //     } else {
    //       $("#quiz_Rest").html('<h1>クイズ終了</h1>');
    //       $("#quiz_Screen").empty();
    //     }
    //   }, 1000);
    // }

    // function handleAnswer() {
    //   const selectedOption = $(this).data('option');
    //   const correctAnswer = Quiz.answer;
    //   const correct = selectedOption == correctAnswer;
    //   displayResult(correct);
    //   data.splice(create_Quiz, 1);
    // }

    // $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
    // $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
    // $("li").click(handleAnswer);
    let data = <?= json_encode($random_result) ?>;
    console.log(data);
    let create_Quiz = Math.floor(Math.random() * data.length);
    let Quiz = data[create_Quiz];
    let create_Q = Quiz.question;
    let create_OP_1 = Quiz.option1;
    let create_OP_2 = Quiz.option2;
    let create_OP_3 = Quiz.option3;
    let create_OP_4 = Quiz.option4;
    let count_Quiz = 1;
    let correctCount = 0;
    let history = [];


    function startGame(difficulty) {
      console.log("Selected Difficulty:", difficulty);
      $('#title_Screen').hide();
      $('#quiz_Rest').show();
      $('#quiz_Screen').show();
      Quiz_Recreate();
    }

    function Quiz_Recreate() {
      create_Quiz = Math.floor(Math.random() * data.length);
      Quiz = data[create_Quiz];
      create_Q = Quiz.question;
      create_OP_1 = Quiz.option1;
      create_OP_2 = Quiz.option2;
      create_OP_3 = Quiz.option3;
      create_OP_4 = Quiz.option4;
    }

    function displayResult(correct) {
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
        if (data.length !== 0) {
          count_Quiz++;
          Quiz_Recreate();
          $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
          $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
          $("li").click(handleAnswer);
        } else {
          $("#quiz_Rest").html('<h1>クイズ終了</h1>');
          $("#quiz_Screen").empty();
          displayFinalResult();
        }
      }, 500);
    }

    function handleAnswer() {
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
      data.splice(create_Quiz, 1);
    }

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
 $(document).ready(function() {

      $(".difficulty-btn").click(function() {
        const difficulty = $(this).data("difficulty");
        startGame(difficulty);
      });
    $("#quiz_Rest").html(`<h1>第${count_Quiz}問</h1>`);
    $("#quiz_Screen").html(`<h1>${create_Q}</h1><ol><li data-option="1">${create_OP_1}</li><li data-option="2">${create_OP_2}</li><li data-option="3">${create_OP_3}</li><li data-option="4">${create_OP_4}</li></ol>`);
    $("li").click(handleAnswer);
      });
  </script>
</body>

</html>