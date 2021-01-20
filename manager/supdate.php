<?php
include('../session/session1.php');
if (isset($_POST['var'])) {
	$_SESSION['work'] = $_POST['var'];
}
?>