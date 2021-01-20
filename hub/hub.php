<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{background-color:#1d1f21;}
  </style>
</head>
<body>

<?php
require('../session/session3.php');
include("hnavbar.php");
?>

<body>

<div class="col-sm-4">
<div class="panel panel-default">
      <h3>Καλώς Ήρθατε</h3>
	  <h4>Ονοματεπώνυμο: <?php echo $sesrow['name']. '  ' .$sesrow['surname']; ?></h4>
	  <h4>Ιδιότητα: Εργαζόμενος Hub</h4>
      <h4>Χώρος Εργασίας: <?php echo $sesrow['workplace'];?></h4>
</div>
<img src="../images/logo.png">
</div>

</body>
</html>