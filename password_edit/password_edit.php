<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: ../Logout.php");
    exit;
}
?>
<?php
include '../DB.php';


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>マスター管理</title>
        <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="pass_edit.js"></script>
        <link rel="stylesheet" type="text/css" href="../master_general.css">
    </head>
    <body link="blue" vlink="blue">
        <!-- サイドメニュー -->
        <?php include '../include_file/side_menu.php'; ?>
        
        <!-- イベント通知 -->
        <div class="event_notice">
            <center><font size="10px">パスワード変更：</font><font size="10px" id="userid"><?php echo htmlspecialchars($_SESSION["USERID"], ENT_QUOTES); ?></font></center>
        </div>
   
        <!-- ログ-ログイン者名表示 -->
        <div class="log_login">
            <div class="user_name" ><font size="5px" id="username"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></font><font size="5px">さん</font></div>
        </div>
        

        <!-- メイン -->
        <div class="main">
            <div id="log" style="margin-left: auto; margin-right: auto; margin-top:25px;" ></div>
            <div style="margin-top:55px">
                <p><center  style="margin-top:8px;">旧パスワード：<input type="password" id="old_password" name="password" value="" placeholder="パスワードを入力"></center></p>
                <p><center>新パスワード：<input type="password" id="new_password" name="password" value="" placeholder="パスワードを入力"></center></p>
                <p><center>再度新パスワード：<input type="password" id="new2_password" name="password" value="" placeholder="パスワードを入力"></center></p>
                <center><input type="button" id="pass_edit"  value="変更"></center>
            </div>
            <div class="hoge"></div>   
        </div>
    </body>
</html>
