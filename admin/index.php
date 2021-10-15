<?php include('header.html') ?>
<?php include('navbar.html') ?>

<?php
require_once('db_login.php');

if(isset($_POST["submit"])){
	$valid = TRUE; //flag validasi
	//cek validasi email
	$email = test_input(isset($_POST['email']) ? $_POST['email'] : '');
	if ($email == ''){
		$error_email = "Email is required";
		$valid = FALSE;
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error_email = "Invalid email format";
		$valid = FALSE;
	}
	//cek validasi password
	$password = test_input(isset($_POST['password']) ? $_POST['password'] : '');
	if ($password == ''){
		$error_password = "Password is required";
		$valid = FALSE;
	}
	
	//cek validasi
	if($valid){
		//asign query
		$query = " SELECT email FROM admin WHERE email='".$email."' AND password='".
		md5($password)."' ";
		//execute the query
		$result = $db->query( $query );
		if(!$result){
			die ("Could not query the database: <br />". $db->error);
		}
		else{
			if ($result->num_rows > 0){ //login berhasil
				// buat Session
				session_start();
				$_SESSION['username'] = $email;
				header('Location: indexadm.php');
			}
			else{
				$error_akun = "Combination of username and password are not correct.";
			}
		}
	//close db connection
	$db->close();
	}

}
?>
	
<br>
<div class="container" style="margin-top: 70px">
<div class="card">
	<div class="card-header">Admin Login Form</div>
	<div class="card-body">	
	<form method="POST" autocomplete="on" action="">
		<div class="form-group">	
			<label for="username">Email :</label>
			<input type="email" class="form-control" id="email" name="email" size="30" value="<?php if (isset($email)) {echo $email;}?>">
			<div class="error"><?php if (isset($error_email)) echo $error_email;?></div>
		</div>
		<div class="form-group">
			<label for="password">Password :</label>
			<input type="password" class="form-control" id="password" name="password" size="30" value="">
			<div class="error"><?php if (isset($error_password)) echo $error_password;?></div>
		</div>
		<button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
		<div class="error"><?php if (isset($error_akun)) echo '<br>'.$error_akun;?></div>
	</form>
	</div>
</div>
</div>
<?php include('footer.html') ?>