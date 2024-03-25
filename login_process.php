<?php
session_start();
include './Database/dbconfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['RoleID'];

        if ($_SESSION['role'] == 1) { 
            header("Location: NVList.php"); 
        } else {
            header("Location: NVList.php");
        }
    } else {
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }
}
?>
