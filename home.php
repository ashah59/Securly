<?php
session_start();

if (isset($_SESSION['adminName'])) {
    $userName = $_SESSION['adminName'];
} else {
    header('Location:index.php');
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "securlydb";
$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM query WHERE adminid = $_SESSION[adminId] ORDER BY query.datetime DESC";
$getQueries = mysqli_query($conn, $query);
$queries = null;
if ($getQueries) {
    $queries = mysqli_fetch_all($getQueries);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to District Admin Portal</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <?php
                        echo "Welcome, $userName";
                        ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <form id="queryForm1" method="POST" action="queryHandler.php" class="text-center">
                        <div class="form-group">
                            <input type="text" class="form-control" name="queryText"
                                   placeholder="Enter kid email" required />
                            <input type="hidden" name="queryid" value="query1" />
                        </div>
                        <input type="submit" id="postQuery1" value="Show school and clubs" class="btn btn-default" />
                    </form>
                </div>
                <div class="col-md-4">
                    <form id="queryForm2" method="POST" action="queryHandler.php" class="text-center">
                        <div class="form-group">
                            <input type="text" class="form-control" name="queryText"
                                   placeholder="Enter club name" required />
                            <input type="hidden" name="queryid" value="query2" />
                        </div>
                        <input type="submit" id="postQuery2" value="Show school and kids" class="btn btn-default" />
                    </form>
                </div>
                <div class="col-md-4">
                    <form id="queryForm3" method="POST" action="queryHandler.php" class="text-center">
                        <div class="form-group">
                            <input type="text" class="form-control" name="queryText"
                                   placeholder="Enter kid 1 email" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="queryText2"
                                   placeholder="Enter kid 2 email" required />
                            <input type="hidden" name="queryid" value="query3" />
                        </div>
                        <input type="submit" id="postQuery3" value="Find connection" class="btn btn-default" />
                    </form>
                </div>
            </div>
        </div>

        <br/>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['schoolName']) && $_SESSION['schoolName'] != NULL) {
                        echo '<div class="alert alert-info">';
                        echo "School: $_SESSION[schoolName]";
                        echo '</div>';
                        $_SESSION['schoolName'] = NULL;
                    }

                    if (isset($_SESSION['clubs']) && $_SESSION['clubs'] != NULL) {
                        echo "<table class='table table-hover'>
                            <thead>
                            <tr>
                            <th>Clubs</th>
                            </tr>
                            </thead>
                            <tbody>";
                        if (count($_SESSION['clubs']) > 0) {
                            foreach ($_SESSION['clubs'] as $club) {
                                echo "<tr><td>$club[0]</td></tr>";
                            }
                            $_SESSION['clubs'] = NULL;
                        } else {
                            echo "<tr><td>Sorry, no records found. Please retry.</td></tr>";
                        }
                        echo "</tbody></table>";
                    } else if (isset($_SESSION['kids']) && $_SESSION['kids'] != NULL) {
                        echo "<table class='table table-hover'>
                            <thead>
                            <tr>
                            <th>Name</th>
                            <th>email</th>
                            </tr>
                            </thead>
                            <tbody>";
                        if (count($_SESSION['kids']) > 0) {
                            foreach ($_SESSION['kids'] as $kid) {
                                echo "<tr><td>$kid[0]</td><td>$kid[1]</td></tr>";
                            }
                            $_SESSION['kids'] = NULL;
                        } else {
                            echo "<tr><td colspan='2'>Sorry, no records found. Please retry.</td></tr>";
                        }
                        echo "</tbody></table>";
                    } else if (isset($_SESSION['connection']) && $_SESSION['connection'] != NULL) {
                        echo '<div class="alert alert-info">';
                        echo "Connected? - $_SESSION[connection]";
                        echo '</div>';
                        $_SESSION['connection'] = NULL;
                    }
                    ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        
        <br/>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
                    echo "<table class='table table-hover'>
                        <thead>
                        <tr>
                        <th>Query Type</th>
                        <th>Search Text 1</th>
                        <th>Search Text 2</th>
                        <th>Time</th>
                        <th></th>
                        </tr>
                        </thead>";
                    if (count($queries) > 0) {
                        foreach ($queries as $q) {
                            echo "<tbody><tr>";
                            echo "<form method='POST' action='queryHandler.php'>";
                            echo "<input type='hidden' name='queryid' value='$q[1]' />";
                            switch ($q[1]) {
                                case 'query1':
                                    echo "<td>Find school and clubs</td>";
                                    break;
                                case 'query2':
                                    echo "<td>Find school and kids</td>";
                                    break;
                                case 'query3':
                                    echo "<td>Find connection</td>";
                                    break;
                                default:
                                    break;
                            }
                            echo "<input type='hidden' name='queryText' value='$q[2]' />";
                            echo "<input type='hidden' name='queryText2' value='$q[3]' />";
                            echo "<td>$q[2]</td><td>$q[3]</td><td>$q[4]</td>";
                            echo "<td><input type='submit' value='Find again' class='btn btn-default' /></td>";
                            echo "</form></tr></tbody>";
                        }
                    }
                    echo '</table>';
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>