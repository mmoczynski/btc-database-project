<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

define("STU_MGMT_SYS", 1);
include("./includes/prepend.php");

// Deny access to those not logged in
if(!is_logged_in()) {
    include("./includes/access-denied.php");
    die();   
}

include("./includes/database.php");

// Get student ID from URL
$id = filter_input(INPUT_GET, "student_id", FILTER_VALIDATE_INT);

// Get action
$action = filter_input(INPUT_POST, "action");

if($action === "Yes") {
    remove_student($id);
    $_SESSION['student_deleted'] = true;
    header("Location: ./view-students.php");
    die();
}

// Get database row with id
$r = select_student($id);

// Include header and define template variables
template_include("./includes/header.php", [
    'title' => "Delete Student"
]);

if(empty($r)) {
    echo("<div class=\"notice err\"><strong>Error:</strong> Student data not found.</div>");
    include("./includes/footer.php");
    die();
}

// DateTime object for date of birth
$dateTime = new DateTime($r['dob']);

// Format birthday
$birthday_frmt_str = $dateTime->format('F, j Y');

// Get current time
$currentTime = new DateTime();

// Get difference between current time and birthday
$age_diff_obj = $currentTime->diff($dateTime);

// Get age of person
$age = $age_diff_obj->format("%y");

?>

<p>Are you sure you want to delete the student with the following information?</p>

<table>
    <tr>
        <th>Name</th>
        <td><?= htmlspecialchars($r['name']) ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= htmlspecialchars($r['email']) ?></td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td><?= $birthday_frmt_str ?></td>
    </tr>
    <tr>
        <th>Age</th>
        <td><?= $age ?></td>
    </tr>
    <tr>
        <th>Grade</th>
        <td><?= htmlspecialchars($r['grade']) ?></td>
    </tr>
</table>

<div class="buttons">
    <a class="button" href="view-students.php">No</a>
    <form method="post">
        <input type="submit" value="Yes" name="action">
    </form>
</div>

<?php include("./includes/footer.php"); ?>