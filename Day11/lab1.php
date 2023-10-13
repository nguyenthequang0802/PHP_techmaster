<?php
    $severname = "localhost";
    $username = "root";
    $password = "";
    $dbname =  "Day11";

    $conn = new mysqli($severname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

//    $sql = "INSERT INTO users (userId, userName, email, user_password, addressId)
//            VALUES (19, 'ABC', 'abc@gmail.com', '12345', 20),
//                   (20, 'XYZ', 'xyz@gmail.com', '123456', 18)";
//
//    if ($conn->query($sql) === true) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }
//
//    $sql = "UPDATE users
//            SET user_password = 'abc2002'
//            where userId = 2";
//    if ($conn->query($sql) === true) {
//        echo "New record update successfully<br>";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }
//
//    $sql = "DELETE FROM users where userId = 20";
//    if ($conn->query($sql) === true) {
//        echo "New record delete successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }


    $conn->close();
