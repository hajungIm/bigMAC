<?php
session_start();

$mysqli=mysqli_connect("localhost", "team04", "team04", "team04");

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_errno());
  exit();
}
else {
    $sql = "SELECT rv.review_id, rv.rating, rv.comment, rt.restaurant_name FROM review AS rv
    INNER JOIN restaurant AS rt ON rv.restaurant_id = rt.restaurant_id
    WHERE rv.member_id = ?";

    if ($stmt = $mysqli->prepare($sql)) {

        $member_id = $_SESSION['memberId'];
        $stmt->bind_param("s", $member_id);

        $stmt->execute();

        $stmt->bind_result($review_id, $rating, $comment, $restaurant_name);

        $results = array();
        while ($stmt->fetch()) {
          $results[] = array(
            'reviewId' => $review_id,
            'starRate' => $rating,
            'comment' => $comment,
            'restaurantName' => $restaurant_name
          );
        }

        $stmt->close();
        $mysqli->close();
    }
}

header('Content-Type: application/json');

echo json_encode($results);
exit;
?>
