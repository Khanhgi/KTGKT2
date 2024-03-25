<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) { // Sửa lại điều kiện kiểm tra vai trò
    header("Location: login.php"); 
    exit();
}
include './Database/dbconfig.php'; // Bao gồm tệp cấu hình cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản trị</title>
</head>
<body>
    <h2>Chào mừng <?php echo $_SESSION['fullname']; ?>!</h2>
    <p>Đây là trang quản trị.</p>
    
    <!-- Đặt các chức năng thêm, xoá, sửa nhân viên ở đây -->
    
    <h3>Danh sách nhân viên</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Email</th>
                <th>Vai trò</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Truy vấn dữ liệu từ bảng users
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>";
                    if ($row["RoleID"] == 1) {
                        echo "Admin";
                    } else {
                        echo "User";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có nhân viên nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
