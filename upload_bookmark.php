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
<a href="menu_bookmark.php"> 【メニュー】 </a>
<a href="logout.php"> 【ログアウト】 </a>
<hr>
■ブックマーク情報を入力してください。<br>
<form action="insert_bookmark.php" method="POST">
タイトル：<br>
<input type="text" name="title" size="50">
<br><br>
URL：<br>
<textarea name="url" cols="40" rows="5"></textarea>
<br><br>
<input type="submit" value="ブックマークの登録">
</form>
</body>
</html>
