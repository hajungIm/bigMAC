<?php
session_start();

$conn = mysqli_connect("localhost", "team04", "team04", "team04");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login_id = $_POST['login_id'];
  $password = $_POST['password'];

  $query = "SELECT * FROM member WHERE login_id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $login_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($password == $user['password']) {
      // Password is correct, create a session for the user
      $_SESSION['memberId'] = $user['member_id'];
      $_SESSION['memberName'] = $user['member_name'];

      // Redirect to the age_analysis.php page
      header('Location: ../pages/index.php');
      exit();
    } else {
      $_SESSION['login_error'] = 'Incorrect password. Please try again.';
      header('Location: ../pages/login.php');
      exit();
    }
  } else {
    $_SESSION['login_error'] = 'Incorrect username. Please try again.';
    header('Location: ../pages/login.php');
    exit();
  }
}
$conn->close();
?>
