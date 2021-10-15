<?php
  include 'db_login.php';
  session_start();
	$user=$_SESSION['username'];
	$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
    if(isset($_GET['id']))
      {
        $id=$_GET['id'];
		$idpost=$_GET['idpost'];
        $query = " delete from komentar where idkomentar='$id' ";
        $result =$db->query($query);
        if($result)
          {
          header('location:atur_komentar.php?id='.$idpost.'');
          }
      }
?>