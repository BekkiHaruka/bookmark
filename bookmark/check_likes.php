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

    $likes = $_POST['bookmark_id'];
    $name = $_POST['user_name'];

    if ($conn) {
        // ブックマークデータベースを選択
        mysql_select_db('sample_db',$conn);

        // ブックマークデータベースの更新SQL文
        $sql_likes = 'UPDATE bookmark_tb
                SET likes = likes+1
                WHERE bookmark_id = ' . $likes;

        // いいねSQL文の実行
        $query_likes = mysql_query($sql_likes, $conn);
    }

    header('Location:check_bookmark.php?name='.$name);
?>
