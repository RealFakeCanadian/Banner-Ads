<table class="list">
    <thead><tr><th colspan=7>People Table</th></thead>
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Email</th>
        <th>Person Type</th>
    </tr>
    <?php
    try {
        $dbh = new PDO('mysql:host=db;port=3306;dbname=app', $_ENV['user'], $_ENV['pass']);
        foreach ($dbh->query('SELECT * from people') as $row) {
            $html = "<tr><td>${row['id']}</td>
                                 <td>${row['first_name']}</td>
                                 <td>${row['last_name']}</td>
                                 <td>${row['gender']}</td>
                                 <td>${row['address']}</td>
                                 <td>${row['email']}</td>
                                 <td>${row['person_type']}</td>
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