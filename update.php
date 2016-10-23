<?php
$servername = "127.0.0.1";
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
$tid = $_REQUEST["p"];
$descp = $_REQUEST["q"];
$event = $_REQUEST["r"];
$startdate = $_REQUEST["s"];
$enddate = $_REQUEST["t"];
// If both get and post arrays were empty then there is nothing left to do.
if (!empty($_GET) || !empty($_POST)) {
    if ((!empty($_GET["s"]) || !empty($_POST["s"])) && 
    (!empty($_GET["t"]) || !empty($_POST["t"]))) { // If the start and end dates were empty then report error that no date boundary was given.
            $date1=date_create($startdate);
            $date2=date_create($enddate);
            $date1 = $date1->format("Y-m-d");
            $date2 = $date2->format("Y-m-d");
            $date1 = mysqli_real_escape_string($conn, $date1);
            $date2 = mysqli_real_escape_string($conn, $date2);
            $descript = mysqli_real_escape_string($conn, $descp);
            $eventname = mysqli_real_escape_string($conn, $event);
            $tid = mysqli_real_escape_string($conn, $tid);
            // Check that record exists before updating.
            if (mysqli_num_rows(mysqli_query($conn, "SELECT title FROM eventlist WHERE title= '$eventname'")) == 0) {
                echo "Not in table";
                }
            else {
               $sql3 = "CALL r('$eventname', '$descript', '$date1', '$date2', '$tid')";
               if ($conn->query($sql3) !== TRUE) {
                   echo "Error calling procedure: " . $sql3 . "<br>" . $conn->error;
                   }
            }
    }
    else {
        echo "No start or end date were given!";
    }
}
else {
    echo "No data was sent to server!";
}
?>