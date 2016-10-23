<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get request variables
$event = $_REQUEST["r"];
$eventname = "";
// If both get and post arrays were empty then there is nothing left to do.
if ((!empty($_GET) || !empty($_POST)) && ((!empty($_GET["r"]) || !empty($_POST["r"])))) {
        $eventname = mysqli_real_escape_string($conn, $event);
        // Check that the record exists before deletion
        if (mysqli_num_rows(mysqli_query($conn, "SELECT title FROM eventlist WHERE title= '$eventname'")) == 0) {
            echo "Not in table";
        }
        else {
            $sql3 = "CALL s('$eventname')";
            if ($conn->query($sql3) !== TRUE) {
               echo "Error calling procedure: " . $sql3 . "<br>" . $conn->error;
             }
        }
}
else {
    echo "Nothing was given or data was not sent to server";
}
?>