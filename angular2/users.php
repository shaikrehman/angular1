<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codexworld";
$data = array();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT u.id, u.name, u.email, u.country_code, c.country_name from users as u inner join country as c where u.country_code = c.id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}

mysqli_close($conn);
?>