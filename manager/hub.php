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
	$('#hname').val($('.tname', $row).text());
	$('#hsurname').val($('.tsname', $row).text());
	$('#husername').val($('.tuname', $row).text());
	$('#hpassword').val($('.tpass', $row).text());
	$('#hworkplace').val($('.twork', $row).text());
    $('#hworkModal2').modal('show');
})
$('.openm').click(function() {
	 var workId = $(this).data('id');
     $('#hworkid').val(workId);
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
</script>


<div class="panel panel-default">
  <?php
		$query = "SELECT * FROM crdb.hubemployees where workplace = '$point'";
		$result2 = mysqli_query($conn, $query);//workers info
  ?>
  <div class="panel-heading">
	<h3>Hub: <?php echo $point ?></h3>
  </div>
  <div class="panel-body" style="max-height: 10;" >
  <div class="col-md-6">
	<table class="table bg-success table-bordered table-hover">
	<caption><h3>Εργαζόμενοι Hub</h3><h5>Για τροποποίηση εργαζομένων πατήστε στην αντίστοιχη εγγραφή</h5></caption>
	<thead>
      <tr>
        <th>Όνομα</th>
        <th>Επώνυμο</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>
	<?php while ($row = mysqli_fetch_array($result2)) { ?>
	<tr class="td_btn">
               <td class = "tname"><?php echo $row[0] ?></td>
               <td class = "tsname"><?php echo $row[1] ?></td>
               <td class = "tuname"><?php echo $row[2] ?></td>
			   <td class = "tpass" style="display:none"><?php echo $row[3] ?></td>
			   <td class = "twork" style="display:none"><?php echo $row[4] ?></td>
           </tr>
	<?php } ?>
    </tbody>
  </table>
  <button type="button" class = "openm" data-toggle="modal" data-target="#hworkModal" data-id="<?= $point ?>">Προσθήκη Υπαλλήλου</button>
  </div>
  </div>
</div>

</body>
</html>