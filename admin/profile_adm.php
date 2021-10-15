<?php include('sidebar.php') ?>

<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Profile Admin</h3>
          </div>
      </div>
      <div class="container">
    <br><br>
  <div class="card">
  <div class="card-header">Profile Admin</div>
  <div class="card-body">
  <br>
  <?php
  // Include our login information
  require_once('db_login.php');
  // Execute the query
  $result = $db->query(" SELECT * FROM admin ORDER BY idadmin ");
  if (!$result){
     die ("Could not query the database: <br />". $db->error);
  }
  // Fetch and display the results
  $i = 1;
  while ($row = $result->fetch_object()){
    echo '<div class="col-md-12 form-group">
			  <label for="nama">Nama :</label>
			  <input type="text" id="nama" readonly class="form-control" value="'.$row->nama.'">
		  </div>';
      echo '<div class="col-md-12 form-group">
			  <label for="email">Email :</label>
			  <input type="text" id="email" readonly class="form-control" value="'.$row->email.'">
		  </div>';
  }
  ?>
  <div class="container">
  	<a href="edit_profile_adm.php" class="btn btn-primary">Edit</a>
    <a href="reset_pass_adm.php" class="btn btn-danger">Reset Password</a>
	<a href="logout.php" class="btn btn-danger" style="float:right">Log Out</a>

  </div>
<br>
</div>
</div>
</div>
<br><br><br>
  </div>
</div>
<?php include('footer.html') ?>