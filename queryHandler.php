<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "securlydb";
$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
if (!empty($_POST ['queryText']) && !empty($_POST ['queryid'])) {
    if ($_POST ['queryid'] == "query1") {
        $querySchool = "SELECT s.name FROM kids k, school s where k.schoolid = s.id and k.emailid = '$_POST[queryText]'";
        $getSchool = mysqli_query($conn, $querySchool);
        $school = mysqli_fetch_array($getSchool);
        $_SESSION['schoolName'] = $school ['name'];

        $queryClubs = "SELECT c.name FROM kids k, kidsclub kc, club c where k.emailid = kc.kidsemailid and kc.clubid = c.id and k.emailid = '$_POST[queryText]'";
        $getClubs = mysqli_query($conn, $queryClubs);
        $clubs = null;
        if ($getClubs) {
            $clubs = mysqli_fetch_all($getClubs);
        }

        $queryInsert = "INSERT INTO query (adminid, queryid, queryvalue1, queryvalue2) VALUES ('$_SESSION[adminId]', 'query1', '$_POST[queryText]', NULL)";
        $insert = mysqli_query($conn, $queryInsert);

        if (count($clubs) > 0) {
            $_SESSION ['clubs'] = $clubs;
            header('Location:home.php');
        } else {
            echo "Sorry, No records found. Please retry.";
        }
    } else if ($_POST ['queryid'] == "query2") {
        $querySchool = "SELECT s.name FROM club c, school s where c.schoolid = s.id and c.name = '$_POST[queryText]'";
        $getSchool = mysqli_query($conn, $querySchool);
        $school = mysqli_fetch_array($getSchool);
        $_SESSION['schoolName'] = $school ['name'];

        $queryKids = "SELECT k.name, k.emailid FROM club c, kidsclub kc, kids k where c.id = kc.clubid and kc.kidsemailid = k.emailid and c.name = '$_POST[queryText]'";
        $getKids = mysqli_query($conn, $queryKids);
        $kids = null;
        if ($getKids) {
            $kids = mysqli_fetch_all($getKids);
        }

        $queryInsert = "INSERT INTO query (adminid, queryid, queryvalue1, queryvalue2) VALUES ('$_SESSION[adminId]', 'query2', '$_POST[queryText]', NULL)";
        $insert = mysqli_query($conn, $queryInsert);

        if (count($kids) > 0) {
            $_SESSION ['kids'] = $kids;
            header('Location:home.php');
        } else {
            echo "Sorry, No records found. Please retry.";
        }
    } else if ($_POST ['queryid'] == "query3") {
        if (!empty($_POST ['queryText2'])) {
            $querySchool = "SELECT schoolid FROM kids where emailid = '$_POST[queryText]'";
            $getSchool = mysqli_query($conn, $querySchool);
            $school = mysqli_fetch_array($getSchool);
            $schoolId1 = $school['schoolid'];

            $querySchool = "SELECT schoolid FROM kids where emailid = '$_POST[queryText2]'";
            $getSchool = mysqli_query($conn, $querySchool);
            $school = mysqli_fetch_array($getSchool);
            $schoolId2 = $school['schoolid'];

            $queryInsert = "INSERT INTO query (adminid, queryid, queryvalue1, queryvalue2) VALUES ('$_SESSION[adminId]', 'query3', '$_POST[queryText]', '$_POST[queryText2]')";
            $insert = mysqli_query($conn, $queryInsert);

            if ($schoolId1 != $schoolId2) {
                $_SESSION['connection'] = 'No';
                header('Location:home.php');
            } else {
                $queryClubs = "SELECT clubid FROM kidsclub WHERE kidsemailid= '$_POST[queryText]'";
                $getClubs = mysqli_query($conn, $queryClubs);
                $clubs1 = array();
                if ($getClubs) {
                    while ($row = $getClubs->fetch_assoc()) {
                        array_push($clubs1, $row["clubid"]);
                    }
                }

                $queryClubs = "SELECT clubid FROM kidsclub WHERE kidsemailid= '$_POST[queryText2]'";
                $getClubs = mysqli_query($conn, $queryClubs);
                $clubs2 = array();
                if ($getClubs) {
                    while ($row = $getClubs->fetch_assoc()) {
                        array_push($clubs2, $row["clubid"]);
                    }
                }

                for ($x = 0; $x < count($clubs1); $x++) {
                    $queryClubs = "SELECT DISTINCT(clubid) FROM kidsclub where kidsemailid IN (SELECT kidsemailid FROM kidsclub where clubid = '$clubs1[$x][0]')";
                    $getClubs = mysqli_query($conn, $queryClubs);
                    if ($getClubs) {
                        while ($row = $getClubs->fetch_assoc()) {
                            if (!in_array($row["clubid"], $clubs1)) {
                                array_push($clubs1, $row["clubid"]);
                            }
                        }
                    }
                }
                
                $found = FALSE;
                foreach ($clubs2 as $c) {
                    if (in_array($c[0], $clubs1)) {
                        $_SESSION['connection'] = 'Yes';
                        header('Location:home.php');
                        $found = TRUE;
                    }
                }

                if (!$found) {
                    $_SESSION['connection'] = 'No';
                    header('Location:home.php');
                }
            }
        }
    }
} else {
    echo "Enter query again.";
}