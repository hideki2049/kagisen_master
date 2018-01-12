<?php
$teachercd = $_POST['teachercd'];
$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];
$clsData = $_POST['cls'];

include '../DB.php';
$dbh = $pdo;
$dbh->query('SET NAMES utf8');


    $stmt = $dbh->prepare('select
      an.questnum as number,
      qc.content as question,
      sum(case an.answer when 3 then 1 else 0 end) as good,
      sum(case an.answer when 2 then 1 else 0 end) as medium,
      sum(case an.answer when 1 then 1 else 0 end) as bad,
      sum(an.answer)/count(*) as avg
      from t_answer1 an,t_questcontent qc,  t_student st
      where an.questnum = qc.questnum
      and an.year = qc.year
      and an.year = st.year
      and an.studentnum = st.studentnum
      and an.teachercd = ?
      and an.semester = ?
      and an.answer != 0
      and st.subjectcd = ?
      and st.grade = ?
      and st.cls = ?
      and an.year = ?
     group by an.questnum');
    $stmt->execute(array($teachercd,$semesterData,$subjectcdData,$gradeData,$clsData,$yearData));
    $testA = $stmt->fetchAll();
    $i = 0;
    foreach($testA as $row){
      $data['number'][$i] = $row['number'];
      $data['question'][$i] = $row['question'];
      $data['good'][$i] = $row['good'];
      $data['medium'][$i] = $row['medium'];
      $data['bad'][$i] = $row['bad'];
      $data['avg'][$i] = $row['avg'];
      $i++;
    }

//データベースに値がない場合エラーを返す
if(empty($testA)){
  echo "1";//エラーナンバー
}else{
  $data['resultDesc'][0] = $yearData;
  $data['resultDesc'][1] = $semesterData;
  $data['resultDesc'][2] = $subjectcdData;
  $data['resultDesc'][3] = $gradeData;
  $data['resultDesc'][4] = $clsData;
  echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
?>
