<?php
$dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);

$tablename = $_REQUEST["tablename"];
$rowid = $_REQUEST["rowid"];
$columnname = $_REQUEST["columnname"];
$columnvalue = $_REQUEST["columnvalue"];

echo $tablename;
echo "--";
$query_command="update app.".$tablename." set ".$columnname."='".$columnvalue. "' where id=".$rowid;
//echo "update app.".$tablename." set ".$columnname."='".$columnvalue. "' where id=".$rowid;
echo $query_command;
$dbh->query($query_command) ;
//echo $insertresult;

?>
