<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Thêm nhân viên</h2>
        <form action="add_employee_process.php" method="POST">
            <div class="form-group">
                <label for="ma_nv">Mã nhân viên:</label>
                <input type="text" id="ma_nv" name="ma_nv" required>
            </div>
            <div class="form-group">
                <label for="ten_nv">Tên nhân viên:</label>
                <input type="text" id="ten_nv" name="ten_nv" required>
            </div>
            <div class="form-group">
                <label for="phai">Phái:</label>
                <select id="phai" name="phai" required>
                    <option value="NAM">Nam</option>
                    <option value="NỮ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi sinh:</label>
                <input type="text" id="noi_sinh" name="noi_sinh" required>
            </div>
            <div class="form-group">
                <label for="ma_phong">Mã phòng:</label>
                <input type="text" id="ma_phong" name="ma_phong" required>
            </div>
            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="number" id="luong" name="luong" required>
            </div>
            <div class="form-group">
                <button type="submit">Thêm nhân viên</button>
            </div>
        </form>
    </div>

</body>

</html>
