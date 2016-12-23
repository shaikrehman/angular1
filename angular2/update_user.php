<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codexworld";
$user_name = "";
$user_email = "";
$user_country = "";

$_POST = json_decode(file_get_contents('php://input'), true);

if(isset($_POST['id']) && !empty($_POST['id'])){
	$user_id = $_POST['id'];
}
if(isset($_POST['name']) && !empty($_POST['name'])){
	$user_name = $_POST['name'];
}
if(isset($_POST['email']) && !empty($_POST['email'])){
	$user_email = $_POST['email'];
}
if(isset($_POST['country']) && !empty($_POST['country'])){
	$user_country = $_POST['country'];
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "update users set name='$user_name', email='$user_email', country_code='$user_country' where id=$user_id";

if (mysqli_query($conn, $sql)) {
    echo "User updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>