<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
} 

?>