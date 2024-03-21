<?php
include 'header.php';
?>
    <div class=".db-table">
        <table class="list">
            <thead><tr><th colspan=4>Content Table</th></thead>
            <tr>
                <th>Id</th>
                <th>Content Name</th>
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
                             <td><input onchange=updateDBItem('content',${row['id']},'content_name',this.value) id=contentnameinput_${row['id']} name=contentnameinput_${row['id']} value=${row['content_name']}></td>
                             <td><input onchange=updateDBItem('content',${row['id']},'category',this.value) id=categoryinput_${row['id']}  name=categoryinput_${row['id']} value=${row['category']}></td>
                             <td><input onchange=updateDBItem('content',${row['id']},'content',this.value) id=contentinput_${row['id']} name=contentinput_${row['id']} value=${row['content']}></td></tr>";
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

        <br /><br />
        <hr />


        <div class=".db-table" id="person-table">
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
        </div>

        <!-- Since this is an HTML Form post lets put it in a dialog box, so we don't have
             to take people off our page to complete it.  Hide it until requested and then
             call it in a modal dialog box

             I just started it by hiding it until it's requested by the add person link.

             see if you can work on making it modal and positioning it over the page content
             you have what you need to call jquery commands already instrumented on the page

             https://jqueryui.com/dialog/

             -->

        <button id="create-user">Create New Person</button>
        <div id="dialog-form" title="Create new user">
            <p class="validateTips">All form fields are required.</p>
            <form id="newPersonForm" action="" method="post">
            <fieldset>
                <p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </p>
                <p>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="emailAddress">Email Address:</label>
                    <input type="text" name="emailAddress" id="emailAddress" pattern=".+@gmail.com" class="text ui-widget-content ui-corner-all">
                </p>
                <p>
                    <label for="personType">Person Type:</label>
                    <input type="text" name="personType" id="personType" class="text ui-widget-content ui-corner-all">
                </p>
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>
<?php
include 'footer.php';
?>