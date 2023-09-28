<?php
    $birthday = "1990-05-15";
    $birthdayTimestamp = strtotime($birthday);
    $now = time();

    $age = date("Y", $now) - date("Y", $birthdayTimestamp);
    if (date("md", $now) < date("md", $birthdayTimestamp)) {
        $age--;
    }
    echo "Tuoi cua ban la: " .$age;