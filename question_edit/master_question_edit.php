<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
?>

<?php
include '../DB.php';

// SELECT文を変数に格納
$sql = "SELECT
            year as 年度,
            questnum as 質問番号,
            content as 質問内容,
            questtype as 質問属性
        FROM
            t_questcontent
        ORDER BY odr ASC";

// SQLステートメントを実行し、結果を変数に格納
$stmt = $pdo->query($sql);
 


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
            <center><font size="10px">アンケート：編集</center></font>
        </div>
   
        <!-- ログ-ログイン者名表示 -->
        <div class="log_login">
            <font size="5px"><div class="user_name"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES)."さん"; ?></div></font>
        </div>
        

        <!-- メイン -->
        <div class="main">


            <table class="table_student">
                <thead>
                <tr>
                    <th scope="cols">年度</th>
                    <th scope="cols">質問番号</th>
                    <th scope="cols">質問内容</th>
                    <th scope="cols">質問属性</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                // foreach文で配列の中身を一行ずつ出力
                foreach ($stmt as $row) {
                    // データベースのフィールド名で出力                        
                    echo '<tr>';
                    echo '<td>'. htmlspecialchars($row['年度']).'</td>';
                    echo '<td>'. htmlspecialchars($row['質問番号']).'</td>';
                    echo '<td>'. htmlspecialchars($row['質問内容']).'</td>';
                    echo '<td>'. htmlspecialchars($row['質問属性']).'</td>';
                    echo '</tr>';
                }

                ?>
                </tbody>
            </table>                      
        </div>
    </body>
</html>
