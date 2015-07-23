<html>
<head>
<title>
Movie Database
</title>
</head>
<body>
<h1>Actor Details</h1>

<form action = "new.php" method = "get">
Search for Movies & Actors:
<input type = "text" name = "input" size = 10 maxlength = 20>
<input type = "submit" value = "Search">
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
$query = "select first, last, sex, dob, dod from Actor where id = '$id'";
$rs = mysql_query($query, $db_connection);

$row = mysql_fetch_row($rs);
$first = $row[0];
$last = $row[1];
$sex = $row[2];
$dob = $row[3];
$dod = $row[4];
print "Name: $first $last";
print "<br>";
print "Sex: $sex";
print "<br>";
print "Birthday: $dob";
print "<br>";
if ($dod != NULL) {
	print "Date Deceased: $dod";
	print "<br>";
}

$query2 = "select mid from MovieActor where aid = '$id'";
$rs2 = mysql_query($query2, $db_connection);
print "<h3>Films</h3>";
while($row2 = mysql_fetch_row($rs2)) {
$mid = $row2[0];
$query3 = "select title from Movie where id = '$mid'";
$rs3 = mysql_query($query3, $db_connection);
$row3 = mysql_fetch_row($rs3);
print "<a href = http://192.168.56.20/~cs143/movie.php?input=$mid>$row3[0]</a>";
print "<br>";
}

mysql_close($db_connection);
?>
<br>
<a href = http://192.168.56.20/~cs143/newactor.php>Add New Actor/Director to Database</a>
<br>
<a href = http://192.168.56.20/~cs143/newmovie.php>Add New Movie to Database</a>
<br>
<a href =  http://192.168.56.20/~cs143/new.php>Home</a>
<br>

</body>
</html>
