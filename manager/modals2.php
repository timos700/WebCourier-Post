<div id="pointModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Προσθήκη νέου καταστήματος</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php $_PHP_SELF ?>" class="form-horizontal" id="form">
		<table class="table bg-success table-bordered table-hover">
		<caption>Πληροφορίες Καταστήματος</caption>
		<tbody>
			   <tr>
				   <td>Όνομα</td>
				   <td> <input type="text" name="name" pattern="[A-Za-z0-9 ]{1,20}" title="Επιτρέπονται έως 20: κενά, ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." placeholder="Εισάγετε όνομα" required></td></tr>
				   <td>Οδός</td>
				   <td> <input type="text" name="street" pattern="[Α-Ωα-ω0-9ίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ ]{1,20}" title="Επιτρέπονται έως 20: κενά, ψηφία και ελληνικά γράμματα κεφαλαία ή πεζά." placeholder="Εισάγετε οδό" required></td></tr>
				   <td>Αριθμός</td>
				   <td> <input type="text" name="strno" pattern="[0-9]{1,3}" title="Επιτρέπονται: 1-3 ψηφία." placeholder="Εισάγετε αριθμό" required></td></tr>
				   <td>Πόλη</td>
				   <td> <input type="text" name="city" patter="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." placeholder="Εισάγετε πόλη" required></td></tr>
				   <td>ΤΚ</td>
				   <td> <input type="text" name="pc" pattern="[0-9]{5}" title="Επιτρέπονται: 5 ψηφία." placeholder="Εισάγετε ΤΚ" required></td></tr>
				   <td>Τηλέφωνο</td>
				   <td> <input type="text" name="phone" pattern="[0-9]{10}" title="Επιτρέπονται: 10 ψηφία." placeholder="Εισάγετε τηλέφωνο" required></td></tr>
				   <td>Γεωγρ. Πλάτος</td>
				   <td> <input type="text" name="lat" pattern="\d{2}.\d{6}" title="Επιτρεπόμενη μορφή: xx.xxxxxx" placeholder="Εισάγετε γεωγρ. πλάτος" required></td></tr>
				   <td>Γεωγρ. Μήκος</td>
				   <td> <input type="text" name="lon" pattern="\d{2}.\d{6}" title="Επιτρεπόμενη μορφή: xx.xxxxxx" placeholder="Εισάγετε γεωγρ. μήκος" required></td></tr>
				   <td>Hub Εξυπηρέτησης</td>
				   <td>
					  <select class="form-control" id="hub" name="hub">
							<?php
								$queryusers = "SELECT name FROM crdb.hub";
								$db = mysqli_query($conn, $queryusers);
								while ( $d=mysqli_fetch_array($db)) {
									echo "<option><li><a>".$d['name']."</a></li></option>";
								}
							?>
					  </select>
				   </td></tr>
			   </tr>
		  </tbody>
		  </table>
		  <input type="submit" name="save" id="save" value="Επιβεβαίωση προσθήκης καταστήματος">
		  </form>
		  <?php
			mysqli_set_charset($conn, "utf8");
			
			if(isset($_POST['save']))
			{
				
			$sql = "INSERT INTO `crdb`.`point` VALUES ('$_POST[name]', '$_POST[street]', '$_POST[strno]', '$_POST[city]', '$_POST[pc]', '$_POST[phone]', '$_POST[lat]', '$_POST[lon]', '$_POST[hub]');";
			$sql = mysqli_query($conn,$sql);
			if(! $sql )
			{
			echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
			}
			}
		  ?>
	  </div>
    </div>

  </div>
</div>

<div id="pworkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Προσθήκη εργαζόμενου</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php $_PHP_SELF ?>">
        <table class="table bg-success table-bordered table-hover">
			<tbody>
				<tr>
					<td>Όνομα</td>
					<td><input type="text" name="name" placeholder="Εισάγετε όνομα" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Επώνυμο</td>
					<td><input type="text" name="surname" placeholder="Εισάγετε επώνυμο" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Username</td>
					<td><input type="text" name="username" placeholder="Εισάγετε username" pattern="[A-Za-z0-9]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Κωδικός</td>
					<td><input type="text" name="password" placeholder="Εισάγετε κωδικό" pattern="[A-Za-z0-9 ]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Χώρος εργασίας</td>
					<td><input type="text" name="workplace" id="pworkid" readonly></td></tr>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="psave" id="psave" value="Επιβεβαίωση προσθήκης εργαζόμενου">
		</form>
		<?php
			mysqli_set_charset($conn, "utf8");
			
			if(isset($_POST['psave']))
			{
			$sql1 = "INSERT INTO `crdb`.`employees` VALUES ('$_POST[username]', '$_POST[password]', 'point');";
			$sql2 = "INSERT INTO `crdb`.`pointemployees` VALUES ('$_POST[name]', '$_POST[surname]', '$_POST[username]', '$_POST[password]', '$_POST[workplace]');";
			$sql1 = mysqli_query($conn,$sql1);
			if( $sql1 ){
				$sql2 = mysqli_query($conn,$sql2);
			}else{
			echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
			}
			}
		?>
      </div>
    </div>

  </div>
</div>

<div id="pworkModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Τροποποίηση εργαζόμενου</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php $_PHP_SELF ?>">
        <table class="table bg-success table-bordered table-hover">
			<tbody>
				<tr>
					<td>Όνομα</td>
					<td><input type="text" name="name" id="pname" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Επώνυμο</td>
					<td><input type="text" name="surname" id="psurname" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Username</td>
					<td><input type="text" name="username" id="pusername" readonly></td></tr><!--change to id for full customization-->
					<td>Κωδικός</td>
					<td><input type="text" name="password" id="ppassword" pattern="[A-Za-z0-9]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Χώρος εργασίας</td>
					<td><select class="form-control" name="workplace" id="pworkplace">
							<?php
								$queryusers = "SELECT name FROM crdb.point";
								$db = mysqli_query($conn, $queryusers);
								while ( $d=mysqli_fetch_array($db)) {
									echo "<option><li><a>".$d['name']."</a></li></option>";
								}
							?>
					  </select></td></tr>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="psave2" id="psave2" value="Επιβεβαίωση αλλαγών">
		<input type="submit" name="pdel" id="pdel" value="Διαγραφή Υπαλλήλου">
		</form>
		<?php
			mysqli_set_charset($conn, "utf8");
			
			if(isset($_POST['psave2']))
			{
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$password = $_POST['password'];
			$username = $_POST['username'];
			$workplace = $_POST['workplace'];
			$sql1 = "UPDATE crdb.employees SET  password = '$password' WHERE usernname= '$username'";
			$sql2 = "UPDATE crdb.pointemployees SET  name= '$name', surname = '$surname', password = '$password', workplace = '$workplace' WHERE username = '$username'";
			$sql2 = mysqli_query($conn,$sql2);
			if( $sql2 ){
				$sql1 = mysqli_query($conn,$sql1);
			}else{
				echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
			}
			}elseif(isset($_POST['pdel']))
			{
				$username = $_POST['username'];
				$sql1 = "DELETE FROM crdb.employees WHERE username = '$username'";
				$sql1 = mysqli_query($conn,$sql1);
				if( !$sql1 ){
					echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
				}
			}
		?>
      </div>
    </div>

  </div>
</div>

<div id="hworkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Προσθήκη εργαζόμενου</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php $_PHP_SELF ?>">
        <table class="table bg-success table-bordered table-hover">
			<tbody>
				<tr>
					<td>Όνομα</td>
					<td><input type="text" name="name" placeholder="Εισάγετε όνομα" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Επώνυμο</td>
					<td><input type="text" name="surname" placeholder="Εισάγετε επώνυμο" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Username</td>
					<td><input type="text" name="username" placeholder="Εισάγετε username" pattern="[A-Za-z0-9]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Κωδικός</td>
					<td><input type="text" name="password" placeholder="Εισάγετε κωδικό" pattern="[A-Za-z0-9]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Χώρος εργασίας</td>
					<td><input type="text" name="workplace" id="hworkid" readonly></td></tr>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="hsave" id="hsave" value="Επιβεβαίωση προσθήκης εργαζόμενου">
		</form>
		<?php
			mysqli_set_charset($conn, "utf8");
			
			if(isset($_POST['hsave']))
			{
			$sql1 = "INSERT INTO `crdb`.`employees` VALUES ('$_POST[username]', '$_POST[password]', 'hub');";
			$sql2 = "INSERT INTO `crdb`.`hubemployees` VALUES ('$_POST[name]', '$_POST[surname]', '$_POST[username]', '$_POST[password]', '$_POST[workplace]');";
			$sql1 = mysqli_query($conn,$sql1);
			if( $sql1 ){
				$sql2 = mysqli_query($conn,$sql2);
			}else{
			echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
			}
			}
		?>
      </div>
    </div>

  </div>
</div>

<div id="hworkModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Τροποποίηση εργαζόμενου</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php $_PHP_SELF ?>">
        <table class="table bg-success table-bordered table-hover">
			<tbody>
				<tr>
					<td>Όνομα</td>
					<td><input type="text" name="name" id="hname" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Επώνυμο</td>
					<td><input type="text" name="surname" id="hsurname" pattern="[Α-Ωα-ωίϊΐόάέύϋΰήώΆΈΎΊΌΉΏ]{1,20}" title="Επιτρέπονται έως 20: ελληνικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Username</td>
					<td><input type="text" name="username" id="husername"  readonly></td></tr>
					<td>Κωδικός</td>
					<td><input type="text" name="password" id="hpassword" pattern="[A-Za-z0-9]{1,20}" title="Επιτρέπονται έως 20: ψηφία και αγγλικά γράμματα κεφαλαία ή πεζά." required></td></tr>
					<td>Χώρος εργασίας</td>
					<td>
					<select class="form-control" name="workplace" id="hworkplace">
							<?php
								$queryusers = "SELECT name FROM crdb.hub";
								$db = mysqli_query($conn, $queryusers);
								while ( $d=mysqli_fetch_array($db)) {
									echo "<option><li><a>".$d['name']."</a></li></option>";
								}
							?>
					  </select>
					</td></tr>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="hsave2" id="hsave2" value="Επιβεβαίωση αλλαγών">
		<input type="submit" name="hdel" id="hdel" value="Διαγραφή Υπαλλήλου">
		</form>
		<?php
			mysqli_set_charset($conn, "utf8");
			
			if(isset($_POST['hsave2']))
			{
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$password = $_POST['password'];
			$username = $_POST['username'];
			$workplace = $_POST['workplace'];
			$sql1 = "UPDATE crdb.employees SET  password = '$password' WHERE usernname= '$username'";
			$sql2 = "UPDATE crdb.hubemployees SET  name= '$name', surname = '$surname', password = '$password', workplace = '$workplace' WHERE username = '$username'";
			$sql2 = mysqli_query($conn,$sql2);
			if( $sql2 ){
				$sql1 = mysqli_query($conn,$sql1);
			}else{
				echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
			}
			}elseif(isset($_POST['hdel']))
			{
				$username = $_POST['username'];
				$sql1 = "DELETE FROM crdb.employees WHERE username = '$username'";
				$sql1 = mysqli_query($conn,$sql1);
				if( !$sql1 ){
					echo '<script>alert("Υπήρξε πρόβλημα στην ενημέρωση της βάσης δεδομένων\nΠαρακαλώ ελέγξτε για λάθος στοιχεία")</script>';
				}
			}
		?>
      </div>
    </div>

  </div>
</div>