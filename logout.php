<?php
    // セッション開始
    session_start();

    // セッション変数を初期化
    $_SESSION = array();

    // セッションIDを破棄
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-3600, '/');
   }

    // セッションを破棄
    session_destroy();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ログアウト</title>
</head>
<body>
■ログアウトしました。<br>
<br>
セッション情報 ($_SESSION) :
<pre>
<?php
    // $_SESSIONの中身をすべて表示
    print_r($_SESSION);
?>
</pre>
</body>
</html>
