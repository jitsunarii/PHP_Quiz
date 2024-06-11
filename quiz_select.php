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

    .category {
      width: 800px;
      height: 200px;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      margin-top: 10px;
      background-color: white;
    }

    #title_Screen a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
      font-size: 16px;
    }

    #title_Screen a:hover {
      background-color: #0056b3;
    }
  </style>

</head>

<body>
  <!-- 最初に表示される画面 -->
  <div id="title_Screen">
    <h1>クイズゲーム１</h1>
    <a href="quiz_read.php">保存されている問題の確認</a>
    <div class="category">
      <div id="animal">
        <p>動物</p>
        <div class="button-container">
          <form action="quiz_main.php" method="POST">
            <input type="hidden" name="category" value="1">
            <input type="hidden" name="difficulty" value="1">
            <button type="submit" class="difficulty-btn">初級</button>
          </form>
          <form action="quiz_main.php" method="POST">
            <input type="hidden" name="category" value="1">
            <input type="hidden" name="difficulty" value="2">
            <button type="submit" class="difficulty-btn">中級</button>
          </form>
          <form action="quiz_main.php" method="POST">
            <input type="hidden" name="category" value="1">
            <input type="hidden" name="difficulty" value="3">
            <button type="submit" class="difficulty-btn">上級</button>
          </form>
        </div>
      </div>
    </div>
    <div class="category">
      <p>歴史</p>
      <div class="button-container">
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="2">
          <input type="hidden" name="difficulty" value="1">
          <button type="submit" class="difficulty-btn">初級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="2">
          <input type="hidden" name="difficulty" value="2">
          <button type="submit" class="difficulty-btn">中級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="2">
          <input type="hidden" name="difficulty" value="3">
          <button type="submit" class="difficulty-btn">上級</button>
        </form>
      </div>
    </div>
    <div class="category">
      <p>ゲーム</p>
      <div class="button-container">
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="3">
          <input type="hidden" name="difficulty" value="1">
          <button type="submit" class="difficulty-btn">初級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="3">
          <input type="hidden" name="difficulty" value="2">
          <button type="submit" class="difficulty-btn">中級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="3">
          <input type="hidden" name="difficulty" value="3">
          <button type="submit" class="difficulty-btn">上級</button>
        </form>
      </div>
    </div>
    <div class="category">
      <p>格闘ゲーム</p>
      <div class="button-container">
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="4">
          <input type="hidden" name="difficulty" value="1">
          <button type="submit" class="difficulty-btn">初級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="4">
          <input type="hidden" name="difficulty" value="2">
          <button type="submit" class="difficulty-btn">中級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="4">
          <input type="hidden" name="difficulty" value="3">
          <button type="submit" class="difficulty-btn">上級</button>
        </form>
      </div>
    </div>
    <div class="category">
      <p>ストリートファイター</p>
      <div class="button-container">
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="5">
          <input type="hidden" name="difficulty" value="1">
          <button type="submit" class="difficulty-btn">初級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="5">
          <input type="hidden" name="difficulty" value="2">
          <button type="submit" class="difficulty-btn">中級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="5">
          <input type="hidden" name="difficulty" value="3">
          <button type="submit" class="difficulty-btn">上級</button>
        </form>
      </div>
    </div>
    <div class="category">
      <p>週刊少年ジャンプ</p>
      <div class="button-container">
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="6">
          <input type="hidden" name="difficulty" value="1">
          <button type="submit" class="difficulty-btn">初級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="6">
          <input type="hidden" name="difficulty" value="2">
          <button type="submit" class="difficulty-btn">中級</button>
        </form>
        <form action="quiz_main.php" method="POST">
          <input type="hidden" name="category" value="6">
          <input type="hidden" name="difficulty" value="3">
          <button type="submit" class="difficulty-btn">上級</button>
        </form>
      </div>
    </div>
    <a href="quiz_input.php">オリジナルクイズを作成する</a>
  </div>