<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

if(!defined("STU_MGMT_SYS")) die();

template_include(__DIR__ . "/header.php", [
    'title' => 'Database Error'
]); 

?>

<div class="notice err">
    There has been a database error.<br> 
    Please contact system administrator.<br><br>
    
    Details for system administrator: <br><br>
    <div>
        Error:  <?=$err->getMessage()?><br><br>
        File: <?=$err->getFile()?><br><br>
        Line: <?=$err->getLine()?><br><br>
        Timestamp: 
        <?php 
        
            $dt = new DateTime();
            echo($dt->format("c"));
        
        ?>
    </div>

</div>

<?php include(__DIR__ . "/footer.php"); ?>