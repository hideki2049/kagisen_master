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

//セメスター
// $stmt = $dbh->prepare('select semester from t_questimplement where year = :year');
// $stmt->execute(array(':year'=>$yearData));
$stmt = $dbh->prepare('select semester from t_teacher where year = ? and teachercd = ? group by semester');
$stmt->execute(array($yearData,$teachercd));
$testC = $stmt->fetchAll();
$i = 0;
foreach($testC as $row){
  $data["semester"][$i] = $row['semester'];
  $i++;
}

//学科
$stmt = $dbh->prepare('select subjectcd from t_teacher where teachercd = ? and year = ? and semester = ? group by subjectcd');
$stmt->execute(array($teachercd, $yearData,$data["semester"][0]));
$testD = $stmt->fetchAll();
$i = 0;
foreach($testD as $row){
  $data["subjectcd"][$i] = $row['subjectcd'];
  $i++;
}

//学年
$stmt = $dbh->prepare('select grade from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? group by grade');
$stmt->execute(array($teachercd, $yearData,$data["semester"][0],$data["subjectcd"][0]));
$testE = $stmt->fetchAll();
$i = 0;
foreach($testE as $row){
  $data["grade"][$i] = $row['grade'];
  $i++;
}

//クラス
$stmt = $dbh->prepare('select cls from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? and grade = ?');
$stmt->execute(array($teachercd, $yearData,$data["semester"][0],$data["subjectcd"][0],$data["grade"][0]));
$testF = $stmt->fetchAll();
$i = 0;
foreach($testF as $row){
  $data["cls"][$i] = $row['cls'];
  $i++;
}

header('Content-Type: application/json');
echo json_encode($data);
