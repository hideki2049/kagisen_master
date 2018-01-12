<?php
$teachercd = $_POST['teachercd'];

$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];

include '../DB.php';
$dbh = $pdo;
$dbh->query('SET NAMES utf8');

    //クラス
    $stmt = $dbh->prepare('select cls from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? and grade = ?');
    $stmt->execute(array($teachercd, $yearData,$semesterData,$subjectcdData,$gradeData));
    $testF = $stmt->fetchAll();
    $i = 0;
    foreach($testF as $row){
      $data["cls"][$i] = $row['cls'];
      $i++;
    }


header('Content-Type: application/json');
echo json_encode($data);
