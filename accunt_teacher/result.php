<?php 
include "../DB.php";
$year = $_POST['year'];
$semester = $_POST['semester'];
$teachercd = $_POST['teachercd'];
$name = $_POST['name'];
$grade = $_POST['grade'];
$subjectcd = $_POST['subjectcd'];
$cls = $_POST['cls'];
$teachertype = $_POST['teachertype'];

$set_sql = "SET @num := 0";

$sql = "SELECT
(@num := @num +1) as no,
t.year as 年度,
(CASE
WHEN t.semester = 1 THEN '前期'
WHEN t.semester = 2 THEN '後期'
ELSE '*'
END) as 学期,
t.teachercd as 教員コード,
t_u.pass as パスワード,
m.name as 名前,
m.kana as かな,
t.grade as 学年,
t.subjectcd as 学科コード,
t.cls as クラス,
m_s.name as 学科名,
(CASE
WHEN t.teachertype = 1 THEN '常勤'
WHEN t.teachertype = 2 THEN '非常勤'
ELSE '*'
END)as 教員属性,
(CASE
WHEN t_u.authoritycd = 0 THEN 'マスター'
WHEN t_u.authoritycd = 1 THEN '一般教員'
WHEN t_u.authoritycd = 2 THEN '学生'
ELSE '*'
END)as 権限
FROM
t_teacher t,
m_teacher m,
m_subject m_s,
t_subject t_s,
t_user t_u
WHERE
t.teachercd = m.teachercd
and
m_s.subjectcd = t.subjectcd
and
t_s.subjectcd = m_s.subjectcd
and
t_u.userid = t.teachercd
and
t.year LIKE ('%".$year."%')
and
t.semester LIKE ('%".$semester."%')
and
t.teachercd LIKE ('%".$teachercd."%')
and
(m.name LIKE ('%".$name."%')
or
m.kana LIKE ('%".$name."%'))
and
t.grade LIKE ('%".$grade."%')
and
t.subjectcd LIKE ('%".$subjectcd."%')
and
t.cls LIKE ('%".$cls."%')
and
t.teachertype LIKE ('%".$teachertype."%')
ORDER BY t.year,t_s.odr,t.grade,t.teachercd ASC;";
$stmt = $pdo->query($set_sql);
$stmt = $pdo->query($sql);
//echo $sql;

?>

<table class="table_student" id="table">
    <thead>
        <tr>
            <th scope="cols" style="background-image: linear-gradient(to top right,transparent, transparent 48%,black 48%, black 52%,
            transparent 52%, transparent) /* 右下がりの斜線 */"></th> 
            <th scope="cols">年度</th>
            <th scope="cols">学期</th>
            <th scope="cols">教員コード</th>
            <th scope="cols">パスワード</th>         
            <th scope="cols">名前</th>
            <th scope="cols">かな</th>
            <th scope="cols">学年</th>
            <th scope="cols">学科コード</th>
            <th scope="cols">クラス</th>        
            <th scope="cols">教員属性</th>
            <th scope="cols">権限</th>


        </tr>
        </thead>
            <tbody id="tbody">
            <?php 
            $cnt = 0;
            // foreach文で配列の中身を一行ずつ出力
            foreach ($stmt as $row) {
                // データベースのフィールド名で出力 
                
                echo '<tr id="'.$cnt.'">';             
                if(isset($row['no'])){echo '<td class="edit"><input type="button" class="edit_btn" value="編集" name="'.$row['no'].'"></td>';}
                if(isset($row['年度'])){echo '<td>'. htmlspecialchars($row['年度']).'</td>';}
                if(isset($row['学期'])){echo '<td>'. htmlspecialchars($row['学期']).'</td>';}
                if(isset($row['教員コード'])){echo '<td class="'.$row["教員コード"].'">'. htmlspecialchars($row['教員コード']).'</td>';}
                if(isset($row['パスワード'])){echo '<td>'. htmlspecialchars($row['パスワード']).'</td>';}
                if(isset($row['名前'])){echo '<td class="name"><input type="text" calss="ch_edit" disabled="disabled" name="'.$row['名前'].'" value="'.htmlspecialchars($row["名前"]).'" size="12px"></td>';}  //input text
                if(isset($row['かな'])){echo '<td class="kana"><input type="text" calss="ch_edit" disabled="disabled" name="'.$row['かな'].'" value="'.htmlspecialchars($row["かな"]).'" size="12px"></td>';}
                if(isset($row['学年'])){echo '<td>'. htmlspecialchars($row['学年']).'年</td>';}
                if(isset($row['学科コード'])){echo '<td>'. htmlspecialchars($row['学科コード']).'</td>';}
                if(isset($row['クラス'])){echo '<td>'. htmlspecialchars($row['クラス']).'</td>';}
                if(isset($row['教員属性'])){echo '<td>'. htmlspecialchars($row['教員属性']).'</td>';}
                if(isset($row['権限'])){echo '<td>'. htmlspecialchars($row['権限']).'</td>';}
                
                echo '</tr>';
                $cnt++;
                
            }

        ?>
    </tbody>
</table>