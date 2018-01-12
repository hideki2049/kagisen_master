<?php 
include '../DB.php';

$old_pass = $_POST['old_pass'];
$new_pass = $_POST['new_pass'];
$new2_pass = $_POST['new2_pass'];
$id = $_POST['userid'];

$sql = "UPDATE
t_user
SET pass = '".$new_pass."'
WHERE
userid = '".$id."'
and
pass = '".$old_pass."'";

$stmt = $pdo->query($sql);
//var_dump($stmt);
?>