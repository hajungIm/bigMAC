<?php
  session_start();

  $servername = "localhost";
  $username = "team04";
  $password = "team04";
  $dbname = "team04";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // php transaction 시작
    $conn->begin_transaction();
    try {
      // 리뷰 등록 시
      // 입력값
      $rating = $_POST['rating'];
      $comment = $_POST['comment'];
      $restaurant_id = $_POST['restaurant']; 

      //새션에 저장된 정보
      $member_id = $_SESSION['memberId'];

      // insert review
      $stmt = $conn->prepare("INSERT INTO review (member_id, restaurant_id, rating, comment) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiis", $member_id, $restaurant_id, $rating, $comment); 
      if (!$stmt->execute()) {
        throw new Exception("Error: " . $stmt->error);
      }
      $stmt->close();

      // review_count+1
      $stmt = $conn->prepare("UPDATE restaurant SET review_count = review_count + 1 WHERE restaurant_id = ?");
      $stmt->bind_param("i", $restaurant_id);
      if (!$stmt->execute()) {
        throw new Exception("Error: " . $stmt->error);
      }
      $stmt->close();

      // 모든 쿼리 성공 시 commit
      $conn->commit();
      echo "New record created successfully";
    } catch (Exception $e) {
      // 둘 중 하나라도 실패 시 rollback
      $conn->rollback();
      echo $e->getMessage();
    } finally {
      $conn->close();
    }
  } else { // 리뷰 등록 화면 출력을 위한 레스토랑 드롭다운 메뉴 생성
      $sql = "SELECT restaurant_id, restaurant_name 
              FROM restaurant 
              ORDER BY restaurant_name";
      $result = $conn->query($sql);
      $restaurants = array();

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $restaurants[] = $row;
        }
      }
      echo json_encode($restaurants);
  }
  $conn->close();
?>

