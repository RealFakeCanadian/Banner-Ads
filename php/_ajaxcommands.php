<?php
$dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);

$tablename = $_REQUEST["tablename"];
$rowid = $_REQUEST["rowid"];
$columnname = $_REQUEST["columnname"];
$columnvalue = $_REQUEST["columnvalue"];


$query_command="update app.".$tablename." set ".$columnname."='".$columnvalue. "' where id=".$rowid;
//echo "update app.".$tablename." set ".$columnname."='".$columnvalue. "' where id=".$rowid;
echo $query_command;
$dbh->query($query_command) ;
//echo $insertresult;


if($_POST["action"] == "insert"){
    insert();
}

// Function
function insert(){
    global $dbh;

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $emailAddress = $_POST["emailAddress"];
    $personType = $_POST["personType"];

    // Check if variable value is empty
    if(empty($firstName) || empty($lastName) || empty($gender) || empty($address) || empty($emailAddress) || empty($personType)){
        // Output
        echo "";
        exit;
    }


    // Insert value to database
    $person_info = "INSERT INTO people(first_name, last_name, gender, address, email, person_type) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $dbh->prepare($person_info);
    $statement->execute([$firstName, $lastName, $gender, $address, $emailAddress,$personType]);
    echo 1;
}
?>
