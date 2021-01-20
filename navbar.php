<nav class="navbar navbar-inverse" style="background-color: #43484f;">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="index.php" class="navbar-brand" ><span class="glyphicon glyphicon-home"><b>F.P.S.</b></a>
    </div>
	<div id = "navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Αναζήτηση Αποστολής</b></a>
		  <ul id="track-dp" class="dropdown-menu">
				<li>
					 <div class = "col-md-12">
								 <form class="form" role="form" method="post" action="<?php $_PHP_SELF ?>">
										<div class="form-group">
											 <label class="sr-only" >Track ID:</label>
											 <input name="trid" id="trid" type="text" class="form-control" placeholder="Track ID" required>
										</div>
										<div class="form-group">
											 <input type="submit" name="strack" id = "strack" class="btn btn-primary btn-block" value="Αναζήτηση">
										</div>
								 </form>
								 <?php
								 if(isset($_POST['strack']))
								 {
									 $trid = $_POST['trid'];
									 include ("session/sqlconn.php");
									 $query = "SELECT * FROM crdb.pack where packid = '$trid'";
									 $result = mysqli_query($conn, $query);
									 if (mysqli_num_rows($result) == 1){
									 echo  '<script> mmodal('. json_encode($trid) .') </script>';
									 }
									 else{
										echo '<script> alert("Το tracking number που βάλατε δεν υπάρχει στο σύστημα.\nΠαρακαλώ προσπαθήστε ξάνα."); </script>';
									 }
								 }
								 ?>
					 </div>
				</li>
			</ul>
		</li>
		<li><a href="maplocator.php"><b>Εύρεση Πλησιέστερου Καταστήματος</b></a></li>
		<li><a href="map.php"><b>Δίκτυο Καταστημάτων</b></a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
	  <b class="navbar-text">Σύνδεση Υπαλλήλων:</b>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span><b>  Login  </b></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class = "col-md-12">
								 <form class="form" role="form" method="post" action="" accept-charset="UTF-8">
										<div class="form-group">
											 <label class="sr-only" >Username</label>
											 <input name="username" type="text" class="form-control" id="name" placeholder="Username" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" >Password</label>
											 <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
										</div>
										<div class="form-group">
											 <input type="submit" name="login" class="btn btn-primary btn-block" value=" Login ">
										</div>
										<span><?php if ($error != '') echo "<script> alert('$error') </script>" ?></span>
								 </form>
					 </div>
				</li>
			</ul>
        </li>
    </ul>
  </div>
  </div>
</nav>