<!-- <!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz作成</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    fieldset {
      border: none;
    }

    legend {
      font-size: 24px;
      margin-bottom: 10px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    select,
    input[type="text"],
    input[type="textarea"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    select {
      cursor: pointer;
    }

    a {
      display: block;
      margin-bottom: 10px;
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <form action="./quiz_create.php" method="POST">
    <fieldset>
      <legend>Quiz作成</legend>
      <a href="quiz_select.php">タイトル画面</a>
      <div>
        <label for="category">ジャンル:</label>
        <select name="category" id="category">
          <option value="1">動物</option>
          <option value="2">歴史</option>
          <option value="3">ゲーム</option>
          <option value="4">格闘ゲーム</option>
          <option value="5">ストリートファイター</option>
          <option value="6">週刊少年ジャンプ</option>
        </select>
      </div>
      <div>
        <label for="difficulty">難易度:</label>
        <select name="difficulty" id="difficulty">
          <option value="1">初級</option>
          <option value="2">中級</option>
          <option value="3">上級</option>
        </select>
      </div>
      <label for="quiz">問題文:</label>
      <input type="textarea" name="quiz" id="quiz">
      <div>
        <div>
          <div>
            <label for="A_1">選択肢1:</label>
            <input type="text" name="A_1" id="A_1">
          </div>
          <div>
            <label for="A_2">選択肢2:</label>
            <input type="text" name="A_2" id="A_2">
          </div>
          <div>
            <label for="A_3">選択肢3:</label>
            <input type="text" name="A_3" id="A_3">
          </div>
          <div>
            <label for="A_4">選択肢4:</label>
            <input type="text" name="A_4" id="A_4">
          </div>
        </div>
        <div>
          <label for="answer">正解:</label>
          <select name="answer" id="answer">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="explanation">解説:</label>
          <input type="textarea" name="explanation" id="explanation">
        </div>
        <button type="submit">クイズを保存</button>
      </div>
    </fieldset>
  </form>
</body>

</html> -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz作成</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f8ff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 800px;
      overflow-y: auto;
      max-height: 90vh;
    }

    fieldset {
      border: none;
      margin-bottom: 20px;
    }

    legend {
      font-size: 24px;
      margin-bottom: 10px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    select,
    input[type="text"],
    input[type="textarea"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    select {
      cursor: pointer;
      width: auto;
    }

    a {
      display: block;
      margin-bottom: 10px;
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <form action="./quiz_create.php" method="POST">
    <fieldset>
      <legend>Quiz作成</legend>
      <a href="quiz_select.php">TOPに戻る</a>
      <div>
        <label for="category">ジャンル:</label>
        <select name="category" id="category">
          <option value="1">動物</option>
          <option value="2">歴史</option>
          <option value="3">ゲーム</option>
          <option value="4">格闘ゲーム</option>
          <option value="5">ストリートファイター</option>
          <option value="6">週刊少年ジャンプ</option>
        </select>
      </div>
      <div>
        <label for="difficulty">難易度:</label>
        <select name="difficulty" id="difficulty">
          <option value="1">初級</option>
          <option value="2">中級</option>
          <option value="3">上級</option>
        </select>
      </div>
    </fieldset>

    <!-- Quiz fields -->
    <div id="quizzes">
      <fieldset>
        <legend>問題1</legend>
        <div>
          <label for="quiz_1">問題文:</label>
          <input type="textarea" name="quiz_1" id="quiz_1">
        </div>
        <div>
          <label for="A_1_1">選択肢1:</label>
          <input type="text" name="A_1_1" id="A_1_1">
        </div>
        <div>
          <label for="A_1_2">選択肢2:</label>
          <input type="text" name="A_1_2" id="A_1_2">
        </div>
        <div>
          <label for="A_1_3">選択肢3:</label>
          <input type="text" name="A_1_3" id="A_1_3">
        </div>
        <div>
          <label for="A_1_4">選択肢4:</label>
          <input type="text" name="A_1_4" id="A_1_4">
        </div>
        <div>
          <label for="answer_1">正解:</label>
          <select name="answer_1" id="answer_1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="explanation_1">解説:</label>
          <input type="textarea" name="explanation_1" id="explanation_1">
        </div>
      </fieldset>
      <!-- Repeat the above fieldset for question 2 to 10 -->
      <!-- Template for one more question (copy and modify for questions 2-10) -->
      <fieldset>
        <legend>問題2</legend>
        <div>
          <label for="quiz_2">問題文:</label>
          <input type="textarea" name="quiz_2" id="quiz_2">
        </div>
        <div>
          <label for="A_2_1">選択肢1:</label>
          <input type="text" name="A_2_1" id="A_2_1">
        </div>
        <div>
          <label for="A_2_2">選択肢2:</label>
          <input type="text" name="A_2_2" id="A_2_2">
        </div>
        <div>
          <label for="A_2_3">選択肢3:</label>
          <input type="text" name="A_2_3" id="A_2_3">
        </div>
        <div>
          <label for="A_2_4">選択肢4:</label>
          <input type="text" name="A_2_4" id="A_2_4">
        </div>
        <div>
          <label for="answer_2">正解:</label>
          <select name="answer_2" id="answer_2">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <div>
          <label for="explanation_2">解説:</label>
          <input type="textarea" name="explanation_2" id="explanation_2">
        </div>
      </fieldset>
      <!-- Continue adding more fieldsets up to question 10 -->
    </div>
    <button type="submit">クイズを保存</button>
  </form>
</body>

</html>