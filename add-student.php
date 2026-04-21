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

define("SUBMIT_BUTTON_VALUE", "Add Student");

// Get action
$action = filter_input(INPUT_POST, "action");

if($action === SUBMIT_BUTTON_VALUE) {

    $o = validate_student_post_into();

    //var_dump($o);

    if($o['returnType'] === "success") {
        $id = add_student($o['name'], $o['email'], $o['dob'], $o['grade']);
        $_SESSION['modified_student'] = $id;
        header("Location: ./view-students.php");
    }

}
    
?>

<?php 

template_include("./includes/header.php", [
    "title" => "Add Student"
]); 

?>

<?php if( isset($o) && isset($o['errors']) ): ?>
    <?php foreach($o['errors'] as $r): ?>
        <?=$r?>
    <?php endforeach; ?>
<?php endif; ?>

<?php

template_include("./includes/user-form.php", [
    "submit_button_value" => SUBMIT_BUTTON_VALUE
]);

include("./includes/footer.php"); 

?>