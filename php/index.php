<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MYSQL Table</title>
    <meta name="description" content="Docker with PHP/mySQL">
    <meta name="author" content="John Elias">
    <style>table td {border:1px solid #000;width:25%}</style>
      <!-- The JQUERY js Library -->
    <script type="text/javascript" src="jquery/jquery-3.6.0.js"></script>
     <!-- The JQUERY UI js Library -->
    <script type="text/javascript" src="jquery/jquery-ui.js"></script>


    <link href="bannerStyles.css" rel="stylesheet">

</head>

<body>

    <div id="container">

    <h1>Docker PHP/MYSQL</h1>
    <h2>Stylesheet = bannerStyles.css in root</h2>


    <br />
    <div class=".db-table">
        <table class="list">
            <tr>
                <th>Id</th>
                <th>Banner Name</th>
                <th>Category</th>
                <th>Content</th>
            </tr>
            <?php

//            We will use an environment variable instead of passing u/p it in.
//            This environment variable shouldn't be put in code.  Either this way
//            or in the dockerfile.  For now we are fine, using it in our related dockerfile

//            $user = 'root';
//            $pass = 'example';

            try {
                $dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
                foreach ($dbh->query('SELECT * from content') as $row) {
                    $html = "<tr><td>${row['id']}</td>
                             <td><input name='contentnameinput' value='${row['content_name']}'></td>
                             <td><input name='categoryinput' value='${row['category']}'></td>
                             <td><input name='contentinput' value='${row['content']}'></td></tr>";
                    echo $html;
                }
                $dbh = null;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            ?>
        </table>
    </div>




        <div class=".db-table">
            <table class="list">
                <tr>
                    <th>Id</th>
                    <th>Content Name</th>
                    <th>Category</th>
                    <th>Content</th>
                </tr>
                <?php
                try {
                    $dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
                    foreach ($dbh->query('SELECT * from positions') as $row) {
                        $html = "<tr><td>${row['id']}</td>
                                 <td>${row['banner_name']}</td>
                                 <td>${row['category']}</td>
                                 <td>${row['content']}</td>
                                 </tr>";
                        echo $html;
                    }
                    $dbh = null;
                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }
                ?>
            </table>
        </div>
        <form method="POST">
            <p>
                <label for="firstName">First Name:</label>
                <input type="text" name="first_name" id="firstName" required>
            </p>


            <p>
                <label for="lastName">Last Name:</label>
                <input type="text" name="last_name" id="lastName" required>
            </p>


            <p>
                <label for="Gender">Gender:</label>
                <select name="gender" id="Gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </p>


            <p>
                <label for="Address">Address:</label>
                <input type="text" name="address" id="Address" required>
            </p>


            <p>
                <label for="emailAddress">Email Address:</label>
                <input type="text" name="email" id="emailAddress" pattern=".+@gmail.com" required>
            </p>

            <input type="submit" value="Submit">
        </form>
        <?php
        //
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // collect value of input field
            $data = $_REQUEST;

            if (empty($data)) {
                echo "data is empty";
            } else {
                try {
                    $dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
                    $client_info = "INSERT INTO client_info(client_first_name, client_last_name, gender, client_address, client_email_address) VALUES (?, ?, ?, ?, ?)";
                    $statement = $dbh->prepare($client_info);
                    $statement->execute([$_REQUEST['first_name'], $_REQUEST['last_name'], $_REQUEST['gender'], $_REQUEST['address'], $_REQUEST['email']]);
                    echo "<div class=\".db-table\">
            <table class=\"list\">
                <tr>
                    <th>Id</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>";
                    foreach ($dbh->query('SELECT * from client_info') as $row) {
                        $html = "<tr><td>".filter_var($row['client_id'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 <td>".filter_var($row['client_last_name'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 <td>".filter_var($row['client_first_name'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 <td>".filter_var($row['gender'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 <td>".filter_var($row['client_address'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 <td>".filter_var($row['client_email_address'], FILTER_SANITIZE_SPECIAL_CHARS)."</td>
                                 </tr>";
                        echo $html;
                    }
                    echo"</table>
        </div>";
                    $dbh = null;
                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }
            }
        }

        ?>
    </div>
</body>

</html>