<?php
require_once('db_login.php');
$id=$_GET['id'];

if (!isset($_POST["submit"])) {
	$result = $db->query(" SELECT nama FROM kategori WHERE idkategori=".$id." ");
	if (!$result){
	   die ("Could not query the database: <br />". $db->error);
	}
	else{
		while ($row=$result->fetch_object()){
			$nama=$row->nama;
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
	elseif(!preg_match('/^[a-zA-Z\s]+$/', $nama)){
		$error_nama="Only letters and white space allowed";
		$valid=FALSE;
	}

	//update data into database
	if ($valid) {
		$nama=$db->real_escape_string($nama);
		//Asign a query
		$query="UPDATE kategori SET nama='".$nama."' WHERE idkategori='".$id."'";
		//Execute the query
		$result=$db->query($query);
		if (!$result) {
			die("Could not query the database: <br/>".$db->error.'<br>Query:'.$query);
		}
		else{
			$db->close();
			header('Location: view_kategori.php');
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
            <h3 class="mb-3">Mengedit Kategori</h3>
          </div>
      </div>
      <br>
      <div class="container">
		<br><br>
<div class="card">
	<div class="card-header">Edit Kategori</div>
	<div class="card-body">
		<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
			<div class="form-group">
				<label for="nama">Nama:</label>
				<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>">
				<div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
			</div>
		<br>
		<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
		<a href="view_kategori.php" class="btn btn-secondary">Cancel</a>
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