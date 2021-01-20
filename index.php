<!DOCTYPE html>
<html lang="el">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	html {
		position: relative;
		min-height: 100%;
		height: 100%;
		}
	body{
		margin: 0px;
		position: relative;
		min-height: 100%;
		height: auto;
		background-color:#1d1f21;
		padding-bottom: 170px;
		}
</style>
</head>
<body>

<script>
function mmodal(p1) {
	$.post("track.php", {sid: p1}, function(response,status){
		$("#ccc").html(response);
	});
};
</script>

<?php

include('session/login.php');
include("navbar.php");
?>


<div id = "ccc">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
	
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
		<img src="images/sm01.png" style="width: 100%;">
	    <script>
		if ($(window).width() > 800) {
		$("img[src$='images/sm01.png']").each(function() {
			var new_src = $(this).attr("src").replace('images/sm01.png', 'images/lg01.png'); 
			$(this).attr("src", new_src); 
		});
		}
		</script>
      </div>

      <div class="item">
		<img src="images/sm02.png" style="width: 100%;">
	    <script>
		if ($(window).width() > 800) {
		$("img[src$='images/sm02.png']").each(function() {
			var new_src = $(this).attr("src").replace('images/sm02.png', 'images/lg02.png'); 
			$(this).attr("src", new_src); 
		});
		}
		</script>
      </div>
    
      <div class="item">
		<img src="images/sm03.png" style="width: 100%;">
	    <script>
		if ($(window).width() > 800) {
		$("img[src$='images/sm03.png']").each(function() {
			var new_src = $(this).attr("src").replace('images/sm03.png', 'images/lg03.png'); 
			$(this).attr("src", new_src); 
		});
		}
		</script>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<footer class="footer" style="position: absolute; bottom: 0; width:100%; height:160px; background-color:black;">
  <div class="container">
    <p><img src="images/logo.png" style="float:left; width:180px; height:160px;">
	<font color="white"><h4><b>Fast Parcel Service</b></h4></br>Έδρα: Πάτρα</br>Κορίνθου 227</br>ΤΚ: 26221</br>Τηλέφωνο: 2610123456</p></font>
  </div>
</footer>

</body>
</html>
