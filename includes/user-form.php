<?php 

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die(); 

?>
<form method="post">

    <label for="name">Name:</label>
    <input id="name" name="name" type="text" value="<?= ($name ?? "") ?>">

    <label for="email">Email:</label>
    <input id="email" name="email" type="email" value="<?= ($email ?? "") ?>">

    <label for="dob">Name:</label>
    <input id="dob" name="dob" type="date" value="<?= ($dob ?? "") ?>">

    <label for="grade">Grade:</label>
    <input id="grade" name="grade" value="<?= ($grade ?? "") ?>">

    <input type="submit" name="action" value="<?= ($submit_button_value ?? "Submit") ?>">

</form>