<?php
include "../DB.php";
$name = $_POST['name'];
$kana = $_POST['kana'];
$teacher = $_POST['teacher'];


$sql = "UPDATE
m_teacher
SET
name = '".$name."',
kana = '".$kana."'
WHERE
teachercd = '".$teacher."'

";
$stmt = $pdo->query($sql);
$stmt->execute();

?>
