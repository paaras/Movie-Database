<html>
<head>
<title>Movie Database</title>
</head>
<body>

<h1>New Actor/Director</h1>

<?php
if(isset($_GET['add']))
{
$dbhost = 'localhost:';
$dbuser = 'cs143';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$type = $_GET['type'];
$first = $_GET['first'];
$last = $_GET['last'];
$sex = $_GET['sex'];
$month = $_GET['month'];
$date = $_GET['date'];
$year = $_GET['year'];
$dmonth = $_GET['dmonth'];
$ddate = $_GET['ddate'];
$dyear = $_GET['dyear'];

if($dmonth == 0) { 
	$dday = "NULL";
}
else {
	$dday = "concat('$dyear', concat('-', concat('$dmonth', concat('-', '$ddate'))))";
}

mysql_select_db('CS143');

$numquery = "select id from MaxPersonID";
$res = mysql_query($numquery, $conn);
$numrow = mysql_fetch_row($res);
$id = $numrow[0];
$numquery = "update MaxPersonID set id=id+1";
mysql_query($numquery, $conn);

if ($type == "Actor") {
$sql = "INSERT INTO Actor ".
       "(id, last, first, sex, dob, dod) ".
       "VALUES ".
       "('$id', '$last', '$first', '$sex', concat('$year', concat('-', concat('$month', concat('-', '$date')))), $dday)";
}
else {
$sql = "INSERT INTO Director ".
       "(id, last, first, dob, dod) ".
       "VALUES ".
       "('$id', '$last', '$first', concat('$year', concat('-', concat('$month', concat('-', '$date')))), $dday)";
}


$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

echo "Entered data successfully\n";
mysql_close($conn);
}
?>

<form method="get" action="<?php $_PHP_SELF ?>">
Type: <select name="type"><option>Actor</option><option>Director</option></select>
<br>First Name: <input name="first" type="text">
<br>Last Name: <input name="last" type="text">
<br>Sex: <select name="sex"><option>Male</option><option>Female</option></select>
<br>Date of Birth: <select name="month"><option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option></select>
<select name="date"><option>01</option><option>02</option><option>03</option>
<option>04</option><option>05</option><option>06</option><option>07</option>
<option>08</option><option>09</option><option>10</option><option>11</option>
<option>12</option><option>13</option><option>14</option><option>15</option>
<option>16</option><option>17</option><option>18</option><option>19</option>
<option>20</option><option>21</option><option>22</option><option>23</option>
<option>24</option><option>25</option><option>26</option><option>27</option>
<option>28</option><option>29</option><option>30</option><option>31</option></select>
<input type="text" name="year" size=10 maxlength=4>

<br>Date of Death: <select name="dmonth"><option value="0">N/A</option>
					<option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option></select>
<select name="ddate"><option>01</option><option>02</option><option>03</option>
<option>04</option><option>05</option><option>06</option><option>07</option>
<option>08</option><option>09</option><option>10</option><option>11</option>
<option>12</option><option>13</option><option>14</option><option>15</option>
<option>16</option><option>17</option><option>18</option><option>19</option>
<option>20</option><option>21</option><option>22</option><option>23</option>
<option>24</option><option>25</option><option>26</option><option>27</option>
<option>28</option><option>29</option><option>30</option><option>31</option></select>
<input type="text" name="dyear" size=10 maxlength=4 default="0000">
<br>
<input name="add" type="submit" id="add">
</form>

<a href =  http://192.168.56.20/~cs143/new.php>Home</a>
<br>

</body>
</html>
