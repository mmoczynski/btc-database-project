<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die();

template_include(__DIR__ . "/header.php", [
    'title' => 'Access Denied'
]); 

?>

<p>Access denied. Please log in.</p>

<?php include(__DIR__ . "/footer.php"); ?>