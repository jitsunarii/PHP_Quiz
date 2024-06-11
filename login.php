<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend>ログイン画面</legend>
        <form action="./login_act.php" method="POST">
            <div>
                <input type="text" name="lid" placeholder="ログインID">
            </div>
            <div>
                <input type="password" name="lpw" placeholder="ログインパスワード">
            </div>
            <button text="submit">ログイン</button>
        </form>
    </fieldset>
</body>

</html>