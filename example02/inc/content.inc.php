<?php 
require "mysqli_connect.inc.php";

$errors = false;
$errors_text = [];

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($errors_text,"<p>A first name is required.</p>");
        $errors = true;
    } else {
        # Old way
        #$first = $_POST['first'];
        # New way
        $first = $db->real_escape_string($_POST['first']);
    }
    if (empty($_POST['last'])) {
        array_push($errors_text,"<p>A last name is required.</p>");
        $errors = true;
    } else {
        #$last = $_POST['last'];
        $last = $db->real_escape_string($_POST['last']);
    }
    if (empty($_POST['id'])) {
        array_push($errors_text,"<p>A student ID is required.</p>");
        $errors = true;
    } else {
        #$id = $_POST['id'];
        $id = $db->real_escape_string($_POST['id']);
    }
    if (empty($_POST['email'])) {
        array_push($errors_text,"<p>An email address is required.</p>");
        $errors = true;
    } else {
        #$email = $_POST['email'];
        $email = $db->real_escape_string($_POST['email']);
    }
    if (empty($_POST['phone'])) {
        array_push($errors_text,"<p>A phone number is required.</p>");
        $errors = true;
    } else {
        #$phone = $_POST['phone'];
        $phone = $db->real_escape_string($_POST['phone']);
    }

    // If we have no errors than we can try and insert the data
    if (!$errors) {
        // Time for some SQL
        $sql = "INSERT INTO student (first_name,last_name,student_id,email,phone) ";
        $sql .= "VALUES ('$first','$last',$id,'$email','$phone')";
        //echo $sql;
        $result = $db->query($sql);
        if (!$result) {
            echo "<p>I'm sorry, but I could not save that record for you.</p>";
        } else {
            echo "<p>Success! I stored that data for you!</p>";
            unset($first);
            unset($last);
            unset($id);
            unset($email);
            unset($phone);
        }
    } else {
        // display the errors
        echo '<p>The following errors were deteced:</p>';
        echo '<div class="errors">';
        foreach ($errors_text as $text) {
            echo $text;
        }
        echo '</div>';
    }
} // end if

?>
