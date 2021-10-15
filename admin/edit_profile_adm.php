<?php
include ('db_login.php');
session_start();
$id=$_SESSION['username'];
	$query=mysqli_query($db,"SELECT * FROM admin where email='$id'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
?>

<?php include('sidebar.php') ?>

<?php
if (isset($_POST["submit"])) {
	$valid=TRUE;
	$nama=test_input($_POST['nama']);
	if($nama==''){
		$error_nama="Name is required";
		$valid=FALSE;
	}
	elseif(!preg_match("/^[a-zA-Z0-9]*$/",$nama)){
		$error_nama="Only letters and white space allowed";
		$valid=FALSE;
	}
	$email=test_input($_POST['email']);
	if ($email=='') {
		$error_email="Email is required";
		$valid=FALSE;
	}

	//update data into database
	if ($valid) {
		$nama=$db->real_escape_string($nama);
		$idadmin = $row['idadmin'];
		//Asign a query
		$query = "UPDATE admin SET nama='".$nama."', email='".$email."' WHERE idadmin='".$idadmin."' ";
		//Execute the query
		$result=$db->query( $query );
		if (!$result) {
			die("Could not query the database: <br/>".$db->error.'<br>Query:'.$query);
		}
		else{
			$db->close();
			header('Location: profile_adm.php');
		}
	}
}
?>

<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Mengubah Profile Admin</h3>
          </div>
      </div>
      <br>
          <div class="container">
		<br><br>
			<div class="card">
				<div class="card-header">Edit Profile</div>
				<div class="card-body">
					<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
						<div class="form-group">
							<label for="nama">Nama:</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'];?>">
							<div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'];?>">
							<div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
						</div>
					<br>
					<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
					<a href="profile_adm.php" class="btn btn-secondary">Cancel</a>
					</form>
				</div>
			</div></div>
			<br><br>
			<?php 
			$db->close();
			?>
<br><br><br>
  </div>
</div>
<?php include('footer.html') ?>