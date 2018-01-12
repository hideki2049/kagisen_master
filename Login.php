<?php

//require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

include 'DB.php';

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
//        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
//            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT
                                    u.USERID,
                                    t.NAME,
                                    u.PASS,
                                    u.USERTYPE,
                                    u.AUTHORITYCD
                                  FROM
                                    t_user u,
                                    m_teacher t
                                  WHERE
                                    u.USERID = t.TEACHERCD
                                  AND
                                    u.USERID = ?');
            $stmt->execute(array($userid));
            
            $password = $_POST["password"];
            
           
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($password === $row["PASS"]) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['USERID'];
                    $sql = "SELECT
                                u.USERID,
                                t.NAME,
                                u.PASS,
                                u.USERTYPE,
                                u.AUTHORITYCD
                            FROM
                                T_USER u,
                                M_TEACHER t
                            WHERE
                                u.USERID = t.TEACHERCD
                            AND
                                u.USERID = '".$id."'";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['NAME'];
                    $_SESSION["USERID"] = $row['USERID'];
                    // 一般か管理者かで画面遷移
                    
                    $type = $row['AUTHORITYCD'];
                    if($type != 0){
                        header("Location: general.php");  // 一般画面へ遷移

                    }else{
                        header("Location: master.php");  // 管理者画面へ遷移

                    }
                    
                    exit();  // 処理終了
                } else {
                    
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';

                    
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';

            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
        <style>
            #loginForm{
                margin-top:15%;
            }
            
        </style>
    <body>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <p><center><font color='black' size=12>ログイン</font></center></p>
            <div><center><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></center></div>
            <p><center>ログインID：<input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>"></center></p>
            <p><center>パスワード：<input type="password" id="password" name="password" value="" placeholder="パスワードを入力"></center></p>
            <center><input type="submit" id="login" name="login" value="ログイン" onclick="" ></center>
        </form>

    </body>
</html> 