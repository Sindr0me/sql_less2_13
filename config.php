<?php
try{
$dbh = new PDO('mysql:host=localhost;dbname=homework2', "root", "");
$dbh->exec("set names utf8");
}catch(PDOException $e){
	echo "Возникла ошибка, упс.".$e->getMessage();
	exit;
}