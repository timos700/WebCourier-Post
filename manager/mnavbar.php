<nav class="navbar navbar-inverse" style="background-color: #43484f;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="manager.php"><span class="glyphicon glyphicon-home"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><b>Επιλέξτε Κατάστημα </b><span class="caret"></span></a>
			<ul id = "dpoint" class="dropdown-menu" >
				<?php
				$queryusers = "SELECT name FROM crdb.point";
				$usersresult = mysqli_query($conn, $queryusers);
				while ($d=mysqli_fetch_array($usersresult)) {
					echo "<li><a href=#>".$d['name']."</a></li>";		}
				?>
				<li class="divider"></li>
				<li><a href="#" data-toggle="modal" data-target="#pointModal">Προσθήκη νέου καταστήματος</a></li>
			</ul>
      </li>
	  
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><b>Επιλέξτε Hub </b><span class="caret"></span></a>
        <ul id = "dhub" class="dropdown-menu">
			<?php
			$queryusers = "SELECT name FROM crdb.hub";
			$db = mysqli_query($conn, $queryusers);
			while ( $d=mysqli_fetch_array($db)) {
				echo "<li><a href=#>".$d['name']."</a></li>";
			}
			?>
        </ul>
      </li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="../session/logout.php"><span class="glyphicon glyphicon-log-out"></span> <b>Logout</b></a></li>
    </ul>
  </div>
</nav>