<?php
session_start();
$teachercd = $_SESSION["USERID"];//sessionにする

$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];
$clsData = $_POST['cls'];

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

    //学科
    $stmt = $dbh->prepare('select subjectcd from t_teacher where teachercd = ? and year = ? and semester = ? group by subjectcd');
    $stmt->execute(array($teachercd, $yearData,$semesterData));
    $testD = $stmt->fetchAll();
    $i = 0;
    foreach($testD as $row){
      //$subjectcd[$i] = $row['subjectcd'];
      $data["subjectcd"][$i] = $row['subjectcd'];
      $i++;
    }

    //学年
    $stmt = $dbh->prepare('select grade from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? group by grade');
    $stmt->execute(array($teachercd, $yearData,$semesterData,$data["subjectcd"][0]));
    $testE = $stmt->fetchAll();
    $i = 0;
    foreach($testE as $row){
      //$grade[$i] = $row['grade'];
      $data["grade"][$i] = $row['grade'];
      $i++;
    }

    //クラス
    $stmt = $dbh->prepare('select cls from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? and grade = ?');
    $stmt->execute(array($teachercd, $yearData,$semesterData,$data["subjectcd"][0],$data["grade"][0]));
    $testF = $stmt->fetchAll();
    $i = 0;
    foreach($testF as $row){
      $data["cls"][$i] = $row['cls'];
      $i++;
    }




header('Content-Type: application/json');
echo json_encode($data);
