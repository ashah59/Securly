<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'securlydb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
session_start(); // starting the session //
if (!empty($_POST ['user'])) {
// checking the user name which is from index.php, is it empty or have some text
    $query = mysql_query("SELECT * FROM login where adminid = '$_POST[user]' AND password = '$_POST[pass]'") or die(mysql_error());
    $row = mysql_fetch_array($query);
    
    if (!empty($row ['adminid']) and !empty($row ['password'])) {
        $_SESSION ['adminId'] = $row ['adminid'];
        $_SESSION ['adminName'] = $row ['name'];
        header('Location:home.php');
    } else {
        $_SESSION['msg'] = "Sorry, You entered wrong id and password. Please retry.";
        header('Location:index.php');
    }
} else {
    echo "Enter username and password again.";
}