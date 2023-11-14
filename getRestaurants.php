<?php
$servername = "localhost";
$username = "root"; 
$password = "team04";
$dbname = "team04"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT r.restaurant_name, 
    CONCAT(r.avenue, ' avenue, ',r.borough) AS location, 
    TRIM(TRAILING ', ' FROM CONCAT(
    CASE WHEN monday = 0 THEN 'Mon, ' ELSE '' END,
    CASE WHEN tuesday = 0 THEN 'Tue, ' ELSE '' END,
    CASE WHEN wednesday = 0 THEN 'Wed, ' ELSE '' END,
    CASE WHEN thursday = 0 THEN 'Thu, ' ELSE '' END,
    CASE WHEN friday = 0 THEN 'Fri, ' ELSE '' END,
    CASE WHEN saturday = 0 THEN 'Sat, ' ELSE '' END,
    CASE WHEN sunday = 0 THEN 'Sun, ' ELSE '' END
)) AS closed_days,
r.cuisine, 
r.review_count
FROM restaurant r 
JOIN restaurant_open_days o ON r.open_days_id = o.open_days_id
LEFT JOIN review rv ON r.restaurant_id = rv.restaurant_id
GROUP BY 
r.restaurant_id
ORDER BY 
AVG(rv.rating) DESC";

$stmt = $conn->query($query);
// 결과를 배열로 변환
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $restaurants = array();

    while ($row = $result->fetch_assoc()) {
        $restaurants[] = array(
            'restaurant_name' => $row['restaurant_name'],
            'location' => $row['location'],
            'closed_days' => $row['closed_days'],
            'cuisine' => $row['cuisine'],
            'review_count' => $row['review_count']
        );
    }
    header('Content-Type: application/json');
    echo json_encode($restaurants);
} else {
    echo "No results found.";
}

$conn->close();
?>