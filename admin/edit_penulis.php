<?php
//FILE edit_customer.php
//Deskripsi: menampilkan form edit data customer dan mengupdate data ke database

require_once('db_login.php');
$id=$_GET['id'];

if (!isset($_POST["submit"])) {
	$result = $db->query(" SELECT * FROM penulis WHERE idpenulis=".$id." ");
	if (!$result){
	   die ("Could not query the database: <br />". $db->error);
	}
	else{
		while ($row=$result->fetch_object()){
			$nama=$row->nama;
			$alamat=$row->alamat;
			$kota=$row->kota;
			$no_telp=$row->no_telp;
		}
	}
}
else{
	$valid=TRUE;
	$nama=test_input($_POST['nama']);
	if($nama==''){
		$error_nama="Name is required";
		$valid=FALSE;
	}
	elseif(!preg_match("/^[a-zA-Z]*$/",$nama)){
		$error_nama="Only letters and white space allowed";
		$valid=FALSE;
	}
	$alamat=test_input($_POST['alamat']);
	if ($alamat=='') {
		$error_alamat="Address is required";
		$valid=FALSE;
	}
	$kota=test_input($_POST['kota']);
	if ($kota=='') {
		$error_kota="City is required";
		$valid=FALSE;
	}
	$no_telp=test_input($_POST['no_telp']);
	if ($no_telp=='') {
		$error_no_telp="Phone Number is required";
		$valid=FALSE;
	}
	elseif(!preg_match("/^[0-9]*$/",$no_telp)){
		$error_no_telp="Only numbers allowed";
		$valid=FALSE;
	}
	$password=test_input($_POST['password']);
	if ($password=='') {
		$error_password="Password is required";
		$valid=FALSE;
	}

	//update data into database
	if ($valid) {
		$nama=$db->real_escape_string($nama);
		$alamat=$db->real_escape_string($alamat);
		$kota=$db->real_escape_string($kota);
    	$password = md5(test_input($_POST['password']));
		//Asign a query
		$query="UPDATE penulis SET nama='".$nama."', alamat='".$alamat."',kota='".$kota."',no_telp='".$no_telp."',password='".$password."' WHERE idpenulis='".$id."'";
		//Execute the query
		$result=$db->query($query);
		if (!$result) {
			die("Could not query the database: <br/>".$db->error.'<br>Query:'.$query);
		}
		else{
			$db->close();
			header('Location: view_penulis.php');
		}
	}
}
?>

<?php include('sidebar.php') ?>
<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Mengubah Penulis</h3>
          </div>
      </div>
      <br>
          <div class="container">
		<br><br>
			<div class="card">
				<div class="card-header">Edit Penulis</div>
				<div class="card-body">
					<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
						<div class="form-group">
							<label for="name">Nama:</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
							<div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat:</label>
							<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat;?>">
							<div class="error"><?php if(isset($error_alamat)) echo $error_alamat;?></div>
						</div>
						<div class="form-group">
							<label for="kota">Kota:</label>
							<input type="text" class="form-control" id="kota" name="kota" value="<?php echo $kota;?>">
							<div class="error"><?php if(isset($error_kota)) echo $error_kota;?></div>
						</div>
						<div class="form-group">
							<label for="no_telp">Nomor Telpon:</label>
							<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $no_telp;?>">
							<div class="error"><?php if(isset($error_no_telp)) echo $error_no_telp;?></div>
						</div>
						<div class="form-group">
							<label for="password">Password: </label>
							<input type="password" class="form-control" id="password" name="password" value="">
							<div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
						</div>
					<br>
					<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
					<a href="view_penulis.php" class="btn btn-secondary">Cancel</a>
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