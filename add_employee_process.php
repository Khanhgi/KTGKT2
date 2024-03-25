<?php
session_start();
include './Database/dbconfig.php';

if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ma_nv = $_POST['ma_nv'];
        $ten_nv = $_POST['ten_nv'];
        $phai = $_POST['phai'];
        $noi_sinh = $_POST['noi_sinh'];
        $ma_phong = $_POST['ma_phong'];
        $luong = $_POST['luong'];

        $stmt = $conn->prepare("INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssd", $ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);
        
        if ($stmt->execute()) {
            header("Location: NVList.php");
            exit();
        } else {
            echo "Thêm nhân viên thất bại: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: add_employee.php");
        exit();
    }
} else {
    echo "Bạn không có quyền truy cập trang này!";
}
?>
