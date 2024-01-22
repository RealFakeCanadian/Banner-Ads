<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MYSQL Table</title>
    <meta name="description" content="Docker with PHP/mySQL">
    <meta name="author" content="John Elias">
<style>table td {border:1px solid #000;width:33%}</style>
</head>

<body>
    <h1>Docker PHP/MYSQL</h1>
    <div class=".db-table">
        <table style='width:99%'>
            <tr>
                <th style='width:33%'>Id</th>
                <th style='width:33%'>Category</th>
                <th>Content</th>
            </tr>
            <?php
            $user = 'root';
            $pass = 'example';

            try {
                $dbh = new PDO('mysql:host=db;port=3306;dbname=app', $user, $pass);
                foreach ($dbh->query('SELECT * from content') as $row) {
                    $html = "<tr><td>${row['id']}</td><td>${row['category']}</td><td>${row['content']}</td></tr>";
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