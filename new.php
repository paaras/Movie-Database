<html>
<head>
<title>
Movie Database
</title>
</head>
<body>
<h1>Search Results</h1>

<form action = "new.php" method = "get">
Search for Movies & Actors: 
<input type = "text" name = "input" size = 10 maxlength = 20>
<input type = "submit" value="Search">
</form>

<?php
if($name = $_GET["input"])
{
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection) {
	$errmsg = mysql_error($db_connection);
	print "Connection failed: $errmsg <br>";
	exit(1);
}
print "<h3>Actors</h3>";
mysql_select_db("CS143", $db_connection);
$query = "select first, last, id from Actor
	  where concat(first, ' ', last) like '%$name%'
	     or concat(last, ' ', first) like '%$name%'";
$rs = mysql_query($query, $db_connection);

while($row = mysql_fetch_row($rs)) {
	$first = $row[0];
	$last = $row[1];
	$actid = $row[2];
	print "<a href = http://192.168.56.20/~cs143/actor.php?input=$actid>
		$first $last</a>";
	print "<br>";
}

print "<h3>Movies</h3>";
$query2 = "select title, id from Movie
	   where title like '%$name%'";
$rs2 = mysql_query($query2, $db_connection);

while($row2 = mysql_fetch_row($rs2)) {
	$title = $row2[0];
	$id = $row2[1];
	print "<a href = http://192.168.56.20/~cs143/movie.php?input=$id>$title</a>";
	print "<br>";
}

mysql_close($db_connection);
}
?>
<br>
<a href = http://192.168.56.20/~cs143/newactor.php>Add a New Actor/Director to the Database</a>
<br><a href = http://192.168.56.20/~cs143/newmovie.php>Add a New Movie to the Database</a>

</body>
</html>
