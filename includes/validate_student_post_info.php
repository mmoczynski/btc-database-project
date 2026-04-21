<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die();

function validate_student_post_into() {

    $err_arr = [];

    $name = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $dob = filter_input(INPUT_POST, "dob");
    $grade = filter_input(INPUT_POST, "grade");

    // Validate name

    if($name === NULL) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Name is not sent</p>");
    }

    if($name === FALSE) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Name is invalid</p>");
    }

    if($name === "") {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Name is blank</p>");
    }

    // Validate email

    if($email === NULL) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Email is not sent</p>");
    }

    if($email === FALSE) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Email is invalid</p>");
    }

    if($email === "") {
        array_push($err_arr, "<p>Email is blank</p>");
    }

    // Validate date of birth

    if($dob === NULL) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Date of birth is not sent</p>");
    }

    if($dob === FALSE) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Date of birth is invalid</p>");
    }

    if($dob === "") {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Date of birth is blank</p>");
    }

    try {
        new DateTime($dob);
    } catch (Throwable $th) {
        echo("<p class=\"notice err\"><strong>Error:</strong> Date of birth is invalid</p>");
        var_dump($th);
    }

    // Validate grade

    if($grade === NULL) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Grade is not sent</p>");
    }

    if($grade === FALSE) {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Grade is invalid</p>");
    }

    if($grade === "") {
        array_push($err_arr, "<p class=\"notice err\"><strong>Error:</strong> Grade is blank</p>");
    }

    // Return errors if there is one

    if(count($err_arr) > 0) {

        return [
            "returnType" => "error",
            "errors" => $err_arr,
            "name" => $name,
            "email" => $email,
            "dob" => $dob,
            "grade" => $grade
        ];

    }

    // Return student info if there are no errors

    else {

        return [
            "returnType" => "success",
            "name" => $name,
            "email" => $email,
            "dob" => $dob,
            "grade" => $grade
        ];
    }

}

?>