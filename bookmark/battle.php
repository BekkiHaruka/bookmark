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

    $id = $_GET['id'];

    if ($conn) {
        // ユーザーデータベースを選択
        mysql_select_db('user_db',$conn);

        // ユーザーデータベースからの取り出しSQL文
        $name = 'SELECT user_name FROM user_tb WHERE user_id = "' . $id . '"';

        // ユーザーSQL文の実行
        $query_name = mysql_query($name,$conn);
    }

    if ($conn) {
        // ブックマークデータベースを選択
        mysql_select_db('sample_db',$conn);

        // ブックマークデータベースからの取り出しSQL文
        $sum_my = 'SELECT SUM(likes) as likes, SUM(favorite) as favorite FROM bookmark_tb WHERE user_name = "' . $_SESSION['name'] . '"';
        $sum_enemy = 'SELECT user_name,SUM(likes) as likes, SUM(favorite) as favorite FROM bookmark_tb WHERE user_id ="' . $id .'"';

        // ブックマークSQL文の実行
        $query_my = mysql_query($sum_my,$conn);
        $result_my = mysql_fetch_array($query_my, MYSQL_ASSOC);

        $query_enemy = mysql_query($sum_enemy,$conn);
        $result_enemy = mysql_fetch_array($query_enemy, MYSQL_ASSOC);
    }

        $my_hp = $result_enemy['likes']-$result_my['favorite'];
        $enemy_hp = $result_my['likes']-$result_enemy['favorite'];

    if(abs($result_enemy['likes']) > abs($result_my['favorite'])){
        $my_hp = -abs($my_hp);
    }elseif(abs($result_enemy['likes']) < abs($result_my['favorite'])){
        $my_hp = abs($my_hp);
    }

    if(abs($result_my['likes']) > abs($result_enemy['favorite'])){
        $enemy_hp = -abs($enemy_hp);
    }elseif(abs($result_enemy['likes']) < abs($result_my['favorite'])){
        $enemy_hp = abs($enemy_hp);
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ブックマーク</title>
    </head>
    <body>
        Login: <b><?php echo $_SESSION['name']; ?></b>
        <br>
        <hr>
        ■<b><?php echo $result_enemy['user_name']; ?></b>さんとの対戦結果<br>
        <br>
        ■<b><?php echo $_SESSION['name']; ?></b>の対戦データ
        <table border=1>
            <tr bgcolor="#CCCCCC">
                <td>ユーザー名</td>
                <td>攻撃力（いいねされた総数）</td>
                <td>防御力（お気に入りされた総数</td>
            </tr>
            <?php
                // データの取り出し
                    echo '<tr>';
                    echo '<td>' . $_SESSION['name'] .'</td>';
                    echo '<td>' . $result_my['likes'],"pt" .'</td>';
                    echo '<td>' . $result_my['favorite'],"pt" .'</td>';
                    echo '</tr>';
            ?>
            </table>
        <br>
        ■<b><?php echo $result_enemy['user_name']; ?></b>さんの対戦データ
        <table border=1>
            <tr bgcolor="#CCCCCC">
                <td>ユーザー名</td>
                <td>攻撃力（いいねされた総数）</td>
                <td>防御力（お気に入りされた総数)</td>
            </tr>
        <br>
            <?php
                // データの取り出し
                    echo '<tr>';
                    echo '<td>' . $result_enemy['user_name'] .'</td>';
                    echo '<td>' . $result_enemy['likes'],"pt" .'</td>';
                    echo '<td>' . $result_enemy['favorite'],"pt" .'</td>';
                    echo '</tr>';
            ?>
        </table>
        <br>
        ■勝敗<br>
        ①<?php echo $_SESSION['name']; ?>さんの攻撃力<b><?php echo $result_my['likes']; ?></b><br>
            vs<br>
        <?php echo $result_enemy['user_name']; ?>さんの防御力<b><?php echo $result_enemy['favorite']; ?></b><br>
        →<?php echo $result_enemy['user_name']; ?>さんの残り体力<b><?php echo $enemy_hp; ?></b><br>
        <br>
        ②<?php echo $result_enemy['user_name']; ?>さんの攻撃力<b><?php echo $result_enemy['likes']; ?></b><br>
            vs<br>
        <?php echo $_SESSION['name']; ?>さんの防御力<b><?php echo $result_my['favorite']; ?></b><br>
        →<?php echo $_SESSION['name']; ?>さんの残り体力<b><?php echo $my_hp; ?></b><br>
        <br>
        <?php
        if($enemy_hp > $my_hp){
            $winner = $result_enemy['user_name'];
        } elseif($enemy_hp < $my_hp){
            $winner = $_SESSION['name'];
        }
        ?>
        <b><?php
            if (empty($winner)){
                echo '＜＜＜引き分け＞＞＞';
            } else {
                echo '＜＜＜'.$winner.'さんの勝ち＞＞＞';
            }
            ?></b>
        <br>
        <br>
        <a href ="check_bookmark.php"> ブックマーク確認ページへ戻る </a>
        <br>
    </body>
</html>
