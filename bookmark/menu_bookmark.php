<?php
    // セッションの復元
    session_start();

    // ログインチェック
    require_once 'check_login_bookmark.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ブックマーク</title>
</head>
<body>
Login: <b><?php echo $_SESSION['name']; ?></b>
<hr>
<a href="logout.php"> 【ログアウト】 </a>
<hr>
■ブックマークメニュー<br>
<ul>
<li><a href="upload_bookmark.php">ブックマークを登録する</a>
<li><a href="check_bookmark.php">ブックマークを確認する</a>
</ul>
</body>
</html>
