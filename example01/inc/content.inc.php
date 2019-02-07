<?php

include "mysqli_connect.inc.php";

// SQL statement to select all students
// $sql = "SELECT * FROM student WHERE first_name LIKE 'z%' ORDER BY first_name";

$orderby = 'last_name';
$filter = '';

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby'];
}

$sql = "SELECT * FROM student WHERE last_name LIKE '$filter%' ORDER BY $orderby";
// query the database using $sql. Note the -> syntax
$result = $db->query($sql);
// echo '<pre>';
// var_dump($result);
// echo '</pre>';

// if there is no data to show let the user know
// note the -> syntax
if ($result->num_rows == 0) {
    echo "<p>There are currently no students to display.</p>";
} else {
    echo "<h2 class=\"mt-4\">Here are the students in the database table ($result->num_rows rows)</h2>";

    # create a select dropdown
    $letters = range('A','Z');

    for ($i=0; $i < count($letters) ; $i++) { 
        if ($filter == $letters[$i]) {
            $class = 'class="selectedlink"';
        } else {
            $class = '';
        }

        echo "<a $class href='?filter=$letters[$i]'>$letters[$i]</a>&nbsp;&nbsp;";
    }


    // echo '<select name="filter">';
    //     for ($i=0; $i < count($letters) ; $i++) { 
    //         echo "<option value='$letters[$i]'>$letters[$i]</option>";
    //     }
    // echo '</select>';
    // echo '<input type="submit" value="Filter">';

    echo '<div class="table-responsive">';
    echo '<table class="mt-4 table table-striped table-hover">';
    echo '<thead class="thead-dark"><tr><th><a href="?sortby=student_id">Student ID</a></th><th><a href="?sortby=first_name">First Name</a></th><th><a href="?sortby=last_name">Last Name</a></th><th><a href="?sortby=email">Email</a></th><th><a href="?sortby=phone">Phone</a></th></tr></thead>';
    # $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()) {
        # display rows and columns of data
        echo '<tr>';
        echo "<td>{$row['student_id']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo '</tr>';
    } // end while
    // closing table tag
    echo '</table>';
    echo '</div>';
} // end if

# close the database
$db->close();
