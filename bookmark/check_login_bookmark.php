<?php
    // セッションの復元
    session_start();

    // ログインチェック
    if (isset($_SESSION['login']) && $_SESSION['login'] != 'OK') {
        // ログインしていないメッセージを表示する
echo <<< EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ブックマーク</title>
</head>
<body>
■ログインに失敗しました。
<br><br>
<a href="login.html">ログイン画面を開く</a>
</body>
</html>
EOT;


        // 終了
        exit();
    }
?>
