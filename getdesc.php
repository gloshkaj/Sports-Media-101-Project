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
$name = $_REQUEST["s"];
// If both get and post arrays were empty then there is nothing left to do.
if ((!empty($_GET) || !empty($_POST)) && ((!empty($_GET["s"]) || !empty($_POST["s"])))) {
        $name = mysqli_real_escape_string($conn, $name);
        $sql3 = "SELECT description FROM eventlist WHERE title = '$name'";
        $result = mysqli_query($conn, $sql3); 
        if ($result->num_rows > 0) {
            while ($r = $result->fetch_assoc()) {
                echo $r["description"];
            }
    } else {
    echo "0 results";
    }
}
else {
    echo "Nothing was given or data was not sent to server";
}
?>