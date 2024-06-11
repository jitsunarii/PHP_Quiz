<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend>ユーザー登録</legend>
        <form action="register_act.php" method="POST">

            <label for="username">
                <div>
                    <input type="text" name="username" placeholder="ユーザー名" required>
                </div>
                <div>
                    <input type="text" name="lid" id="lid" placeholder="ログインID" required>
                    <span id="lidMessage"></span>
                </div>
                <div>
                    <input type="password" name="lpw" placeholder="ログインパスワード" required>
                </div>
                <button type="submit" id="registerButton">登録</button>
        </form>
    </fieldset>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lid').on('input', function() {
                const lid = $(this).val();
                if (lid.length > 0) {
                    $.ajax({
                        url: 'check_lid.php',
                        type: 'GET',
                        data: {
                            lid: lid
                        },
                        success: function(response) {
                            //レスポンスきてるか確認
                            // console.log(response);
                            if (response == 'NG' && lid.length > 3) {
                                $('#lidMessage').text('このIDは使用できません').css('color', 'red');
                            } else if (response == 'OK' && lid.length > 3) {
                                $('#lidMessage').text('このIDは使用可能です').css('color', 'green');
                            }
                        }
                    });
                } else {
                    $('#lidMessage').text('');
                }
                if (lid.length <= 3) {
                    $('#registerButton').prop('disabled', true);
                    $('#lidMessage').text('IDは4文字以上必要です').css('color', 'red');
                } else {
                    $('#registerButton').prop('disabled', false);
                }
            });
        });
    </script>
</body>

</html>


</html>