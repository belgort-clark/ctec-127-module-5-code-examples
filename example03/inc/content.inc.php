<?php 
    // connect to MySQL
    require "mysqli_connect.inc.php";

    // create SQL query using $dbc as our data source
    $result = $db->query("SELECT * FROM student");

    // How to get table column names	
    // $cols = $result->fetch_fields();
    // var_dump($cols);

    // echo select tag
    echo '<label class="col-form-label" for="student">Select a name: </label>';
    echo '<select class="form-control" name="student" id="student">';
    // let's now display the rows of data using a while loop
    // while there is data in the table let's display it
    while($row = mysqli_fetch_array($result)){
        echo "<option value=\"" . $row['student_id'] ."\">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
    } // end while
    // echo closing select tag
    echo "</select>";
    
    // close the database connection
    $db->close();
?>