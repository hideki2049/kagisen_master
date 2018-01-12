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
        <title>一般管理</title>
        <link rel="stylesheet" type="text/css" href="master_general.css">
    </head>
    <body link="blue" vlink="blue">
        <!-- サイドメニュー -->
        <div class="side_menu">
            <div class="home_button">
                <a href="general.php" style="text-decoration:none;">ホーム</a>
            </div>





            <div class="host reference_button">
                <text style="text-decoration:none;">アンケート参照</text>
            </div>
            <div class="sub">
                <a href="questionnaire_results/questionnaire_results.php">|-集計</a>
            </div>
            <div class="logout_button" style="width: 100%; height: 100%; margin-top: 200%;">
                <a href="Logout.php" style="text-decoration:none;">ログアウト</a>
            </div>
        </div>

        <!-- イベント通知 -->
        <div class="event_notice">
            <center><font size="10px">general</center></font>
        </div>

        <!-- ログ-ログイン者名表示 -->
        <div class="log_login">
            <font size="5px"><div class="user_name"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES)."さん"; ?></div></font>
        </div>


        <!-- メイン -->
        <div class="main">
<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;
showPrint=0&amp;
showTabs=0&amp;
showCalendars=0&amp;
showTz=0&amp;
height=600&amp;
wkst=1&amp;bgcolor=%23FFFFFF&amp;
src=ja.japanese%23holiday%40group.v.calendar.google.com&amp;
color=%232F6309&amp;
ctz=Asia%2FTokyo" style="border-width:0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
        </div>
    </body>
</html>
