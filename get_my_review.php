<?php

$mysqli=mysqli_connect("localhost", "team04", "team04", "team04");

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_errno());
  exit();
}
else {
    $sql = "SELECT rv.rating, rv.comment, rt.restaurant_name FROM review AS rv
    INNER JOIN restaurant AS rt ON rv.restaurant_id = rt.restaurant_id
    WHERE rv.member_id = ?";

    if ($stmt = $mysqli->prepare($sql)) {

        $member_id = '로그인한 회원 id';
        $stmt->bind_param("s", $member_id);

        $stmt->execute();

        $stmt->bind_result($rating, $comment, $restaurant_name);

        $results = array();
        while ($stmt->fetch()) {
          $results[] = array(
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
