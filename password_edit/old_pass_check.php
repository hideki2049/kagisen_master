<?php 
include '../DB.php';

$old_pass = $_POST['old_pass'];
$userid = $_POST['userid'];


$sql = "SELECT
*
FROM
t_user
WHERE
userid = '".$userid."'
and
pass = '".$old_pass."'";

$stmt = $pdo->query($sql);
//$stmt = $pdo->excute($sql);

var_dump($stmt);
?>
