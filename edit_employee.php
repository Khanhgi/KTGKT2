<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhân viên</title>
    <style>
        form {
            width: 300px;
            margin: 50px auto;
            /* Căn giữa form */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        form label {
            display: block;
            margin-bottom: 8px;
        }

        form input[type="text"],
        form input[type="password"] {
            width: calc(100% - 20px);
            /* Chiều rộng của input trừ đi khoảng lề */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<?php
include './Database/dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql_update = "UPDATE NHANVIEN SET Ten_NV = '$ten_nv', Phai = '$phai', Noi_Sinh = '$noi_sinh', Ma_Phong = '$ma_phong', Luong = '$luong' WHERE Ma_NV = '$id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: NVList.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_select = "SELECT * FROM NHANVIEN WHERE Ma_NV = '$id'";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
    } else {
        echo "Không tìm thấy nhân viên.";
    }
}
?>

    <form method="POST" action="">
        <label for="ten_nv">Tên nhân viên:</label><br>
        <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $row['Ten_NV']; ?>"><br>

        <label for="phai">Phái:</label><br>
        <input type="text" id="phai" name="phai" value="<?php echo $row['Phai']; ?>"><br>

        <label for="noi_sinh">Nơi sinh:</label><br>
        <input type="text" id="noi_sinh" name="noi_sinh" value="<?php echo $row['Noi_Sinh']; ?>"><br>

        <label for="ma_phong">Mã phòng:</label><br>
        <input type="text" id="ma_phong" name="ma_phong" value="<?php echo $row['Ma_Phong']; ?>"><br>

        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong" value="<?php echo $row['Luong']; ?>"><br>

        <button type="submit">Cập nhật</button>
    </form>

</body>

</html>