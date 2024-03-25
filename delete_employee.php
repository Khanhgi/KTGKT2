<?php
include './Database/dbconfig.php'; 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM NHANVIEN WHERE Ma_NV = '$id'";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: NVList.php");
        exit();
    } else {
        echo "Lỗi xoá nhân viên: " . $conn->error;
    }
}
?>
