<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{background-color:#1d1f21;
    background-image:url(../images/logo.png);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; }
  </style>
</head>
<body>

<?php
require('../session/session1.php');
require("../session/sqlconn.php");
include "modals2.php";
include ("mnavbar.php");
?>

<script>
$(function(){
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

<div class="col-sm-4">
<div class="panel panel-default">
      <h3>Καλώς Ήρθατε</h3>
	  <h4>Ονοματεπώνυμο: <?php echo $sesrow['name']. '  ' .$sesrow['surname']; ?></h4>
	  <h4>Ιδιότητα: Διαχειριστής</h4>
</div>
</div>

</body>
</html>
