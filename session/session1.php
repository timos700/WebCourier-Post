<?php

include ("sqlconn.php");

session_start();// Starting Session
// Storing Session
$usertype=$_SESSION['type'];
$user=$_SESSION['username'];
// SQL Query To Fetch Complete Information Of User
if ($usertype == "manager"){
	$ses_sql=mysqli_query($conn, "select * from crdb.manager where username='$user'");
	$sesrow = mysqli_fetch_assoc($ses_sql);
}else if ($usertype == "point"){
	mysqli_close($conn);
	header('Location: ../points/point.php');
}else if ($usertype == "hub"){
	mysqli_close($conn);
	header('Location: ../hub/hub.php');
}else{
	mysqli_close($conn); // Closing Connection
	header('Location: ../index.php'); // Redirecting To Home Page
}
?>