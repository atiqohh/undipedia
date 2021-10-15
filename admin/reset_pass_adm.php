<?php
  include 'db_login.php';
  session_start();
	$id=$_SESSION['username'];
	$query=mysqli_query($db,"SELECT * FROM admin where email='$id'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
?>

<?php include('header.html') ?>
<?php include('sidebar.php') ?>

<?php
if (isset($_POST["submit"])){
	$valid = TRUE;
	$password = md5(test_input($_POST['password']));
	if ($password == ''){
		$error_password = "Password harus diisi";
		$valid = FALSE;
	}
	
	if ($valid){
		$idadmin = $row['idadmin'];
		//asign query
		$query = "UPDATE admin SET password = '".$password."' WHERE idadmin='".$idadmin."' ";
		//execute
		$result = $db->query( $query );
		if (!result){
			die("Could not query the database: <br />". $db->error. '<br>Query:' .$query);
		}
		else{
			$db->close();
			header('Location: profile_adm.php');
		}
	}
}
?>
<br>
<div class="main">
	<div class="container" style="margin-top: 70px">
	<div class="card">
	<div class="card-header">Reset Password</div>
	<div class="card-body">
	<form method="POST" autocomplete="on" action="">
	 <div class="form-group">
		<label for="password">Password Baru :</label>
		<input type="password" class="form-control" id="password" name="password">
		<div class="error"><?php if (isset($error_password)) echo $error_password;?></div>
	 </div>
	 <br>
	 <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
	 <a href="profile_adm.php" class="btn btn-secondary">Cancel</a>
	</form> 
	</div>
	</div>
	</div>
</div>

<?php include('footer.html') ?>
<?php 
$db->close();
?>