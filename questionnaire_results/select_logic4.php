<?php
session_start();
$teachercd = $_SESSION["USERID"];

$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];

/*
$data[] = $yearData;
$data[] = $semesterData;
$data[] = $subjectcdData;
$data[] = $gradeData;
$data[] = $clsData;
*/



include '../DB.php';
$dbh = $pdo;
    //$dbh = new PDO('mysql:host=localhost;dbname=oist2017', 'root', '');
    //$dbh = new PDO('mysql:dbname=oist2017;host=192.168.205.99', 'kagisen', 'pi=3.14');
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
