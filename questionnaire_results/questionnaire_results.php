<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}


include '../DB.php';
$dbh = $pdo;
    //$dbh = new PDO('mysql:host=localhost;dbname=oist2017', 'root', '');
    $dbh->query('SET NAMES utf8');
    //$teachercd = 'ono';
    $teachercd = $_SESSION["USERID"];//sessionで取得する

    //年度選択ボタン(年度習得)
    $stmt = $dbh->prepare('select year from t_teacher where teachercd = :teachercd group by year order by year desc');
    $stmt->execute(array(':teachercd'=>$teachercd));
    $testB = $stmt->fetchAll();
    $i = 0;
    foreach($testB as $row){
      $yearSelect[$i] = $row['year'];
      $i++;
    }

    //セメスター選択(年度情報をもとにデフォルト値を設定するための値を習得する)
    $stmt = $dbh->prepare('select semester from t_teacher where year = ? and teachercd = ? group by semester order by semester desc');
    $stmt->execute(array($yearSelect[0],$teachercd));
    $testC = $stmt->fetchAll();
    $i = 0;
    foreach($testC as $row){
      $semester[$i] = $row['semester'];
      $i++;
    }

    //学科選択ボタン(デフォルト値を元に取得)
    $stmt = $dbh->prepare('select subjectcd from t_teacher where teachercd = ? and year = ? and semester = ? group by subjectcd');
    $stmt->execute(array($teachercd, $yearSelect[0],$semester[0]));
    $testD = $stmt->fetchAll();
    $i = 0;
    foreach($testD as $row){
      $subjectcd[$i] = $row['subjectcd'];
      $i++;
    }

    //学年選択ボタン(デフォルト値を元に取得)
    $stmt = $dbh->prepare('select grade from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? group by grade');
    $stmt->execute(array($teachercd, $yearSelect[0],$semester[0],$subjectcd[0]));
    $testE = $stmt->fetchAll();
    $i = 0;
    foreach($testE as $row){
      $grade[$i] = $row['grade'];
      $i++;
    }

    //クラス選択(デフォルト値を元に取得)
    $stmt = $dbh->prepare('select cls from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? and grade = ?');
    $stmt->execute(array($teachercd, $yearSelect[0],$semester[0],$subjectcd[0],$grade[0]));
    $testF = $stmt->fetchAll();
?>
 <html>
     <head>
         <meta charset="UTF-8">
         <title>アンケート結果</title>
         <!-- <link rel="stylesheet" type="text/css" href="../master_general.css"> -->
         <link rel="stylesheet" type="text/css" href="side.css">
         <link rel="stylesheet" type="text/css" href="style.css">
         <script src="../jquery-3.2.1.min.js"></script>
         <script type="text/javascript" src="q_r.js"></script>
     </head>

     <body link="blue" vlink="blue">
         <!-- サイドメニュー -->
         <div class="side_menu">
             <div class="home_button">
                     <a href="../general.php" style="text-decoration:none;">ホーム</a>
             </div>

             <div class="host reference_button">
                 <text style="text-decoration:none;">アンケート参照</text>
             </div>
             <div class="sub">
               <a href="questionnaire_results.php">|-集計</a>
             </div>
             <div class="logout_button" style="width: 100%; height: 100%; margin-top: 200%;">
                 <a href="../Logout.php" style="text-decoration:none;">ログアウト</a>
             </div>

         </div>

         <!-- イベント通知 -->
         <div class="event_notice">
             <center><font size="10px">アンケート参照：参照</center></font>
         </div>

         <!-- ログ-ログイン者名表示 -->
         <div class="log_login">
             <font size="5px"><div class="user_name"><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES)."さん"; ?></div></font>
         </div>


         <!-- メイン -->
         <div class="main">
            <div id="select_box">
                <fieldset>
                    <legend><font size="8px">検索</font></legend>
                    <div style="margin-left: auto; margin-right:auto;width:550px">
                        <div class="select_h">年度
                            <select name="year" id="select1">
                                <?php
                                foreach($testB as $row) {
                                  echo "<option value=\"{$row['year']}\">{$row['year']}</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="select_h" style="margin-top: -35px; margin-left: 130px">学期
                            <select name="semester" id="select2">
                                <?php
                                foreach($testC as $row){
                                  echo "<option value=\"{$row['semester']}\">{$row['semester']}</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="select_h" style="margin-top: -35px; margin-left: 230px">学科
                            <select name="subjectcd" id="select3">
                                <?php
                                foreach($testD as $row){
                                  echo "<option value=\"{$row['subjectcd']}\">{$row['subjectcd']}</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="select_h" style="margin-top: -35px; margin-left: 330px">学年
                            <select name="grade" id="select4">
                                <?php
                                foreach($testE as $row){
                                  echo "<option value=\"{$row['grade']}\">{$row['grade']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="select_h" style="margin-top: -35px; margin-left: 430px" >クラス
                            <select name="cls" id="select5">
                                <?php
                                foreach($testF as $row){
                                  echo "<option value=\"{$row['cls']}\">{$row['cls']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="select_btn" id="select_button" style="margin-left:auto; margin-right: auto; margin-top:25px;width:83px "><button id="selectAnswer1">検索</button></div>
                  </div>
                </fieldset>





              <div id="list_display">
                <!-- <div id="questionnaireDesc"></div> -->
                <div id="list1Contents_h"></div>
                <div id="list1Contents"></div>
                <div id="list2Contents_h"></div>
                <div id="list2Contents"></div>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart_div0_h"></div>
                <div id="chart_div0" style="width: 750px; height: 500px;"></div>
                <div id="chart_div1_h"></div>
                <div id="chart_div1" style="width: 750px; height: 500px;"></div>
              </div>
         </div>

     </body>
 </html>
