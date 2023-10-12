<?php
$host = "127.0.0.1";
$database = "test1";
$username = "root";
$password = "";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Kết nối thất bại: " .$connection->connect_error);
}
echo "Đã kết nối thành công<br>";

$query = "CREATE TABLE MyGuests (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,firstname 
VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,email VARCHAR(50),reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
if ($connection->query($query) === TRUE) {
    echo "Tạo Bảng thành công<br>";
} else {
    echo "Thất bại: " . $connection->error . "<br>";
}
$connection->close();