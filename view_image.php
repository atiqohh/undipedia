<?php
  include 'db_login.php';

  if(isset($_GET['id'])) {
	$idpost = $_GET['id'];
    $qimg = "SELECT * FROM post WHERE idpost=" . $idpost;
	$result = mysqli_query($db, $qimg) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
	$rimg = mysqli_fetch_array($result);
	header("Content-type: image/jpeg");
    echo $rimg['file_gambar'];
  }
  
  mysqli_close($db);
?>