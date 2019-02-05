<?php

include "mysqli_connect.inc.php";

// SQL statement to select all students
$sql = "SELECT * FROM student";
// query the database using $sql. Note the -> syntax
$result = $db->query($sql);

// if there is no data to show let the user know
// note the -> syntax
if ($result->num_rows == 0) {
    echo "<p>There are currently no students to display.</p>";
} else {
    echo "<h2 class=\"mt-4\">Here are the students in the database table ($result->num_rows rows)</h2>";
    echo '<div class="table-responsive">';
    echo '<table class="mt-4 table table-striped table-hover">';
    echo '<thead class="thead-dark"><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr></thead>';
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
