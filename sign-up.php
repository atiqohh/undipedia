<?php include('header.html') ?>
<?php include('navbar.html') ?>

<?php
require_once('db_login.php');

if (isset($_POST["submit"])){
	$valid = TRUE;
	$name = test_input($_POST['name']);
	if ($name == ''){
		$error_name = "Nama harus diisi";
		$valid = FALSE;
	}
	elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
		$error_name = "Only letters and white space allowed";
		$valid = FALSE;
	}
	
	$password = md5(test_input($_POST['password']));
	if ($password == ''){
		$error_password = "Password harus diisi";
		$valid = FALSE;
	}
	
	$alamat = test_input($_POST['alamat']);
	if ($alamat == ''){
		$error_alamat = "Alamat harus diisi";
		$valid = FALSE;
	}
	
	$email = test_input($_POST['email']);
	if ($email == ''){
		$error_email = "Email is required";
		$valid = FALSE;
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error_email = "Invalid email format";
		$valid = FALSE;
	}
	
	$kota = test_input($_POST['kota']);
	if ($kota == '' || $kota == 'none'){
		$error_kota = "Kota harus diisi";
		$valid = FALSE;
	}
	
	$telp = test_input($_POST['telp']);
	if ($telp == ''){
		$error_telp = "No. Telp. harus diisi";
		$valid = FALSE;
	}
	
	if ($valid){
		//asign query
		$query = " INSERT INTO penulis(nama,password,alamat,kota,email,no_telp) VALUES ('".$name."','".$password."','".$alamat."',
		'".$kota."','".$email."','".$telp."')";
		//execute
		$result = $db->query( $query );
		if (!result){
			die("Could not query the database: <br />". $db->error. '<br>Query:' .$query);
		}
		else{
			$db->close();
			header('Location: login.php');
		}
	}
}
?>
<br>
<div class="container" style="margin-top: 70px">
<div class="card">
<div class="card-header">Form Sign Up</div>
<div class="card-body">
<form method="POST" autocomplete="on" action="">
 <div class="form-group">
	<label for="name">Nama :</label>
	<input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) {echo $name;}?>">
	<div class="error"><?php if (isset($error_name)) echo $error_name;?></div>
 </div>
 <div class="form-group">
	<label for="name">Password :</label>
	<input type="password" class="form-control" id="password" name="password" size="30" value="">
	<div class="error"><?php if (isset($error_password)) echo $error_password;?></div>
 </div>
 <div class="form-group">
	<label for="name">Alamat :</label>
	<input type="text" class="form-control" id="alamat" name="alamat" value="<?php if (isset($alamat)) {echo $alamat;}?>">
	<div class="error"><?php if (isset($error_alamat)) echo $error_alamat;?></div>
 </div>
 <div class="form-group">
	<label for="name">Kota :</label>
	<input type="text" class="form-control" id="kota" name="kota" value="<?php if (isset($kota)) {echo $kota;}?>">
	<div class="error"><?php if (isset($error_kota)) echo $error_kota;?></div>
 </div>
 <div class="form-group">
	<label for="name">Email :</label>
	<input type="text" class="form-control" id="email" name="email" value="<?php if (isset($email)) {echo $email;}?>">
	<div class="error"><?php if (isset($error_email)) echo $error_email;?></div>
 </div>
 <div class="form-group">
	<label for="name">No. Telp :</label>
	<input type="text" class="form-control" id="telp" name="telp" value="<?php if (isset($telp)) {echo $telp;}?>">
	<div class="error"><?php if (isset($error_telp)) echo $error_telp;?></div>
 </div>
 <br>
 <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
 <a href="index.php" class="btn btn-secondary">Cancel</a>
</form> 
</div>
</div>
</div>
<?php include('footer.html') ?>
<?php 
$db->close();
?>