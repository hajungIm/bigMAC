<?php

$mysqli = new mysqli("localhost", "team04", "team04", "team04");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$reviewId = $_POST['reviewId'];

$stmt = $mysqli->prepare("DELETE FROM review WHERE review_id = ?");
$stmt->bind_param("i", $reviewId);

if ($stmt->execute()) {
  echo "Review deleted successfully";
} else {
  echo "Error deleting review: " . $mysqli->error;
}

$stmt->close();
$mysqli->close();
 ?>
