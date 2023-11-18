<?php

$mysqli = new mysqli("localhost", "team04", "team04", "team04");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$reviewId = $_POST['reviewId'];

//현재 리뷰의 레스토랑 ID
$stmt = $mysqli->prepare("SELECT restaurant_id FROM review WHERE review_id = ?");
$stmt->bind_param("i", $reviewId);

if ($stmt->execute()) {
    $stmt->bind_result($restaurantId);
    $stmt->fetch();
    $stmt->close();

    // 리뷰 삭제
    $stmt = $mysqli->prepare("DELETE FROM review WHERE review_id = ?");
    $stmt->bind_param("i", $reviewId);

    if ($stmt->execute()) {
        // 리뷰가 삭제 시 해당 레스토랑의 review_count - 1
        $stmt = $mysqli->prepare("UPDATE restaurant SET review_count = review_count - 1 WHERE restaurant_id = ?");
        $stmt->bind_param("i", $restaurantId);
        
        if ($stmt->execute()) {
            echo "Review deleted successfully";
        } else {
            echo "Error updating restaurant review count: " . $mysqli->error;
        }

        $stmt->close();
    } else {
        echo "Error deleting review: " . $mysqli->error;
    }
} else {
    echo "Error retrieving restaurant ID: " . $mysqli->error;
}

$mysqli->close();
?>
