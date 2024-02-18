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
                             <td><input name='contentnameinput_${row['id']}' value='${row['content_name']}'></td>
                             <td><input name='categoryinput_${row['id']}' value='${row['category']}'></td>
                             <td><input name='contentinput_${row['id']}' value='${row['content']}'></td></tr>";
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
                    foreach ($dbh->query('SELECT * from content') as $row) {
                        $html = "<tr><td>${row['id']}</td><td>${row['banner_name']}</td><td>${row['category']}</td><td>${row['content']}</td></tr>";
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

</body>

</html>