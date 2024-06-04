<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型Quiz作成</title>
</head>

<body>
  <form action="./quiz_create.php" method="POST">
    <fieldset>
      <legend>DB連携型Quiz作成</legend>
      <a href="quiz_read.php">一覧画面</a>
      <div>
     ジャンル: <select name="category" id="category">
        <option value="動物">動物</option>
        <option value="歴史">歴史</option>
     </select>
      </div>
      <div>
        難易度: <select name="difficulty" id="difficulty">
            <option value="初級">初級</option>
            <option value="中級">中級</option>
            <option value="上級">上級</option>
            </select>
      </div>
      問題文: <input type="textarea" name="quiz">
      <div>
        選択肢1: <input type="text" name="A_1">
        選択肢2: <input type="text" name="A_2">
        選択肢3: <input type="text" name="A_3">
        選択肢4: <input type="text" name="A_4">
        正解: <select name="answer" id="answer">
           <option value="1">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
           <option value="4">4</option>
        </select>
        解説:<input type="textarea" name="explanation">
        <button>submit</button>
      </div>
    </fieldset>
  </form>
</body>
</html>