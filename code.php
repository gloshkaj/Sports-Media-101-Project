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
$tid = $_REQUEST["p"];
$descp = $_REQUEST["n"];
$event = $_REQUEST["q"];
// If both get and post arrays were empty then there is nothing left to do.
if (!empty($_GET) || !empty($_POST)) {
    if ((!empty($_GET["s"]) || !empty($_POST["s"])) && 
    (!empty($_GET["t"]) || !empty($_POST["t"]))) { // If the start and end dates were empty then report error that no date boundary was given.
            $file1 = str_replace("/", "-", $descp);
            preg_match("/.*([0-9]{4}-[0-9]{2}-[0-9]{2}).*/", $file1, $matches);
            $date1=date_create($matches[1]);
            $date2=date_create($matches[1]);
            $date1 = $date1->format("Y-m-d");
            $date2 = $date2->format("Y-m-d");
            $date1 = mysqli_real_escape_string($conn, $date1);
            $date2 = mysqli_real_escape_string($conn, $date2);
            $descript = mysqli_real_escape_string($conn, $descp);
            $eventname = mysqli_real_escape_string($conn, $event);
            $tid = mysqli_real_escape_string($conn, $tid);
            $sql3 = "CALL p('$eventname', '$descript', '$date1', '$date2', '$tid')";
            if ($conn->query($sql3) !== TRUE) {
               echo "Error calling procedure: " . $sql3 . "<br>" . $conn->error;
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