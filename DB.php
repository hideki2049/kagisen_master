<?php

 $dbname = 'oist2017';
 $host = 'localhost';
 $user = 'kagisen';
 $password = 'Pi=3.1+4';
 
 //localhost
// $dbname = 'oist2017';
// $host = 'localhost';
// $user = 'root';
// $password ='';
 
 try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8mb4', $user , $password);
    if ($pdo == null) {
        print_r('接続失敗').PHP_EOL;
    }
} catch(PDOException $e) {
    echo('Connection failed:'.$e->getMessage());
    die();
}
?>
