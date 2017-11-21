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
       
       // データベースからの取り出しSQL文
       $sql = 'SELECT bookmark_id,bookmark_title,url,user_name,entry_date
              FROM bookmark_tb
              ORDER BY bookmark_id';

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
■ブックマーク一覧<br>
<table border=1>
<tr bgcolor="#CCCCCC">
<td>ID</td>
<td>タイトル</td>
<td>URL</td>
<td>ユーザー</td>
<td>登録日</td>
</tr>
<?php
    // データの取り出し
    while($row=mysql_fetch_object($query)) {
       echo '<tr>';
       echo '<td>' . $row->bookmark_id .'</td>';
       echo '<td>' . $row->bookmark_title .'</td>';
       echo '<td>' . nl2br($row->url) .'</td>';
       echo '<td>' . $row->entry_date .'</td>';
       echo '</tr>';
     }
?>
</table>
</body>
</html>
