<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $phone = $_POST["phone"];
        $date = $_POST["date"];
        $address = $_POST["address"];

        $errors = [];
        $is_validate = true;

        function validate_name($name, &$errors) {
            global $is_validate;
            if (empty($name)) {
                $errors[] = "Không được để trống tên!";
                $is_validate = false;
            }
            if (strlen($name) < 3 || strlen($name) > 50) {
                $errors[] = "Tên bạn phải nhập có ít nhất 3 ký tự và không quá 50 ký tự!";
                $is_validate = false;
            }
            if(!preg_match("([a-zA-Z]{2,}\s[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)", $name)) {
                $errors[] = "Tên của bạn không được chưa ký tự đặc biệt!";
                $is_validate = false;
            }
        }

        function validate_email($email, &$errors) {
            global  $is_validate;
            if (empty($email)) {
                $errors[] = "Không được để trống email!";
                $is_validate = false;
            }
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
                $errors[] = "Email không đúng định dạng!";
                $is_validate = false;
            }
        }

        function validate_password($password, $confirm_password, &$errors) {
            global $is_validate;
            if (empty($password)) {
                $errors[] = "Không được để trống mật khẩu!";
                $is_validate = false;
            }
            if (strlen($password) < 8) {
                $errors[] = "Mật khẩu của bạn pahir có ít nhất 8 ký tự!";
                $is_validate = false;
            }
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$!%^&*?])[A-Za-z\d@#$!%^&*?]{8,}$/', $password)) {
                $errors[] = "Mật khẩu chứa chữ cái in hoa, chữ cái thường và các ký tự đặc biệt!";
                $is_validate = false;
            }
            if ($password !== $confirm_password) {
                $errors[] = "Mật khẩu không khớp!";
                $is_validate = false;
            }
        }

        function validate_phoneNumber($phone, &$errors) {
            global $is_validate;
            if (!preg_match('/^\+?\d{8,15}$/', $phone)) {
                $errors[] = "Số điện thoại nhập không đúng định dạng";
                $is_validate = false;
            }
        }

        function validate_day($date, &$errors) {
            global $is_validate;
            $timestamp = strtotime($date);

            if ($timestamp === false && $timestamp == -1) {
                $errors[] = "Không đúng định dạng ngày/tháng năm: " . date("d/m/Y", $timestamp);
                $is_validate = false;
            }
        }

        function validate_address($address, &$errors) {
            global $is_validate;
            if (strpos($address, ',') === false || strpos($address,' ') === false) {
                $errors[] = "Điền địa chỉ cụ thể!";
                $is_validate = false;
            }
        }

        validate_name($name, $errors);
        validate_email($email, $errors);
        validate_password($password, $confirm_password, $errors);
        validate_phoneNumber($phone, $errors);
        validate_day($date, $errors);
        validate_address($address, $errors);

        if ($is_validate) {
            echo "Dăng ký thành công!";
        } else {
            echo "<pre>";
            print_r($errors);
            echo  "</pre>";
        }
    }
