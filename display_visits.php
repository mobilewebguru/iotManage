<?php include("visitor_tracking.php");
require_once('visitors_connections.php');//the file with connection code and functions

// if ($_GET['start'] == "") $start = 0;
// else $start = $_GET['start'];
$start = 0;
$limit = 15;

$additionalQuery = "SQL_CALC_FOUND_ROWS ";

mysqli_select_db($link, "iotmanage");
$query_visitors = "(SELECT ".$additionalQuery." * FROM visitors_table WHERE";

if ($_POST['day']!="") {
$query_visitors .= " visitor_day = '".$_POST['day']."'";
} else {
$query_visitors .= " visitor_day = ".date("d")."";

if ($_POST['month']!="") {
$query_visitors .= " AND visitor_month = '".$_POST['month']."'";
} else {
$query_visitors .= " AND visitor_month = ".date("m")."";
}

if ($_POST['year']!="") {
$query_visitors .= " AND visitor_year = '".$_POST['year']."'";
} else {
$query_visitors .= " AND visitor_year = ".date("Y")."";
}}
$query_visitors .= " LIMIT $start,$limit)";
$insert_visitors = $link->query($query_visitors, MYSQLI_USE_RESULT) or die(mysql_error());
$row_visitors = "";
// $row_visitors = mysqli_fetch_assoc($insert_visitors);
$totalRows_visitors = "";
// $totalRows_visitors = mysql_num_rows($insert_visitors);

$nbItems = "";
// $nbItems = mysql_result($link->query("Select FOUND_ROWS() AS nbr"),0,"nbr");
if ($nbItems>($start+$limit)) $final = $start+$limit;
else $final = $nbItems;

echo '<table style="width:100%; border:1px dashed #CCC" cellpadding="3">
      <form id="form1" name="form1" method="post" action="display_visits.php">
       <tr>
        <td>day
        <select name="day" id="day">
          <option value="" selected="selected"></option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select></td>
        <td>Month
        <select name="month" id="month">
          <option value="" selected="selected"></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select></td>
        <td>Year
        <select name="year" id="year">
          <option value="" selected="selected"></option>
          <option value="2007">2007</option>
        </select></td>
        <td><input type="submit" name="Submit" value="Submit" /></td>
        <td></td>
       </tr>';

echo '<tr>
        <td style="width:15%;border-bottom:1px solid #CCC">IP</td>
        <td style="width:15%;border-bottom:1px solid #CCC">Browser</td>
        <td style="width:15%;border-bottom:1px solid #CCC">Time</td>
        <td style="width:30%;border-bottom:1px solid #CCC">Refferer</td>
        <td style="width:25%;border-bottom:1px solid #CCC">Page</td>
       </tr>';

do {

echo '<tr onmouseout="this.style.backgroundColor=\'\'"
      onmouseover="this.style.backgroundColor=\'#EAFFEA\'">
        <td>'.$row_visitors['visitor_ip'].'</td>
        <td>'.$row_visitors['visitor_browser'].'</td>
        <td>'.$row_visitors['visitor_hour'].':'.$row_visitors['visitor_minute'].'</td>
        <td>'.$row_visitors['visitor_refferer'].'</td>
        <td>'.$row_visitors['visitor_page'].'</td>
       </tr>';
} while ($row_visitors = mysql_fetch_assoc($insert_visitors));
paginate($start,$limit,$nbItems,"display_visits.php","");
?>

