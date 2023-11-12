<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
  session_start();

  function get_data($conn, $query) {
    $result = $conn->query($query);
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = array(
                "rating" => $row['rating'],
                "avg_price" => $row['avg_price']
            );
        }
    } else {
        $data[] = array(
            "rating" => null,
            "avg_price" => null 
        );
    }
    return $data;
}
  
$servername = "localhost";
$username = "team04";
$password = "team04";
$dbname = "team04";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
  

// 1. 고급진+비싼, 2. 고급진+싼, 3. 친밀+비싼, 4. 친밀+싼   
$queries = array(
"SELECT ROUND(AVG(rev.rating), 2) AS rating, ROUND(AVG(expensive_expensive_res.avg_price), 2) AS avg_price
FROM
(
    SELECT r.restaurant_id, AVG(m.price) as avg_price
    FROM restaurant r
    JOIN restaurant_hashtag rh ON r.restaurant_id = rh.restaurant_id
    JOIN hashtag h ON rh.hashtag_id = h.hashtag_id
    JOIN menu_list ml ON r.restaurant_id = ml.restaurant_id
    JOIN menu m ON ml.menu_id = m.menu_id
    WHERE h.hashtag_name IN ('FineDining', 'RooftopDining')
    GROUP BY r.restaurant_id
    HAVING avg_price >= 22
) as expensive_expensive_res
JOIN review rev ON expensive_expensive_res.restaurant_id = rev.restaurant_id;",
"SELECT ROUND(AVG(rev.rating), 2) AS rating, ROUND(AVG(cheap_expensive_res.avg_price), 2) AS avg_price
FROM
(
    SELECT r.restaurant_id, AVG(m.price) as avg_price
    FROM restaurant r
    JOIN restaurant_hashtag rh ON r.restaurant_id = rh.restaurant_id
    JOIN hashtag h ON rh.hashtag_id = h.hashtag_id
    JOIN menu_list ml ON r.restaurant_id = ml.restaurant_id
    JOIN menu m ON ml.menu_id = m.menu_id
    WHERE h.hashtag_name IN ('FineDining', 'RooftopDining')
    GROUP BY r.restaurant_id
    HAVING avg_price <= 7
) as cheap_expensive_res
JOIN review rev ON cheap_expensive_res.restaurant_id = rev.restaurant_id;",
"SELECT ROUND(AVG(rev.rating), 2) AS rating, ROUND(AVG(expensive_casual_res.avg_price), 2) AS avg_price
FROM
(
    SELECT r.restaurant_id, AVG(m.price) as avg_price
    FROM restaurant r
    JOIN restaurant_hashtag rh ON r.restaurant_id = rh.restaurant_id
    JOIN hashtag h ON rh.hashtag_id = h.hashtag_id
    JOIN menu_list ml ON r.restaurant_id = ml.restaurant_id
    JOIN menu m ON ml.menu_id = m.menu_id
    WHERE h.hashtag_name IN ('CasualDining', 'BistroVibes')
    GROUP BY r.restaurant_id
    HAVING avg_price >= 14
) as expensive_casual_res
JOIN review rev ON expensive_casual_res.restaurant_id = rev.restaurant_id;",
"SELECT ROUND(AVG(rev.rating), 2) AS rating, ROUND(AVG(cheap_casual_res.avg_price), 2) AS avg_price
FROM
(
    SELECT r.restaurant_id, AVG(m.price) as avg_price
    FROM restaurant r
    JOIN restaurant_hashtag rh ON r.restaurant_id = rh.restaurant_id
    JOIN hashtag h ON rh.hashtag_id = h.hashtag_id
    JOIN menu_list ml ON r.restaurant_id = ml.restaurant_id
    JOIN menu m ON ml.menu_id = m.menu_id
    WHERE h.hashtag_name IN ('CasualDining', 'BistroVibes')
    GROUP BY r.restaurant_id
    HAVING avg_price <= 10
) as cheap_casual_res
JOIN review rev ON cheap_casual_res.restaurant_id = rev.restaurant_id;"
);

$data = array();
$groups = array('expensive_expensive_res', 'cheap_expensive_res', 'expensive_casual_res', 'cheap_casual_res');
for ($i = 0; $i < count($queries); $i++) {
    $result = get_data($conn, $queries[$i]);
    if ($conn->error) {
        echo "Query execution error: " . $conn->error;
    } else {
        $data[$groups[$i]] = array(
            'rating' => $result[0]['rating'],
            'avg_price' => $result[0]['avg_price']
        );
    }
}

$conn->close();

// // 더미 데이터 생성
// $data = array();
// for ($i = 0; $i < 4; $i++) {
//   $data[$i] = array("rating" => rand(1, 5));
// }
echo json_encode($data);
  
?>
