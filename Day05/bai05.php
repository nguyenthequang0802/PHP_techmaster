<?php
    $date = "2023-09-29";
    $timestamp = strtotime($date);
    $dayOfWeek = date ('l', $timestamp);
    echo $dayOfWeek;