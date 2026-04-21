<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

session_start();
unset($_SESSION['admin']);
$_SESSION = [];
session_destroy();
header("Location: ./index.php");

?>