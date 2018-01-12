<?php
include '../DB.php';

$year = $_POST['year'];
$semester = $_POST['semester'];
$t_name  = $_POST['t_name'];
$s_name  = $_POST['s_name'];
$questnum = $_POST['questnum'];
$time = $_POST['time'];


$sql ="SELECT
t2.year as 年度,
(CASE
WHEN t2.semester = 1 THEN '前期'
WHEN t2.semester = 2 THEN '後期'
ELSE '*'
END) as 学期,
m.name as 教員,
ts.name as 学生,
(CASE
WHEN t2.questnum = 11 THEN '学校への要望'
WHEN t2.questnum = 12 THEN '先生への要望'
ELSE '*'
END) as 質問項目,
t2.answer as 回答,
t2.regist as 回答時間
FROM
t_questcontent t JOIN 
t_answer2 t2 ON (t.questnum = t2.questnum)
LEFT JOIN 
t_studentregist ts ON (t2.studentnum = ts.studentnum)
LEFT JOIN
m_teacher m ON (m.teachercd = t2.teachercd)
WHERE
t2.year LIKE ('%".$year."%')
and
t2.semester LIKE ('%".$semester."%')
and
t2.semester LIKE ('%".$semester."%')
and
(
m.teachercd LIKE ('%".$t_name."%')
or
m.name LIKE ('%".$t_name."%')
or
m.kana LIKE ('%".$t_name."%')
)
and
(
ts.studentnum LIKE ('%".$s_name."%')
or
ts.name LIKE ('%".$s_name."%')
or
ts.kana LIKE ('%".$s_name."%')
)
and
t.questtype LIKE ('%".$questnum."%')
and
t2.regist LIKE ('%".$time."%')

";







$stmt = $pdo->query($sql);



?>
        
<table class="table_student" id="table">
    <thead>
        <tr>

            <th scope="cols">年度</th>
            <th scope="cols">学期</th>
            <th scope="cols">教員</th>
            <th scope="cols">学生</th>         
            <th scope="cols">質問項目</th>
            <th scope="cols">回答</th>
            <th scope="cols">回答時間</th>


        </tr>
        </thead>
            <tbody id="tbody">
            <?php 
            // foreach文で配列の中身を一行ずつ出力
            foreach ($stmt as $row) {
                // データベースのフィールド名で出力 
                
                
                if(isset($row['年度'])){echo '<td>'. htmlspecialchars($row['年度']).'</td>';}
                if(isset($row['学期'])){echo '<td>'. htmlspecialchars($row['学期']).'</td>';}
                if(isset($row['教員'])){echo '<td>'. htmlspecialchars($row['教員']).'</td>';}
                if(isset($row['学生'])){echo '<td>'. htmlspecialchars($row['学生']).'</td>';}
                if(isset($row['質問項目'])){echo '<td>'. htmlspecialchars($row['質問項目']).'</td>';}
                if(isset($row['回答'])){echo '<td>'. htmlspecialchars($row['回答']).'</td>';}
                if(isset($row['回答時間'])){echo '<td>'. htmlspecialchars($row['回答時間']).'</td>';}

                
                echo '</tr>';
                
            }

        ?>
    </tbody>
</table>