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
// If both get and post arrays were empty then there is nothing left to do.
$sql3 = "SELECT MAX(tid) AS max FROM eventlist";
$result = mysqli_query($conn, $sql3); 
if ($result->num_rows > 0) {
    while ($r = $result->fetch_assoc()) {
        echo $r["max"];
    }
} 
else {
    echo "0 results";
}
?>