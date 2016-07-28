<?php
$type = $_GET['tag_type'];
$song = $_GET['song_val'];
$artist = $_GET['artist_val'];
$tag = $_GET['tag_val'];

$con = mysqli_connect('localhost','superuser','superP@$$123','testdb');
if (!$con) {
	die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,'projecttest');

switch(tag_type) {
	case "song":
	// Check for song in database first
	$sql="BEGIN TRANSACTION
		IF EXISTS (SELECT * FROM Tag WHERE song = '".$song."' AND tag = '".$tag."')
		BEGIN
		RAISERROR('Song tag already exists.', 10, 1)
		ROLLBACK TRANSACTION;
		END
		INSERT INTO Tag(song, tag)
			VALUES('".$song."' , '".$tag."')
		COMMIT TRANSACTION;";
	if (mysqli_query($con,$sql)) {
		echo "<p>Song tag pending, please wait approx. 72 hours for tag to appear on the site.</p>";
	} else {
		echo "<p>Error tagging song. Please try again or <a href='#'>contact us.</a></p>";
	}
	break;

	case "artist":
	// Check for song in database first
	$sql="BEGIN TRANSACTION
		IF EXISTS (SELECT * FROM Artist_Tag WHERE artist = '".$artist."' AND tag = '".$tag."')
		BEGIN
		RAISERROR('Artist tag already exists.', 10, 1)
		ROLLBACK TRANSACTION;
		END
		INSERT INTO Artist_Tag(artist, tag)
			VALUES('".$artist."' , '".$tag."')
		COMMIT TRANSACTION;";
	if (mysqli_query($con,$sql)) {
		echo "<p>Artist tag pending, please wait approx. 72 hours for tag to appear on the site.</p>";
	} else {
		echo "<p>Error tagging artist. Please try again or <a href='#'>contact us.</a></p>";
	}
	break;
	break;
}

mysqli_close($con);
?>