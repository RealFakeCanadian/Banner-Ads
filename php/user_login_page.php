<?php
 session_start();
 try
 {
      $connect = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))
      {
           if(empty($_POST["username"]) || empty($_POST["password"]))
           {
                $message = '<label>All fields are required</label>';
           }
           else
           {
                $query = "SELECT * FROM people WHERE username = :username AND password = :password";
                $statement = $connect->prepare($query);
                $statement->execute(
                     array(
                          'username'     =>     $_POST["username"],
                          'password'     =>     $_POST["password"]
                     )
                );
                $count = $statement->rowCount();
                if($count > 0)
                {
                     $_SESSION["username"] = $_POST["username"];
                     header("location:login_success.php");
                }
                else
                {
                     $message = '<label>Wrong Data</label>';
                }
           }
      }
 }
 catch(PDOException $error)
 {
      $message = $error->getMessage();
 }
 ?>
<?php
include 'header.php';
?>
      <head>
           <title>Webslesson Tutorial | PHP Login Script using PDO</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <div>
           <br />
           <div class="container" style="width:500px;">
                <?php
                if(isset($message))
                {
                     echo '<label class="text-danger">'.$message.'</label>';
                }
                ?>
                <h3 align="">PHP Login Script using PDO</h3><br />
               <div>
                    <h4>or create </h4>
                    <a href="index.php">new user</a>
               </div>
                <form method="post">
                     <label>Username</label>
                     <input type="text" name="username" class="form-control" />
                     <br />
                     <label>Password</label>
                     <input type="password" name="password" class="form-control" />
                     <br />
                     <input type="submit" name="login" class="btn btn-info" value="Login" />
                </form>
           </div>
           <br />
      </div>

<?php
include 'footer.php';
?>
