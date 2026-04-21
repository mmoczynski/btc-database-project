<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die();

$theme = get_theme_setting();
$lang = get_lang_setting();

?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?> | Student Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <?php if(isset($theme) && $theme !== "dark"): ?>
        <link rel="stylesheet" href="themes/<?=htmlspecialchars($theme)?>.css">
    <?php endif; ?>
</head>
<body>
    <div id="container">
        <div class="col left">
            <ul>
                <?php if(is_logged_in()): ?>
                    <li><a href="index.php">Dash<wbr>board</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                    <li><a href="view-students.php">View Students</a></li>
                    <li><a href="add-student.php">Add Student</a></li>
                <?php endif; ?>
                <?php if(!is_logged_in()): ?>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="login.php">Log In</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="col right">
            <h1><?=$title?></h1>
            <main>
                <!-- Content -->