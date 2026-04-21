<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

define("STU_MGMT_SYS", 1);
include("./includes/prepend.php");

// Theme array

$themes = [
    "dark" => "Dark",
    "light" => "Light",
    "blue" => "Blue",
    "silver" => "Silver"
];

$current_theme = get_theme_setting();

// Language array

$languages = [
    "en-us" => "English US",
    "en-uk" => "English (UK)"
];

$current_lang = get_lang_setting();

template_include("./includes/header.php", [
    "title"  => "Dashboard"
]);

?>

<?php if(!empty($_SESSION['user_theme_change'])): ?>
    <div class="notice ok">
        Theme has been changed to "<?= $themes[$current_theme] ?>".
    </div>
<?php endif; ?>

<?php if(!empty($_SESSION['user_lang_change'])): ?>
    <div class="notice ok">
        Language has been changed to "<?= $languages[$current_lang] ?>".
    </div>
<?php endif; ?>

<?php if(!is_logged_in()): ?>
    <div class="notice">
        <b>Warning:</b> You are not logged in. Therefore, your actions are limited.
    </div>
<?php endif; ?>

<p>Welcome to the home page for the user management system.</p>
<p>Click on a link on the left to perform some action.</p>

<h2>Language</h2>
<p>Select a language below</p>

<form method="post" action="update_user_settings.php">

    <select name="lang">

        <?php foreach($languages as $key => $value): ?>

            <?php
            // Add "selected" attribute if option represents current language 
            $select_attr = "";
            if($key === $current_lang) $select_attr = "selected";
            
            ?>
        
            <option <?= $select_attr ?> value="<?=$key?>">
                <?=$value?>
            </option>

        <?php endforeach; ?>

    </select>
    
    <input type="submit" name="action" value="Set Language">

</form>

<h2>Theme</h2>

<form method="post" action="update_user_settings.php">

    <select name="theme">

        <?php foreach($themes as $key => $value): ?>

            <?php 
                // Add "selected" attribute if option represents current theme           
                $select_attr = "";
                if($key === $current_theme) $select_attr = "selected";
            ?>

            <option <?= $select_attr ?> value="<?=$key?>">
                <?=$value?>
            </option>

        <?php endforeach; ?>

    </select>

    <input type="submit" name="action" value="Update Theme">

</form>

<?php 

// Disable user theme change confirmation element
if( isset($_SESSION['user_theme_change']) ) unset($_SESSION['user_theme_change']);

// Disable user language change confirmation element
if( isset($_SESSION['user_lang_change']) ) unset($_SESSION['user_lang_change']); 

?>

<?php include("./includes/footer.php"); ?>