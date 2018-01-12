<?php
include '../DB.php';
$dbh = $pdo;
$dbh->query('SET NAMES utf8');


$teachercd = $_POST['teachercd'];
$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];
$clsData = $_POST['cls'];
$questtype = 2;


    $stmt = $dbh->prepare('select
     t_answer2.year,
     t_answer2.semester,
     t_answer2.teachercd,
     t_answer2.studentnum,
     t_answer2.questnum,
     t_answer2.answer,
     t_student.grade,
     t_student.subjectcd,
     t_student.cls
     from
     t_student inner join t_answer2
     on t_student.studentnum = t_answer2.studentnum
     where t_student.year = ? and t_student.grade = ? and t_student.subjectcd = ? and t_student.cls = ?
     and t_answer2.year = ? and t_answer2.semester = ? and t_answer2.teachercd = ? and t_answer2.questnum in (select questnum from t_questcontent where year = ? and questtype = ?)
     order by t_answer2.questnum, t_answer2.studentnum');
    $stmt->execute(array($yearData,$gradeData,$subjectcdData,$clsData,
                          $yearData,$semesterData,$teachercd,$yearData,$questtype));
    $test = $stmt->fetchAll();

    $i = 0;
    $questnum_ctrl;
    $k = 0;
    foreach($test as $row){
      if($i == 0){
        $questnum_ctrl = $row['questnum'];
      }
      if($questnum_ctrl == $row['questnum']){
        $data["answer"][$k][$i] = $row['answer'];
      }else{
        $questnum_ctrl = $row['questnum'];
        $i = 0;
        $k++;
        $data["answer"][$k][$i] = $row['answer'];
      }
      $i++;
    }

    //記述式アンケート取得
    $stmt2 = $dbh->prepare('select * from t_questcontent where questtype = 2 and year = ?');
    $stmt2->execute(array($yearData));
    $test2 = $stmt2->fetchAll();
    $i = 0;
    foreach($test2 as $row){
      $data["answer_content"][$i] = $row['content'];
      $i++;
    }


echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
