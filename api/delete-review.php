<?php

$mysqli = new mysqli("localhost", "team04", "team04", "team04");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$reviewId = $_POST['reviewId'];

$mysqli->begin_transaction();

try {
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
            $stmt = $mysqli->prepare("UPDATE restaurant SET review_count = review_count - 1 WHERE restaurant_id = ?");
            $stmt->bind_param("i", $restaurantId);

            if ($stmt->execute()) {
                $mysqli->commit();
                echo "Review deleted successfully";
            } else {
                throw new Exception("Error updating restaurant review count: " . $mysqli->error);
            }

            $stmt->close();
        } else {
            throw new Exception("Error deleting review: " . $mysqli->error);
        }
    } else {
        throw new Exception("Error retrieving restaurant ID: " . $mysqli->error);
    }
} catch (Exception $e) {
    $mysqli->rollback();
    echo $e->getMessage();
}

$mysqli->close();
?>
