<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codexworld";
$user_id = "";

if(isset($_POST['id']) && !empty($_POST['id'])){
	$user_id = $_POST['id'];
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM users WHERE id=$user_id";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>