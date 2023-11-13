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
      $restaurant_id = $_POST['restaurant']; // 'restaurant_id'를 'restaurant'으로 변경

      //새션에 저장된 정보
      $member_id = $_SESSION['memberId'];

      $stmt = $conn->prepare("INSERT INTO review (member_id, restaurant_id, rating, comment) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiis", $member_id, $restaurant_id, $rating, $comment); //dynamic query 맞는지 확인

      if ($stmt->execute()) {
        echo "New record created successfully";
        // 변경 사항 발생 시 commit
        $conn->commit();
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    } catch (Exception $e) {
        // 오류 발생 시 rollback
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

