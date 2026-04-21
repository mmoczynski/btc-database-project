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

include("./includes/validate_student_post_info.php");
include("./includes/database.php");

// Define button
define("SUBMIT_BUTTON_VALUE", "Update");

// Student ID from URL
$id = filter_input(INPUT_GET, "student_id", FILTER_VALIDATE_INT);

// Get action
$action = filter_input(INPUT_POST, "action");

if($action === SUBMIT_BUTTON_VALUE) {

    $o = validate_student_post_into();

    //var_dump($o);

    if($o['returnType'] === "success") {
        update_student($id, $o['name'], $o['email'], $o['dob'], $o['grade']);
        $_SESSION['modified_student'] = $id;
        header("Location: ./view-students.php");
    }
}

$student_r = select_student($id);

//var_dump($student_r);

// Include header for page

template_include("./includes/header.php", [
    "title" => "View Students"
]);

?>

<?php

    if($action === SUBMIT_BUTTON_VALUE && $o['returnType'] === "error") {
        foreach($o['errors'] as $x) {
            echo($x);
        }
    }

?>

<?php if(is_numeric($id) && $student_r && !empty($id)): ?>
    <?php     

        template_include("./includes/user-form.php", [
            "name" => ($student_r['name']),
            "email" => ($student_r['email']),
            "dob" => ($student_r['dob']),
            "grade" => ($student_r['grade']),
            "submit_button_value" => SUBMIT_BUTTON_VALUE
        ]);

    ?>
<?php else: ?>
    <p class="notice err">Student data not found!</p>
<?php endif; ?>

<?php include("./includes/footer.php"); ?>