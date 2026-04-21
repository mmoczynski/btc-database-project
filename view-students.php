<?php 

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

define("STU_MGMT_SYS", 1);
include("./includes/prepend.php");

// Deny access to people not logged in

if(!is_logged_in()) {
    include("./includes/access-denied.php");
    die();   
}

include("./includes/database.php");

$arr = select_student_table();

template_include("./includes/header.php", [
    "title" => "View Students"
]);
   
?>

<?php if(isset($_SESSION['modified_student'])): ?>
    <div class="notice ok">
        <strong>Success:</strong> Student has been updated.
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['student_deleted'])): ?>
    <div class="notice ok">
        <strong>Success:</strong> Student has been deleted.
    </div>
<?php endif; ?>

<?php if(empty($arr)):?>
    <p>There seems to be no student records. Try adding one.</p>
<?php else: ?>
    <div class="table-container">
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Grade</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php foreach($arr as $r): ?>
                <?php 

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

                    // Modfied student class variable

                    $modified_student_class = "";

                    if(isset($_SESSION['modified_student']) && $_SESSION['modified_student'] === $r['id']) {
                        $modified_student_class = "modified-student";
                    }

                ?>
                <tr id="student-<?=$r['id']?>" class="<?= $modified_student_class ?>">
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= htmlspecialchars($r['email']) ?></td>
                    <td><?= htmlspecialchars($birthday_frmt_str) ?></td>
                    <td><?= htmlspecialchars($age) ?></td>
                    <td><?= htmlspecialchars($r['grade']) ?></td>
                    <td>
                        <form method="get" action="edit-student.php">
                            <input name="student_id" value="<?=$r['id']?>" type="hidden">
                            <input type="submit" value="Edit"> 
                        </form>
                    </td>
                    <td>
                        <form method="get" action="delete-student.php">
                            <input name="student_id" value="<?=$r['id']?>" type="hidden">
                            <input type="submit" value="Delete"> 
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>


<?php

// Unset modified student indicator
if( isset($_SESSION['modified_student']) ) unset($_SESSION['modified_student']);
if( isset($_SESSION['student_deleted'])) unset($_SESSION['student_deleted']);

// Include footer
include("./includes/footer.php"); ?>