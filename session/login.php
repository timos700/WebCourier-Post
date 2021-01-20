<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['login'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{

include ("sqlconn.php");

$username=$_POST['username'];
$password=$_POST['password'];

// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($conn, "select * from crdb.employees where BINARY password='$password' AND BINARY username='$username'");
$rows = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);

if ($rows == 1) {
	if ($row['type'] == "manager"){
		$_SESSION['type']=$row['type'];
		$_SESSION['username']=$username;
		header("location: manager/manager.php");
	}else if ($row['type'] == "point"){
		$_SESSION['type']=$row['type'];
		$_SESSION['username']=$username;
		header("location: points/point.php");
	}else if ($row['type'] == "hub"){
		$_SESSION['type']=$row['type'];
		$_SESSION['username']=$username;
		header("location: hub/hub.php");
	}else{
		$error = "Username or Password is invalid";
	}
} else {
	$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>