<?php
require_once('visitors_connections.php');//the file with connection code and functions
//get the required data
$hostname_visitors = "localhost";
$database_visitors = "iotmanage";
$username_visitors = "root";
$password_visitors = "";

// $visitors = mysqli_connect($hostname_visitors, $username_visitors,
//  $password_visitors) or rigger_error(mysql_error(),E_USER_ERROR);

$visitor_ip = GetHostByName('localhost');
$visitor_browser = getBrowserType();
$visitor_hour = date("h");
$visitor_minute = date("i");
$visitor_day = date("d");
$visitor_month = date("m");
$visitor_year = date("Y");
$visitor_refferer = GetHostByName('localhost');
$visitor_page = selfURL();
$visitor_date = "";

$link = mysqli_connect("localhost", "root", "", "iotmanage");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


// make foo the current db
mysqli_select_db($link, "iotmanage");
// if (!$db_selected) {
//     die ('Can\'t use foo : ' . mysql_error());
// }

//write the required data to database
// mysqli_select_db('iotmanage', $visitors);
$sql = "INSERT INTO visitors_table (visitor_ip, visitor_browser, visitor_hour,
 visitor_minute, visitor_date, visitor_day, visitor_month, visitor_year,
 visitor_refferer, visitor_page) VALUES ('$visitor_ip', '$visitor_browser',
 '$visitor_hour', '$visitor_minute', '$visitor_date', '$visitor_day', '$visitor_month',
 '$visitor_year', '$visitor_refferer', '$visitor_page')";
$result = $link->query($sql, MYSQLI_USE_RESULT) or trigger_error(mysql_error(),E_USER_ERROR);
?>