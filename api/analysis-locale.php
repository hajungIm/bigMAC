<?php
$servername = "localhost";
$username = "team04"; 
$password = "team04";
$dbname = "team04"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT avenue, COUNT(restaurant_id) AS restaurant_count 
          FROM restaurant 
          GROUP BY avenue";
$result = $conn->query($query);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

echo json_encode($data);
?>
