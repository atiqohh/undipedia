<?php
  include 'db_login.php';
  session_start();
$user=$_SESSION['username'];
$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

<?php
if (isset($_POST["submit"])){
	$valid = TRUE;
	$nama = test_input($_POST['nama']);
	if ($nama == ''){
		$error_nama = "Nama harus diisi";
		$valid = FALSE;
	}
	elseif(!preg_match("/^[a-zA-Z ]*$/",$nama)){
		$error_nama = "Only letters and white space allowed";
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
	
	$no_telp = test_input($_POST['no_telp']);
	if ($no_telp == ''){
		$error_telp = "No. Telp. harus diisi";
		$valid = FALSE;
	}
	
	if ($valid){
        $nama = $db->real_escape_string($nama);
        $no_telp = $db->real_escape_string($no_telp);
		$idpenulis = $row['idpenulis'];
		//asign query
		$query = "UPDATE penulis SET nama = '".$nama."', email = '".$email."', alamat = '".$alamat."', kota = '".$kota."', no_telp = '".$no_telp."' WHERE idpenulis='$idpenulis'";
		//execute
		$result = $db->query( $query );
		if (!result){
			die("Could not query the database: <br />". $db->error. '<br>Query:' .$query);
		}
		else{
			$db->close();
			header('Location: show_profile.php');
		}
	}
}
?>
<br>
<div class="container" style="margin-top: 70px">
<div class="card">
<div class="card-header">Edit Profile</div>
<div class="card-body">
<form method="POST" autocomplete="on" action="">
 <div class="form-group">
	<label for="nama">Nama :</label>
	<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'];?>">
	<div class="error"><?php if (isset($error_nama)) echo $error_nama;?></div>
 </div>
 <div class="form-group">
	<label for="alamat">Alamat :</label>
	<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat'];?>">
	<div class="error"><?php if (isset($error_alamat)) echo $error_alamat;?></div>
 </div>
 <div class="form-group">
	<label for="kota">Kota :</label>
	<input type="text" class="form-control" id="kota" name="kota" value="<?php echo $row['kota'];?>">
	<div class="error"><?php if (isset($error_kota)) echo $error_kota;?></div>
 </div>
 <div class="form-group">
	<label for="email">Email :</label>
	<input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email'];?>">
	<div class="error"><?php if (isset($error_email)) echo $error_email;?></div>
 </div>
 <div class="form-group">
	<label for="no_telp">No. Telp :</label>
	<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $row['no_telp'];?>">
	<div class="error"><?php if (isset($error_telp)) echo $error_telp;?></div>
 </div>
 <br>
 <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
 <a href="show_profile.php" class="btn btn-secondary">Cancel</a>
</form> 
</div>
</div>
</div>
<?php include('footer.html') ?>
<?php 
$db->close();
?>