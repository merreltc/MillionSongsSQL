<?php

$con = mysqli_connect('localhost','superuser','superP@$$123','testdb');
if (!$con) {
	die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,'projecttest');

$sql="SELECT title AS random_song FROM Song ORDER BY RAND() LIMIT 1";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
	$song = $row['random_song'];
}

echo "<center><h5>Random Song Generator: </h5><div id='random-song'>".$song."</div></center>
			<hr>";

$sql="SELECT s.title, a.name FROM Song s, Artist a WHERE s.artist = a.echonest_id AND title LIKE '".$song."' LIMIT 10";
$result = mysqli_query($con,$sql);

echo "<table style='width:100%'>";

while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td><a href='#'>" . $row['title'] . "<br>" . $row['name'] . "</a></td>";
	echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>