<?php
include '../DB.php';

$year = $_POST['year'];
$studentcd = $_POST['studentcd'];
$name = $_POST['name'];
$grade = $_POST['grade'];
$subjectcd = $_POST['subjectcd'];
$cls = $_POST['cls'];

$set_sql = "SET @num := 0";

$sql = "SELECT
(@num := @num +1) as no,
t_s.year as 年度,
t_s.studentnum as 学籍番号,
t_u.pass as パスワード,
t_r.name as 名前,
t_r.kana as かな,
t_s.grade as 学年,
t_s.subjectcd as 学科コード,
t_s.cls as クラス,
m.name as 学科名
FROM
t_student t_s,
t_studentregist t_r,
t_subject t,
m_subject m,
t_user t_u
WHERE
t_s.subjectcd = m.subjectcd
and
m.subjectcd = t.subjectcd
and
t_s.studentnum = t_r.studentnum
and
t_u.userid = t_r.studentnum
and
t.year LIKE ('%".$year."%')
and
t_r.studentnum LIKE ('%".$studentcd."%')
and
(
t_r.name LIKE ('%".$name."%')
or
t_r.kana LIKE ('%".$name."%')
)
and
t_s.grade LIKE ('%".$grade."%')
and
t_s.subjectcd LIKE ('%".$subjectcd."%')
and
t_s.cls LIKE ('%".$cls."%')
ORDER BY t.odr ASC, t_s.year, t_r.studentnum ASC";

// SQLステートメントを実行し、結果を変数に格納
$stmt = $pdo->query($set_sql);
$stmt = $pdo->query($sql);


/*debagu*/
?>

        <table class="table_student">
            <thead>
            <tr>
                <th scope="cols" style="background-image: linear-gradient(to top right,transparent, transparent 48%,black 48%, black 52%,
                transparent 52%, transparent) /* 右下がりの斜線 */"></th> 
                <th scope="cols">年度</th>
                <th scope="cols">学籍番号</th>
                <th scope="cols">パスワード</th>
                <th scope="cols">名前</th>
                <th scope="cols">かな</th>
                <th scope="cols">学年</th>
                <th scope="cols">学科コード</th>
                <th scope="cols">クラス</th>
                <th scope="cols">学科名</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            
                $cnt = 0;

                // foreach文で配列の中身を一行ずつ出力
                foreach ($stmt as $row) {
                // データベースのフィールド名で出力    

                echo '<tr id="'.$cnt.'">';
                if(isset($row['no'])){echo '<td class="edit"><input type="button" class="edit_btn" value="編集" name="'.$row['no'].'"></td>';}
                if(isset($row['年度'])){echo '<td>'. htmlspecialchars($row['年度']).'</td>';}
                if(isset($row['学籍番号'])){echo '<td class="'.$row["学籍番号"].'">'. htmlspecialchars($row['学籍番号']).'</td>';}
                if(isset($row['パスワード'])){echo '<td class="pass"><input type="text" calss="ch_edit" disabled="disabled" name="'.$row['パスワード'].'" value="'.htmlspecialchars($row["パスワード"]).'" size="12px"></td>';}
                if(isset($row['名前'])){echo '<td class="name"><input type="text" calss="ch_edit" disabled="disabled" name="'.$row['名前'].'" value="'.htmlspecialchars($row["名前"]).'" size="12px"></td>';}  //input text
                if(isset($row['かな'])){echo '<td class="kana"><input type="text" calss="ch_edit" disabled="disabled" name="'.$row['かな'].'" value="'.htmlspecialchars($row["かな"]).'" size="12px"></td>';}
                if(isset($row['学年'])){echo '<td>'. htmlspecialchars($row['学年']).'年</td>';}
                if(isset($row['学科コード'])){echo '<td>'. htmlspecialchars($row['学科コード']).'</td>';}
                if(isset($row['クラス'])){echo '<td>'. htmlspecialchars($row['クラス']).'</td>';}
                if(isset($row['学科名'])){echo '<td>'. htmlspecialchars($row['学科名']).'</td>';}
                echo '</tr>';
                $cnt++;                
                }

            ?>
            </tbody>
        </table>   