<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>マスター管理</title>
        <link rel="stylesheet" type="text/css" href="../master_general.css">
    </head>
    <body link="blue" vlink="blue">
        <!-- サイドメニュー -->
        <?php include '../include_file/side_menu.php'; ?> 
        
        <!-- イベント通知 -->
        <div class="event_notice">
            <center><font size="10px">アンケート：配信</center></font>
        </div>
   
        <!-- ログ-ログイン者名表示 -->
        <div class="log_login">
            <font size="5px"><div class="user_name"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES)."さん"; ?></div></font>
        </div>
        

        <!-- メイン -->
        <div class="main">
        </div>
    </body>
</html>
