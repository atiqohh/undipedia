<?php
  include 'db_login.php';
  session_start();
	$user=$_SESSION['username'];
	$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
    if(isset($_GET['id']))
      {
        $id=$_GET['id'];
        $query = " delete from post where idpost='$id' ";
        $result =$db->query($query);
        if($result)
          {
          header('location:view_post.php');
          }
      }
?>