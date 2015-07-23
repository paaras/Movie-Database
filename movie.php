<html>
<head>
<title>
Movie Database
</title>
</head>
<body>
<h1>Movie Details</h1>

<form action = "new.php" method = "get">
Search for Movies & Actors: 
<input type = "text" name = "input" size = 10 maxlength = 20>
<input type = "submit" value="Search">
</form>

<?php
$id = $_GET["input"];
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection) {
	$errmsg = mysql_error($db_connection);
	print "Connection failed: $errmsg <br>";
	exit(1);
}

mysql_select_db("CS143", $db_connection);
$query = "select title, year, rating, company from Movie
	  where id = '$id'";
$rs = mysql_query($query, $db_connection);

 $row = mysql_fetch_row($rs);
	$title = $row[0];
	$year = $row[1];
	$rating = $row[2];
	$company = $row[3];
	print "Title: $title";
	print "<br>";
	print "Year: $year";
	print "<br>";
	print "Rating: $rating";
	print "<br>";
	print "Studio: $company";
	print "<br>";

$dirQ = "select did from MovieDirector where mid = '$id'";
$rsdir = mysql_query($dirQ, $db_connection);
while($dirow = mysql_fetch_row($rsdir)) {
	$dirnameq = "select first, last from Director where id = '$dirow[0]'";
	$dirnamers = mysql_query($dirnameq, $db_connection);
	$namerow = mysql_fetch_row($dirnamers);
	print "Director: $namerow[0] $namerow[1]";
	print "<br>";
}

$genreQ = "select genre from MovieGenre where mid = '$id'";
$rsgenre = mysql_query($genreQ, $db_connection);
while($genre = mysql_fetch_row($rsgenre)) {
	print "Genre: $genre[0]";
	print "<br>";
}

$query2 = "select aid, role from MovieActor where mid = '$id'";
$rs2 = mysql_query($query2, $db_connection);
print "--------------------------------------------------<br>";
while($row2 = mysql_fetch_row($rs2)) {
	$aid = $row2[0];
	$role = $row2[1];
	$query3 = "select first, last, id from Actor where id = '$aid'";
	$rs3 = mysql_query($query3, $db_connection);
	$row3 = mysql_fetch_row($rs3);
	print "<a href = http://192.168.56.20/~cs143/actor.php?input=$row3[2]>
		$row3[0] $row3[1]</a> as $role";
	print "<br>";
}

print "--------------------------------------------------<br>";
print "<a href = http://192.168.56.20/~cs143/review.php?input=$id>Add Review</a>";
print "<br>";
print "<a href = http://192.168.56.20/~cs143/act2mov.php?input=$id>Add Actor</a>";
print "<br>";
print "<a href = http://192.168.56.20/~cs143/dir2mov.php?input=$id>Add Director</a>";
print "<br>";
print "<br>";
print "<a href = http://192.168.56.20/~cs143/newactor.php>Add New Actor/Director to Database</a>";
print "<br>";
print "<a href = http://192.168.56.20/~cs143/newmovie.php>Add New Movie to Database</a>";
print "<br>";
print "<a href =  http://192.168.56.20/~cs143/new.php>Home</a>";
print "<br>";


$avquery = "select avg(rating) from Review where mid = '$id'";
$query3 = "select name, time, rating, comment from Review where mid = '$id'";
$rs3 = mysql_query($query3, $db_connection);
$avrs = mysql_query($avquery, $db_connection);
$ave = mysql_fetch_row($avrs);
print "<h3>Average Rating: $ave[0]</h3>";
while($row3 = mysql_fetch_row($rs3)) {
	print "<p><b>$row3[0]</b> gave it a <b>$row3[2]/10</b>";
	print "<br>";
	print "$row3[3]";
	print "<br>";
	print "$row3[1]";
}
mysql_close($db_connection);
?>

</body>
</html>
