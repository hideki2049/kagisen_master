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
//年度取得
$s_year ="SELECT DISTINCT year FROM t_teacher ORDER BY year DESC";
$setyear = $pdo->query($s_year);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>マスター管理</title>
        <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
        <script src="jquery.cookie.js"></script>
        <script type="text/javascript" src="search_s.js"></script>
        <link rel="stylesheet" type="text/css" href="../master_general.css">
    </head>
    <body link="blue" vlink="blue">
        <!-- サイドメニュー -->
        <?php include '../include_file/side_menu.php'; ?>
        
        <!-- イベント通知 -->
        <div class="event_notice">
            <center><font size="10px">アカウント管理：学生</center></font>
        </div>
   
        <!-- ログ-ログイン者名表示 -->
        <div class="log_login">
            <font size="5px"><div class="user_name"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES)."さん"; ?></div></font>
        </div>
        

        <!-- メイン -->
        <div class="main">
            <fieldset>
                <legend><font size="8px">検索</font></legend>
                <table class="search_teable" style="border-style: none;width: 60%;margin-left:auto;margin-right:auto;">
                    <!-- 検索項目　-->
                    <tr>
                    <th style="border-style: none;background: white;white-space: nowrap;width: 100px;">年度</th>                    
                    <th style="border-style: none;width: 10px;background: white;">学籍番号</th>
                    <th style="border-style: none;width: 10px;background: white;">名前</th>
                    <th style="border-style: none;width: 10px;background: white;">学年</th>
                    <th style="border-style: none;width: 10px;background: white;">学科コード</th>
                    <th style="border-style: none;width: 10px;background: white;">クラス</th>   
                    </tr>

                    <!-- 検索項目内容　-->
                    <tr>
                        <th style="border-style: none; background: white;">
                            <!-- 年度 -->
                            <select id="year" class="enter_btn">
                                <option value="">なし</option>
                                <?php
                                foreach ($setyear as $row){
                                    echo '<option value='.$row['year'].'>'.$row['year'].'</option>';
                                }
                            ?>
                            </select>
                        </th>                    

                        <th style="border-style: none; background: white;">
                            <!-- 学籍番号 -->
                            <input type="text" style="ime-mode: disabled" id="studentcd" size="10" class="enter_btn" style="ime-mode: disabled;">
                        </th>
                        <th style="border-style: none; background: white;">
                            <!-- 名前 -->
                            <input  id="name" type="text" size="10" class="enter_btn" value="">
                        </th>
                        <th style="border-style: none; background: white;">
                            <!-- 学年 -->
                            <select id="grade" class="enter_btn">
                                <option value="">なし</option>
                                <option value="1">1年</option>
                                <option value="2">2年</option>
                            </select>
                        </th>
                        <th style="border-style: none; background: white;">
                            <!-- 学科コード -->
                            <select id="subjectcd" class="enter_btn">
                                <option value="">なし</option>
                                <option value="C">C</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="B">B</option>
                                <option value="K">K</option>
                                <option value="LK">LK</option>
                                <option value="N">N</option>
                                <option value="S">S</option>
                                <option value="LM">LM</option>
                                <option value="M">M</option>
                                <option value="IM">IM</option>
                                <option value="F">F</option>
                                <option value="Y">Y</option>
                                <option value="J">J</option>
                            </select>
                        </th>
                        <th style="border-style: none; background: white;">
                            <!-- クラス -->
                            <select id="cls" class="enter_btn">
                                <option value="">なし</option>
                                <option value="*">*</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>    
                        </th>

                    </tr>
                </table>  
                <center><input type="button" id="search_btn"  value="検索"></center>
            </fieldset>

            <div id="tbl_len" style="margin-left: auto; margin-right: auto;"></div>
            <div class="hoge"></div>   
        </div>
    </body>
</html>
