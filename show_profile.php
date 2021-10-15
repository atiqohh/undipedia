<?php
  include 'db_login.php';
  session_start();
$user=$_SESSION['username'];
$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

<br>
<div class="container" style="margin-top: 70px">
<div class="card">
<div class="card-header">Profile</div>
<div class="card-body">
  <div class="row">
	  <div class="col-md-12 form-group">
		  <label for="name">Nama :</label>
		  <input type="text" id="nama" readonly class="form-control" value="<?php echo $row['nama'];?>">
	  </div>
	  <div class="col-md-12 form-group">
		  <label for="name">Email :</label>
		  <input type="text" id="email" readonly class="form-control" value="<?php echo $row['email'];?>">
	  </div>
  </div>
  <div class="row">
	  <div class="col-md-6 form-group">
		  <label for="name">Alamat :</label>
		  <input type="text" id="nama" readonly class="form-control" value="<?php echo $row['alamat'];?>">
	  </div>
	  <div class="col-md-6 form-group">
		  <label for="name">Kota :</label>
		  <input type="text" id="nama" readonly class="form-control" value="<?php echo $row['kota'];?>">
	  </div>
  </div>
  <div class="row">
	  <div class="col-md-6 form-group">
		  <label for="name">No. Telp :</label>
		  <input type="text" id="nama" readonly class="form-control" value="<?php echo $row['no_telp'];?>">
	  </div>
  </div>
 <br>
 <a href="edit_profile.php" class="btn btn-primary">Edit</a>&nbsp;&nbsp
 <a href="reset_pass.php" class="btn btn-warning btn-sm">Reset Password</a>
 <a href="logout.php" class="btn btn-danger btn-sm" style="float: right">Log Out</a>
</div>
</div>
</div>

<?php include('footer.html'); ?>