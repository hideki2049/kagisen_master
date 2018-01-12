<?php
session_start();
//year select
$teachercd = $_SESSION["USERID"];

$yearData = $_POST['year'];
$semesterData = $_POST['semester'];
$subjectcdData = $_POST['subjectcd'];
$gradeData = $_POST['grade'];
$clsData = $_POST['cls'];

include '../DB.php';
$dbh = $pdo;
    //$dbh = new PDO('mysql:host=localhost;dbname=oist2017', 'root', '');
    //$dbh = new PDO('mysql:dbname=oist2017;host=192.168.205.99', 'kagisen', 'pi=3.14');
    $dbh->query('SET NAMES utf8');

    //セメスター
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
    $stmt->execute(array($teachercd, $yearData,$data["semester"][0]));//semesterデータは上のデータをもとに決める$semesterDataだとダメ
    $testD = $stmt->fetchAll();
    $i = 0;
    foreach($testD as $row){
      //$subjectcd[$i] = $row['subjectcd'];
      $data["subjectcd"][$i] = $row['subjectcd'];
      $i++;
    }

    //学年
    $stmt = $dbh->prepare('select grade from t_teacher where teachercd = ? and year = ? and semester = ? and subjectcd = ? group by grade');
    $stmt->execute(array($teachercd, $yearData,$data["semester"][0],$data["subjectcd"][0]));
    $testE = $stmt->fetchAll();
    $i = 0;
    foreach($testE as $row){
      //$grade[$i] = $row['grade'];
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
