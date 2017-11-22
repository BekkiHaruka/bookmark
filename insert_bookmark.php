<?php
    // セッションの復元
    session_start();

    // ログインチェック
    require_once 'check_login_bookmark.php';

    // タイトル、URL
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $url = htmlspecialchars($_POST['url'], ENT_QUOTES);

    // MySQLへの接続
    $conn = mysql_connect('localhost','sample_user','sample_pass');

    if ($conn) {
        // データベースの選択
        mysql_select_db('sample_db',$conn);
        
        // データベースへ書き込むSQL文
        $sql = 'INSERT INTO bookmark_tb
               (bookmark_title,url,user_name)
               VALUES
               ("' . $title . '","' . $url. '","' .
               $_SESSION['name'] . '")';

        // SQL文の実行
        $query = mysql_query($sql, $conn);
    }
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
■ブックマークを登録しました。<br>

<br><br>
<a href="check_bookmark.php">ブックマークを確認</a>
</body>
</html> 
