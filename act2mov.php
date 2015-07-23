<html>
<head>
<title>Movie Database</title>
</head>
<body>

<h1>Add Actor</h1>

<?php
$mid = $_GET['input'];
?>

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

$actor = $_GET['actor'];
$role = $_GET['role'];
$mid = $_GET['input'];

$sql = "INSERT INTO MovieActor ".
       "(mid, aid, role) ".
       "VALUES ".
       "('$mid', '$actor', '$role')";

mysql_select_db('CS143');

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
Actor:
<select name="actor">
<?php 
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

$query = "select first, last, dob, id from Actor";
$rs = mysql_query($query, $db_connection);
while($row = mysql_fetch_row($rs)) {
	print "<option value='$row[3]'> $row[0] $row[1] $row[2] </option>";
}

mysql_close($db_connection);
?>
</select>
<br>Role:<input name="role" type="text">
<br>
<input name="input" type="hidden" id="input" value="<?php echo $mid; ?>">
<input name="add" type="submit" id="add">
</form>

<br><a href="http://192.168.56.20/~cs143/movie.php?input=<?php echo $mid; ?>">Back to Movie Page</a>
<br>
<a href =  http://192.168.56.20/~cs143/new.php>Home</a>
<br>

</body>
</html>
