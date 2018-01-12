<?php
include "../DB.php";
$pass = $_POST['pass'];
$name = $_POST['name'];
$kana = $_POST['kana'];
$student = $_POST['student'];


$sql = "UPDATE
t_studentregist s,
t_user u
SET
u.pass = '".$pass."',
s.name = '".$name."',
s.kana = '".$kana."'
WHERE
s.studentnum = u.userid
and
s.studentnum = '".$student."'
";
        
        
$stmt = $pdo->query($sql);
$stmt->execute();

?>
