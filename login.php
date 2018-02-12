<?php
session_start();

// initialise variables
$host = 'localhost';
$user = 'root';
$pWord = '';
$database = 'deadlinetracker';
$errors = array(); 

// Create connection
$db = mysqli($host, $user, $pWord, $database);
// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} 

$username = '';
$password = '';

// register user
if (isset($_POST['register'])) {	
  //register button clicked
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required");  }
  
  // checks username is registered
  $user_check_query = "SELECT Usermame FROM user WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
 if ($user) { // if user exists
    if ($user['username'] === $username) {
      $user_check_query = "SELECT Password FROM user WHERE Username='$username' LIMIT 1";
	  $result = mysqli_query($db, $user_check_query);
	  $user = mysqli_fetch_assoc($result);
	  if ($user == md5(password)) {
	    //login statement
		
if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
