<?php
$dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);

$tablename = $_REQUEST["tablename"];
$rowid = $_REQUEST["rowid"];
$rowname = $_REQUEST["rowname"];
$rowvalue = $_REQUEST["rowvalue"];

$dbh->query('update '.$tablename.' set '.$rowname.'='.$rowvalue. ' where rowid='.$rowid);

?>
