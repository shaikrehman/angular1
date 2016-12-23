<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codexworld";
$user_name = "";
$user_email = "";
$user_country = "";

$_POST = json_decode(file_get_contents('php://input'), true);

print_r($_POST);
exit();
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

$sql = "INSERT INTO users (name, email, country_code)
VALUES ('$user_name', '$user_email', $user_country)";

if (mysqli_query($conn, $sql)) {
    echo "New user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>