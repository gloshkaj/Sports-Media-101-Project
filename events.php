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
$tid = $_REQUEST["r"];
// If both get and post arrays were empty then there is nothing left to do.
if (!empty($_GET) || !empty($_POST)) {
    if ((!empty($_GET["r"]) || !empty($_POST["r"])) && 
    (!empty($_GET["r"]) || !empty($_POST["r"]))) { // If the start and end dates were empty then report error that no date boundary was given.
             $tid = mysqli_real_escape_string($conn, $tid);
             $sql4 = "CALL q('$tid')";
             $result = mysqli_query($conn, $sql4);
             $rows = array();
             if ($result->num_rows > 0 ) {
                while ($r = $result->fetch_assoc()) {
                   $rows[] = $r;
                }
             }
            echo json_encode($rows);
    }
    else {
        echo "No id was given!";
    }
}
else {
    echo "No data was sent to server!";
}
?>