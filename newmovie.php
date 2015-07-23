<html>
<head>
<title>Movie Database</title>
</head>
<body>

<h1>New Movie</h1>

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
$title = $_GET['title'];
$year = $_GET['year'];
$rating = $_GET['rating'];
$company = $_GET['company'];
//$genre = $_GET['genre'];
mysql_select_db('CS143');
//$numgenre = count($genre);

$numquery = "select id from MaxMovieID";
$res = mysql_query($numquery, $conn);
$numrow = mysql_fetch_row($res);
$id = $numrow[0];
$numquery = "update MaxMovieID set id=id+1";
mysql_query($numquery, $conn);


$sql = "INSERT INTO Movie ".
       "(id, title, year, rating, company) ".
       "VALUES ".
       "('$id', '$title', '$year', '$rating', '$company')";

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

foreach ($_GET['genre'] as $genre) {

$qsql =  "INSERT INTO MovieGenre ".
       "(mid, genre) ".
       "VALUES ".
       "('$id', '$genre')";

mysql_query($qsql, $conn);

}

echo "Entered data successfully\n";
mysql_close($conn);
}
?>

<form method="get" action="<?php $_PHP_SELF ?>">
Title: <input name="title" type="text"></input>
<br>Year: <input name="year" type="text">
<br>Rating: <select name="rating"><option>G</option>
				  <option>PG</option>
				  <option>PG-13</option>
				  <option>R</option>
			          <option>NC-17</option></select>
<br>Company: <input name="company" type="text">
<br>Genre<br><select name = "genre[]" multiple><option>Action</option>
				  <option>Adult</option>
				  <option>Adventure</option>
				  <option>Animation</option>
				  <option>Comedy</option>
				  <option>Crime</option>
			          <option>Documentary</option>
				  <option>Drama</option>
				  <option>Family</option>
				  <option>Fantasy</option>
				  <option>Horror</option>
   			   	  <option>Musical</option>
				  <option>Mystery</option>
				  <option>Romance</option>
				  <option>Sci-Fi</option>
				  <option>Short</option>
				  <option>Thriller</option>
				  <option>War</option>
				  <option>Western</option></select><br>
<br>
<input name="add" type="submit" id="add">
</form>

<a href =  http://192.168.56.20/~cs143/new.php>Home</a>
<br>

</body>
</html>
