<?php

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/
    
define("STU_MGMT_SYS", 1);
include("./includes/prepend.php");

$incorrect = null;
$action = filter_input(INPUT_POST, "action");

//var_dump($_POST);

$submit_value = "Login";

if($action === $submit_value) {

    //echo("Logging in");

    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");

    if(login($username, $password) === true) {
        //echo("Logged in");
        header("Location: ./index.php");
    }

    else {
        $incorrect = true;
    }
}


template_include("./includes/header.php", [
    "title" => "Login"
]); 


?>

<?php if(is_logged_in()): ?>
    <p>You are already logged in.</p>
<?php else:?>
    
    <?php if($incorrect): ?>
        <div class="notice err"><strong>Error:</strong> Incorrect username or password</div>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username:</label>
        <input name="username" id="username"></input>
        <label for="password">Password:</label>
        <input name="password" id="password" type="password"></input>
        <input type="submit" name="action" value="<?=$submit_value?>">
    </form>

<?php endif; ?>

<?php include("./includes/footer.php"); ?>