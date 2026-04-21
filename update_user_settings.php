<?php 

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

define("STU_MGMT_SYS", 1);
include("./includes/prepend.php");

// Action settings
$action = filter_input(INPUT_POST, "action");

if($action === "Update Theme") {
    $theme = filter_input(INPUT_POST, "theme");
    set_theme_cookie($theme);
    $_SESSION['user_theme_change'] = true;
    header("Location: ./index.php");
}

if($action === "Set Language") {
    $lang = filter_input(INPUT_POST, "lang");
    set_lang_cookie($lang);
    $_SESSION['user_lang_change'] = true;
    header("Location: ./index.php");
}

?>