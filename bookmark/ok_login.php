<?php
    // セッションの復元
    session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ログイン</title>
</head>
<body>
<?php
    // ログイン確認
    if ($_SESSION['login'] == 'OK') {
        // ログイン成功
        echo '■ログイン中です。';
        echo '<br><br>';
        echo '接続ユーザー：' . $_SESSION['name'];
    } else {
        // ログイン失敗
        echo '■ログインしていません。';
    }
?> 
</body>
</html>
