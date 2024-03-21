<?php
$dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
if($_POST['action'] == "insert"){
    insert();
}
if($_POST['action'] == "getEmail"){
    checkEmail();
}
function checkEmail(){
    global $dbh;
    $emailAddress = $_POST["emailAddress"];
    try {
        foreach ($dbh->query('SELECT * from people') as $row) {
            if($emailAddress == $row['email']){
                echo "false";
                exit;
            }
        }
        $dbh = null;
        echo "true";
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
function insert(){
    global $dbh;

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $emailAddress = $_POST["emailAddress"];
    $personType = $_POST["personType"];

// Check if variable value is empty
    if(empty($username) ||empty($password) ||empty($firstName) || empty($lastName) || empty($gender) || empty($address) || empty($emailAddress) || empty($personType)){
        // Output
        echo "";
        exit;
    }


    // Insert value to database
    $person_info = "INSERT INTO people(username, password, first_name, last_name, gender, address, email, person_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $dbh->prepare($person_info);
    $statement->execute([ $username, $password, $firstName, $lastName, $gender, $address, $emailAddress,$personType]);
}
?>
