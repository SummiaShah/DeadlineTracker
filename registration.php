<?php
session_start();

// initialise variables
$host = 'localhost';
$user = 'root';
$pWord = '';
$database = 'deadlinetracker';
$errors = array();

// Create connection
$db = mysqli_connect($host, $user, $pWord, $database);

$username = '';
$password = '';
$email = '';

// register user
if (isset($_POST['register'])) {
  //register button clicked
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required");  }

  // checks username and email are unique
  $user_check_query = "SELECT * FROM users WHERE username=$username OR email=$email LIMIT 1";
  $result = mysqli_query($db, $user_check_query);

  if ($result) { // if user exists
    $user = mysqli_fetch_assoc($result);
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

  	if ($user['email'] === $email) { // if email exists
        array_push($errors, "email already exists");
      }
  }

  if (count($errors) == 0) {
	  $password = md5($password);
	  $sql = "INSERT INTO User (Username, Password, Email)
	  VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($db, $sql);
    header("location: ../dashboard.html");
  }

}

?>
