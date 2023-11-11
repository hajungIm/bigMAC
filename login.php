<?php
    session_start();

    $conn = mysqli_connect("localhost", "team04", "team04", "team04");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login_id = $_POST['login_id'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM member WHERE login_id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $login_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Password is correct, create a session for the user
                $_SESSION['user_id'] = $user['member_id'];
                $_SESSION['name'] = $user['member_name'];
    
                // Redirect to the user dashboard or another page
                header('Location: dashboard.php');
                exit();
            } else {
                echo "Incorrect password. Please try again.";
            }
        } else {
            echo "User not found. Please try again.";
        }
    }
    $conn->close();
?>