<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $type_fb = $_POST["type_fb"];
    $describe = $_POST["describe"];

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

    function validate_type($type_fb, &$errors) {
        global $is_validate;
        if (!empty($type_fb)) {
            $errors[] = "Không được để trống!";
            $is_validate = false;
        }
    }

    function validate_describe($describe, &$errors) {
        global $is_validate;
        if (!empty($type_fb)) {
            $errors[] = "Không được để trống mô tả!";
            $is_validate = false;
        }
    }

    validate_name($name, $errors);
    validate_email($email, $errors);
    validate_type($type_fb, $errors);
    validate_describe($describe, $errors);

    if ($is_validate) {
        echo "Phản hồi thành công!";
    } else {
        echo "<pre>";
        print_r($errors);
        echo  "</pre>";
    }
}
