<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>body{background-color:#1d1f21;}</style>
</head>
<body>

<?php
require('../session/session1.php');
require("../session/sqlconn.php");
include "modals2.php";
include ("mnavbar.php");
if (isset($_SESSION['work'])) {
	$point = $_SESSION['work'];
}
else{
	$point = NULL;
	echo '<meta http-equiv="refresh" content="0; url=manager.php">';
}
?>

<script>
$('document').ready(function() {
$('.td_btn').click(function() {
	$row = $(this).closest('tr');
	$('#pname').val($('.tname', $row).text());
	$('#psurname').val($('.tsname', $row).text());
	$('#pusername').val($('.tuname', $row).text());
	$('#ppassword').val($('.tpass', $row).text());
	$('#pworkplace').val($('.twork', $row).text());
    $('#pworkModal2').modal('show');
})
$('.openm').click(function() {
	 var workId = $(this).data('id');
     $('#pworkid').val(workId);
})
$("body").on('click', '#dhub li a', function () {
	var s = $(this).text();
	$.post("supdate.php", {var: s}, function(){
	window.location.href = "hub.php";
	});
})
$("body").on('click', '#dpoint li a', function () {
	var s = $(this).text();
	if (!(s == "Προσθήκη νέου καταστήματος")){
		$.post("supdate.php", {var: s}, function(){
			window.location.href = "point.php";
		});
	}
})
});

function checkDelete(){
    return confirm('Είστε σίγουρος πως θέλετε να διαγράψετε το κατάστημα?\nΌλες οι αποστολές από και πρός το κατάστημα θα ακυρωθούν!');
}
</script>

<div class="panel panel-default">
  <?php
		$query = "SELECT * FROM crdb.point where name = '$point'";
		$result1 = mysqli_query($conn, $query);//point info
		$query = "SELECT * FROM crdb.pointemployees where workplace = '$point'";
		$result2 = mysqli_query($conn, $query);//workers info
  ?>
  <div class="panel-heading">
	<h2>Κατάστημα: <?php echo $point ?></h2>
  </div>
  <div class="panel-body" style="max-height: 10;" >
  <div class="col-md-6">
	<form method="post" action="<?php $_PHP_SELF ?>">
	<table id="sss" class="table bg-success table-bordered table-hover">
	<caption><h3>Πληροφορίες Καταστήματος</h3></caption>
    <tbody>
	
	<?php while ($row = mysqli_fetch_array($result1)) { ?>
           <tr>
			   <td>Όνομα</td>
               <td> <input type="text" name="name" value="<?php echo $row[0] ?>"readonly></td></tr>
			   <td>Οδός</td>
               <td> <input type="text" name="street" pattern="[Α-Ωα-ω0-9ίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ ]{1,20}" title="Επιτρέπονται έως 20: κενά, ψηφία ελληνικά γράμματα κεφαλαία ή πεζά." placeholder="Εισάγετε οδό" required value="<?php echo $row[1] ?>"></td></tr>
			   <td>Αριθμός</td>
               <td> <input type="text" name="strno" pattern="[0-9]{1,3}" title="Επιτρέπονται: 1-3 ψηφία." placeholder="Εισάγετε αριθμό" required value="<?php echo $row[2] ?>"></td></tr>
			   <td>Πόλη</td>
			   <td> <input type="text" name="city" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." placeholder="Εισάγετε πόλη" required value="<?php echo $row[3] ?>"></td></tr>
			   <td>ΤΚ</td>
			   <td> <input type="text" name="pc" pattern="[0-9]{5}" title="Επιτρέπονται: 5 ψηφία." placeholder="Εισάγετε ΤΚ" required value="<?php echo $row[4] ?>"></td></tr>
			   <td>Τηλέφωνο</td>
			   <td> <input type="text" name="phone" pattern="[0-9]{10}" title="Επιτρέπονται: 10 ψηφία." placeholder="Εισάγετε τηλέφωνο" required value="<?php echo $row[5] ?>"></td></tr>
			   <td>Γεωγρ. Πλάτος</td>
			   <td> <input type="text" name="lat" pattern="\d{2}.\d{6}" title="Επιτρεπόμενη μορφή: xx.xxxxxx" placeholder="Εισάγετε γεωγρ. πλάτος" required value="<?php echo $row[6] ?>"></td></tr>
			   <td>Γεωγρ. Μήκος</td>
			   <td> <input type="text" name="lon" pattern="\d{2}.\d{6}" title="Επιτρεπόμενη μορφή: xx.xxxxxx" placeholder="Εισάγετε γεωγρ. μήκος" required value="<?php echo $row[7] ?>"></td></tr>
			   <td>Hub Εξυπηρέτησης</td>
			   <td>
			   <select class="form-control" id="hub" name="hub">
					<?php
						$queryusers = "SELECT name FROM crdb.hub";
						$db = mysqli_query($conn, $queryusers);
						while ( $d=mysqli_fetch_array($db)) {
							echo "<option".($d['name'] == $row[8] ? ' selected="selected"' : '')."><li><a>".$d['name']."</a></li></option>";
						}
					?>
			   </select>
		   </tr>
	<?php } ?>
  </tbody> 
  </table>
  <input type="submit" name = "submit" value="Αποθήκευση αλλαγών">
  <input type="submit" name = "delete" value="Διαγραφή Καταστήματος" onclick="return checkDelete()">
  </form>
  <?php

	if(isset($_POST['submit']))
	{

		$name = trim($_POST['name']);
		$street = $_POST['street'];
		$strno = $_POST['strno'];
		$city = $_POST['city'];
		$pc = $_POST['pc'];
		$phone = $_POST['phone'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		$hub = $_POST['hub'];

		$sql = "UPDATE crdb.point SET street = '$street', strno = $strno, city = '$city', pc = $pc,  phone = $phone, lat = $lat, lon = $lon, hub = '$hub'  WHERE name = '$name'";
		$sql = mysqli_query($conn,$sql);
	
		if(! $sql )
		{
		die('<div class="alert alert-danger">Data Failed to Update</div><meta http-equiv="refresh" content="1">');
		}
		echo '<div class="alert alert-success">Data Updated</div><meta http-equiv="refresh" content="1">';
		
	}elseif(isset($_POST['delete']))
	{
		$name = trim($_POST['name']);
		$sql1 = "DELETE FROM crdb.pointemployees WHERE workplace='$name'";
		$sql1 = mysqli_query($conn,$sql1);
		$sql2 = "DELETE FROM crdb.point WHERE name='$name'";
		$sql2 = mysqli_query($conn,$sql2);
	
		if(!($sql1 && $sql2))
		{
		die('<div class="alert alert-danger">Data Failed to Update</div><meta http-equiv="refresh" content="1; url=manager.php">');
		}
		echo '<div class="alert alert-success">Point Deleted</div><meta http-equiv="refresh" content="1; url=manager.php">';
	}
?>
  </div>
  <div class="col-md-6">
	<table class="table bg-success table-bordered table-hover">
	<caption><h3>Εργαζόμενοι Καταστήματος</h3><h5>Για τροποποίηση εργαζομένων πατήστε στην αντίστοιχη εγγραφή</h5></caption>
	<thead>
      <tr>
        <th>Όνομα</th>
        <th>Επώνυμο</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>
	<?php while ($row = mysqli_fetch_array($result2)) { ?>
	<tr class = "td_btn">
               <td class = "tname"><?php echo $row[0] ?></td>
               <td class = "tsname"><?php echo $row[1] ?></td>
               <td class = "tuname"><?php echo $row[2] ?></td>
			   <td class = "tpass" style="display:none"><?php echo $row[3] ?></td>
			   <td class = "twork" style="display:none"><?php echo $row[4] ?></td>
           </tr>
	<?php } ?>
    </tbody>
  </table>
  <button type="button" class = "openm" data-toggle="modal" data-target="#pworkModal" data-id="<?= $point ?>">Προσθήκη Υπαλλήλου</button>
  </div>
  </div>
</div>
</body>
</html>