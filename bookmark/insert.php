    <html>
    <meta charset="utf-8">
    <head>
    <title>ログインユーザー追加ページ</title>
    </head>
    <body>
    <?php
    $conn = mysql_connect('localhost','sample_user','sample_pass');

    $db_selected = mysql_select_db('sample_db',$conn);

    mysql_set_charset('utf8');

    $user_name = $_POST['user_name'];
    $login_name = $_POST['login_name'];
    $login_password = $_POST['login_password'];

    $sql = "INSERT INTO user_tb (login_name,login_password,user_name)
            VALUES ('$login_name','$login_password','$user_name')";

    $result_flag = mysql_query($sql);

    if(empty($result_flag)){
    echo 'ユーザー登録に失敗しました。<br>すでに同じユーザー名が使用されています。<br><br><a href="add.html"> 新規登録画面に戻る </a>';
    } else {
    echo $user_name . 'さんを登録しました。<br><br><a href="/bookmark/login.html"> ログイン画面に戻る </a>';
    }
    $close_flag = mysql_close($conn);
    ?>
    </body>
    </html>
