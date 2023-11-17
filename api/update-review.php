<?php

$mysqli = new mysqli("localhost", "team04", "team04", "team04");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$reviewId = $_POST['reviewId'];
$comment = $_POST['comment'];

$stmt = $mysqli->prepare("UPDATE review SET comment = ? where review_id = ?");
$stmt->bind_param("si", $comment, $reviewId);

if ($stmt->execute()) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $mysali->error;
}

$stmt->close();
$mysqli->close();
 ?>
