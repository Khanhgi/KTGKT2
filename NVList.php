<?php
session_start();
include './Database/dbconfig.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
        .table-container {
            position: relative;
        }

        .add-employee-button,
        .logout-button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-employee-button {
            position: absolute;
            top: -40px;
            right: 0;
            margin: 0px;
            background-color: #4CAF50;
            color: white;
        }

        .logout-button {
            background-color: #f44336;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            margin-top: 10px;
        }

        .pagination a {
            padding: 8px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
            color: black;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .gender-img {
            width: 30px;
            height: auto;
        }

        .button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-button {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <h2>Danh sách nhân viên</h2>

    <form method="post" action="">
       <input type="submit" value="Logout" name="logout" class="logout-button">
    </form>

    <div class="table-container">
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
            <button class="button add-employee-button" onclick="location.href='add_employee.php'">Thêm nhân viên</button>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Tên NV</th>
                    <th>Phái</th>
                    <th>Nơi sinh</th>
                    <th>Tên Phòng</th>
                    <th>Lương</th>
                    <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include './Database/dbconfig.php';

                $records_per_page = 5;

                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                $offset = ($current_page - 1) * $records_per_page;

                $sql = "SELECT * FROM NHANVIEN LIMIT $offset, $records_per_page";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Ma_NV"] . "</td>";
                        echo "<td>" . $row["Ten_NV"] . "</td>";
                        echo "<td>";
                        if ($row["Phai"] == "NAM") {
                            echo "<img src='Asset/Image/man.jpg' alt='Nam' class='gender-img'>";
                        } else {
                            echo "<img src='Asset/Image/woman.png' alt='Nữ' class='gender-img'>";
                        }
                        echo "</td>";
                        echo "<td>" . $row["Noi_Sinh"] . "</td>";

                        $ma_phong = $row["Ma_Phong"];
                        $sql_phongban = "SELECT Ten_Phong FROM PHONGBAN WHERE Ma_Phong = '$ma_phong'";
                        $result_phongban = $conn->query($sql_phongban);
                        if ($result_phongban->num_rows > 0) {
                            $row_phongban = $result_phongban->fetch_assoc();
                            echo "<td>" . $row_phongban["Ten_Phong"] . "</td>";
                        } else {
                            echo "<td></td>";
                        }

                        echo "<td>" . $row["Luong"] . "</td>";

                        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                            echo "<td>";
                            echo "<button class='button edit-button' onclick=\"location.href='edit_employee.php?id=" . $row['Ma_NV'] . "'\">Edit</button>";
                            echo "<button class='button delete-button' onclick=\"if(confirm('Bạn có chắc chắn muốn xoá nhân viên này không?')) location.href='delete_employee.php?id=" . $row['Ma_NV'] . "'\">Delete</button>";
                            echo "</td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có nhân viên nào.</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <?php
        $sql_count = "SELECT COUNT(*) AS total FROM NHANVIEN";
        $result_count = $conn->query($sql_count);
        $total_records = $result_count->fetch_assoc()['total'];
        $total_pages = ceil($total_records / $records_per_page);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=$i' ";
            if ($i == $current_page) {
                echo "class='active'";
            }
            echo ">$i</a>";
        }
        ?>
    </div>

</body>

</html>