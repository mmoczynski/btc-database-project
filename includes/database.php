<?php

if(!defined("STU_MGMT_SYS")) die();

/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

function create_database_connection() {
    try {
        return new PDO("mysql:host=localhost;dbname=student_management", "root", "sesame");
    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }   
}

/*** Execute query selecting all students and return the results ***/

function select_student_table() {

    try {
        
        // Create database connection
        $db = create_database_connection();
        
        // Prepare statement
        $stmt = $db->prepare("SELECT * FROM students");

        // Execute
        $stmt->execute();

        // Fetch all results and store in variable to return
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Close cursor
        $stmt->closeCursor();

        // Return results
        return $arr;

    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }
    
}

function add_student($name, $email, $dob, $grade) {

    try {

        $db = create_database_connection();

        $stmt = $db->prepare(
            "INSERT INTO students (name, email, dob, grade) 
            VALUES (:name, :email, :dob, :grade)"
        );
    
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":dob", $dob);
        $stmt->bindValue(":grade", $grade);
    
        $stmt->execute();
    
        /*
        * Get ID of student.
        * The lastInsertID method returns a string in MySQL and MariaDB, which means the string should be converted into an integer
        */
    
        $id = intval($db->lastInsertID());
    
        $stmt->closeCursor();
    
        return $id;

    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }

}

function update_student($id, $new_name, $new_email, $new_dob, $new_grade) {

    try {

        // Create database connection
        $db = create_database_connection();

        // Prepare statement

        $stmt = $db->prepare(
            "UPDATE students 
            SET name = :name,
            email = :email,
            dob = :dob, 
            grade = :grade
            WHERE id = :id"
        );

        // Bind new data
        $stmt->bindValue(":name", $new_name);
        $stmt->bindValue(":email", $new_email);
        $stmt->bindValue(":dob", $new_dob);
        $stmt->bindValue(":grade", $new_grade);
        
        // Bind ID
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            
        // Execute
        $stmt->execute();
            
        // Close cursor
        $stmt->closeCursor();

    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }

}

function remove_student($id) {

    try {

        // Create database connection
        $db = create_database_connection();


        // Prepare statement
        $stmt = $db->prepare(
            "DELETE FROM students
            WHERE id = :id"
        );

        // Bind data
        $stmt->bindValue(":id", $id);

        // Execute
        $stmt->execute();

        // Close cursor
        $stmt->closeCursor();

    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }

}

function select_student($id) {

    try {

        // Create database connection
        $db = create_database_connection();
        
        // Prepare statement
        $stmt = $db->prepare("SELECT * FROM students WHERE id = :id");

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        // Execute
        $stmt->execute();
        
        // Fetch all results and store in variable to return
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Close cursor
        $stmt->closeCursor();
        
        // Return results
        return $r;

    } catch (\Throwable $th) {
        template_include("./includes/database-error.php", [ 'err' => $th] );
        die();
    }
}

?>