<html>
<head>
<title>Movie Database</title>
</head>
<body>

<h1>Review</h1>

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

$mid = $_GET['input'];
$name = $_GET['name'];
//$time = $_GET['time'];
$rating = $_GET['rating'];
$comment = $_GET['comment'];

$sql = "INSERT INTO Review ".
       "(name, time, mid, rating, comment) ".
       "VALUES ".
       "('$name', now(), '$mid', '$rating', '$comment')";

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
Name: <input name="name" type="text" id="name">
<br>
Rating:
<select name="rating">
<option>1
<option>2
<option>3
<option>4
<option>5
<option>6
<option>7
<option>8
<option>9
<option>10
</select>
<br>Comments: 
<br><textarea name="comment" rows=8 cols=50>
</textarea>
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
