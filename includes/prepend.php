<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die();

/**
 * PHP file for functions and session starting.
 * This must be included before any outputs are made to standard output.
 */

session_start();

function is_logged_in() {
    
    if(isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        return true;
    }

    else {
        return false;
    }
}

function login($username, $password) {

    if($username === "user" && $password === "password") {
        $_SESSION['admin'] = true; 
        return true; 
    }
    
    else {
        return false;
    }
}

/**
 * https://www.php.net/manual/en/function.extract.php
 */

function template_include($path, $variables) {
    extract($variables);
    include($path);
}

function set_theme_cookie($theme) {
    $expires = new DateTime("+1 year");
    setcookie("theme", $theme, $expires->getTimestamp(), "/",);
}

function get_theme_setting() {
    return $_COOKIE['theme'] ?? "dark";
}

function set_lang_cookie($langStr) {
    $expires = new DateTime("+1 year");
    setcookie("lang", $langStr, $expires->getTimestamp(), "/",);
}

function get_lang_setting() {
    return $_COOKIE['lang'] ?? "en-us";
}

?>