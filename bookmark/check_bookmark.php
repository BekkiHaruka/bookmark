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

    if (empty($_GET)){
        $id = $_SESSION['id'];
    } else {
        $id = $_GET['id'];
    }

    if ($conn) {
        // ブックマークデータベースを選択
        mysql_select_db('sample_db',$conn);

        // ブックマークデータベースからの取り出しSQL文
        $sql_bookmark = 'SELECT bookmark_id,bookmark_title,url,user_name,likes,favorite,user_id
                FROM bookmark_tb
                WHERE user_id = "' . $id . '"';

        // ブックマークSQL文の実行
        $query_bookmark = mysql_query($sql_bookmark, $conn);
    }

    if ($conn) {
        // ユーザーデータベースを選択
        mysql_select_db('user_db',$conn);
        // ユーザーデータベースからの取り出しSQL文
        $sql_user = 'SELECT user_id,user_name FROM user_tb';

        $sql_battle = 'SELECT user_id,user_name FROM user_tb';

        $name = 'SELECT user_name FROM user_tb WHERE user_id = "' . $id . '"';

        // ユーザーSQL文の実行
        $query_user = mysql_query($sql_user,$conn);

        $query_battle = mysql_query($sql_battle,$conn);

        $query_name = mysql_query($name,$conn);
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
        ■<b><?php
                $row_name = mysql_fetch_object($query_name);
                echo $row_name->user_name; ?></b>さんのブックマーク一覧<br>
        <table border=1>
            <tr bgcolor="#CCCCCC">
                <td>ID</td>
                <td>タイトル</td>
                <td>URL</td>
                <td>いいね</td>
                <td>いいねされた数</td>
                <td>お気に入りする</td>
                <td>お気に入りされた数</td>
            </tr>
            <?php
                // データの取り出し
                while($row_bookmark = mysql_fetch_object($query_bookmark)) {
                    echo '<tr>';
                    echo '<td>' . $row_bookmark->bookmark_id .'</td>';
                    echo '<td>' . $row_bookmark->bookmark_title .'</td>';
                    echo '<td>' . $row_bookmark->url .'</td>';
                    echo '<td>' . '<form action="check_likes.php" method="POST"><input type="hidden" name="bookmark_id" value="'.$row_bookmark->bookmark_id.'"><input type="hidden" name="user_name" value="'.$name.'"><input type="submit" value="いいね"></form>' .'</td>';
                    echo '<td>' . $row_bookmark->likes,"件のいいね" .'</td>';
                    echo '<td>' . '<form action="check_favorite.php" method="POST"><input type="hidden" name="bookmark_id" value="'.$row_bookmark->bookmark_id.'"><input type="hidden" name="user_name" value="'.$name.'"><input type="submit" value="お気に入り"></form>' .'</td>';
                    echo '<td>' . $row_bookmark->favorite,"件のお気に入り" .'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <br>
        <br>
        ■他のユーザーのブックマーク<br>
        <?php
            while($row_user = mysql_fetch_object($query_user)){
                echo '<a href="check_bookmark.php?id=' . $row_user->user_id . '">' . $row_user->user_name,"のブックマーク" . '</a>';
                echo '<br>';
            }
        ?>
        <br>
        <br>
        ■他のユーザーと対戦する<br>
        <?php
        while($row_battle = mysql_fetch_object($query_battle)){
                echo '<a href="battle.php?id=' . $row_battle->user_id . '">' . $row_battle->user_name,"と対戦" . '</a>';
                echo "<br>";
            }
        ?>
    </body>
</html>
