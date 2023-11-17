<?php

$mysqli = mysqli_connect("localhost", "team04", "team04", "team04");

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$sql = "WITH RankedRestaurants AS (
  SELECT
  rml.restaurant_id,
  CASE
  WHEN m.age BETWEEN 0 AND 19 THEN 'teen'
  WHEN m.age BETWEEN 20 AND 39 THEN 'young'
  WHEN m.age BETWEEN 40 AND 59 THEN 'middle'
  END AS AgeGroup,
  COUNT(rml.restaurant_id) AS like_count,
  ROW_NUMBER() OVER (PARTITION BY CASE
    WHEN m.age BETWEEN 0 AND 19 THEN 'teen'
    WHEN m.age BETWEEN 20 AND 39 THEN 'young'
    WHEN m.age BETWEEN 40 AND 59 THEN 'middle'
    END ORDER BY COUNT(rml.restaurant_id) DESC) AS Rank
    FROM
    restaurant_member_likes rml
    JOIN
    member m ON rml.liked_member_id = m.member_id
    GROUP BY
    rml.restaurant_id, AgeGroup
  ),
  TopRestaurants AS (
    SELECT
    rr.restaurant_id,
    rr.AgeGroup,
    rr.like_count
    FROM
    RankedRestaurants rr
    WHERE
    rr.Rank <= 5
  )
  SELECT
  tr.AgeGroup,
  r.restaurant_name,
  MIN(m.price) AS minPrice,
  MAX(m.price) AS maxPrice,
  tr.like_count
  FROM
  TopRestaurants tr
  JOIN
  restaurant r ON tr.restaurant_id = r.restaurant_id
  JOIN
  menu_list ml ON r.restaurant_id = ml.restaurant_id
  JOIN
  menu m ON ml.menu_id = m.menu_id
  GROUP BY
  tr.AgeGroup, r.restaurant_name, tr.like_count
  ORDER BY tr.like_count DESC";

  $stmt = $mysqli->query($sql);

  // 결과를 배열로 변환
  $result = [];
  while ($row = mysqli_fetch_assoc($stmt)) {
    $ageGroup = $row['AgeGroup'];
    if (!isset($result[$ageGroup])) {
      $result[$ageGroup] = [];
    }
    $result[$ageGroup][] = [
      'restaurantName' => $row['restaurant_name'],
      'likeCount' => $row['like_count'],
      'minPrice' => $row['minPrice'],
      'maxPrice' => $row['maxPrice']
    ];
  }

  // PHP 배열을 JSON으로 인코딩하고 출력
  header('Content-Type: application/json');
  echo json_encode($result);
  exit;
  ?>
