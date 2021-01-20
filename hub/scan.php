<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Σελίδα υπαλλήλων Hub</title>

<style type="text/css">
body{background-color:#1d1f21;}
#mainbody{
    background: white;
    width:100%;
	display:none;
}

#v{
    width:320px;
    height:240px;
}

#result{
    border: solid;
	border-width: 1px 1px 1px 1px;
	padding:20px;
}
</style>
<script type="text/javascript" src="llqrcode.js"></script>
<script type="text/javascript" src="qr.js"></script>
</head>

<?php
require('../session/session3.php');
require("../session/sqlconn.php");
include("hnavbar.php");

?>

<body>
	<form action="<?php $_PHP_SELF ?>" method="post">
		<div class="container" style="background: #D8E6F0; padding: 15px; border: 1px solid #333; border-radius: 5px;">
		<div id="mainbody">
		<table align="center">
		<tr>
		<td align="center" style="width: 335px"><div id="outdiv"></div></td>
		</tr>
		<tr>
		<td align="center"><div style="margin-top: 15px;" type="text" id="result" name="result"></div></td>
		</tr>
		<tr>
			<td>
				<label>
					<input type="hidden" value="" name="qrtxt" id="trackingupdate">
				</label>
			</td>
		</tr>
		<tr>
		<td align="center"><input style="margin-top: 15px;" type="submit" value="Ενημέρωση της βάσης" name="load"></td>
		</tr>
		</table>
		</div>
		</div>
		<canvas id="qr-canvas" width="800" height="600" style = "display:none"></canvas>
		<script type="text/javascript">load();</script>
	</form>
	<?php
		if(isset($_POST['qrtxt'])){
			$tn = $_POST['qrtxt'];
			$work = $sesrow['workplace'];
			//echo $tn;
			$tn = strip_tags($tn);
			$sql = "INSERT INTO crdb.track (id, location) VALUES ('$tn', '$work')";
			$sql = mysqli_query($conn,$sql);
			if(! $sql )
			{
			die('<div style="max-width: 300px; text-align: center; margin: auto; background: #87CEFA; padding: 15px; border: 1px solid #333; border-radius: 5px; height: 60px; ">Σφάλμα κατα την ενημέρωση της βάσης!</div>' . mysql_error());
			}
			$sql = "SELECT hub FROM crdb.point INNER JOIN crdb.pack ON pack.tarpoint = point.name WHERE pack.packid = '$tn'";
			$sql = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($sql);
			if ($row[0] == $work){
				$sql = "UPDATE crdb.pack SET status = 'Προς Παράδοση' WHERE packid = '$tn'";
				$sql = mysqli_query($conn,$sql);
			}
			echo '<div style="max-width: 300px; text-align: center; margin: auto; background: #87CEFA; padding: 15px; border: 1px solid #333; border-radius: 5px; height: 60px; ">Η βάση ενημερώθηκε επιτυχώς!</div>';
		}
	?>
</body>

</html>