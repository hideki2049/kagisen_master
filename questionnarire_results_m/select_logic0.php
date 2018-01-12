<?php
$teachercd = $_POST['teachercd'];

include '../DB.php';
$dbh = $pdo;
$dbh->query('SET NAMES utf8');

//年度
$stmt = $dbh->prepare('select year from t_teacher where teachercd = :teachercd group by year order by year desc');
$stmt->execute(array(':teachercd'=>$teachercd));
$testB = $stmt->fetchAll();
$i = 0;
foreach($testB as $row){
  $data["year"][$i] = $row['year'];
  $i++;
}

//セメスターselect semester from t_questimplement where year = :year order by semester desc
//select semester from t_questimplement where year = :year
$stmt = $dbh->prepare('select semester from t_teacher where year = ? and teachercd = ? group by semester');
//$stmt->execute(array(':year'=>$data["year"][0]));
$stmt->execute(array($data["year"][0],$teachercd));
$testC = $stmt->fetchAll();
$i = 0;
foreach($testC as $row){
  $data["semester"][$i] = $row['semester'];
  $i++;
}

//学科
$stmt = $dbh->prepare('select subjectcd from t_teacher where teachercd = ? and year = ? and semester = ? group by subjectcd');
$stmt->execute(array($teachercd, $data["year"][0],$data["semester"][0]));//semesterデータは上のデータをもとに決める$semesterDataだとダメ
$testD = $stmt->fetchAll();
$i = 0;
foreach($testD as $row){
  $data["subjectcd"][$i] = $row['subjectcd'];
  $i++;
}

//学年
$stmt = $dbh->prepare('select grade from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? group by grade');
$stmt->execute(array($teachercd, $data["year"][0],$data["semester"][0],$data["subjectcd"][0]));
$testE = $stmt->fetchAll();
$i = 0;
foreach($testE as $row){
  $data["grade"][$i] = $row['grade'];
  $i++;
}

//クラス
$stmt = $dbh->prepare('select cls from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? and grade = ?');
$stmt->execute(array($teachercd, $data["year"][0],$data["semester"][0],$data["subjectcd"][0],$data["grade"][0]));
$testF = $stmt->fetchAll();
$i = 0;
foreach($testF as $row){
  $data["cls"][$i] = $row['cls'];
  $i++;
}

header('Content-Type: application/json');
echo json_encode($data);
