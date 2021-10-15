<?php
  include 'db_login.php';
  session_start();
	$user=$_SESSION['username'];
	$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

<br><br><br>
  <div class="container">
    <br><br>
  <div class="card">
  <div class="card-header">Daftar Post</div>
  <div class="card-body">
  <br>
  <a class="btn btn-primary" href="add_post.php">+ Add Post</a><br /><br />
  <table class="table table-striped">
      <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Action</th>
	  <th>Jumlah Komentar</th>
	  <th></th>
    </tr>
  <script>
    function confirmationDelete(anchor){
	var conf = confirm('Are you sure want to delete this post?');
	if(conf)
		window.location=anchor.attr("href");
	}
  </script>
  <?php
  // Include our login information
  // Execute the query
  $idpenulis = $row['idpenulis'];
  $result = $db->query(" SELECT * FROM post WHERE idpenulis=$idpenulis ");
  if (!$result){
     die ("Could not query the database: <br />". $db->error);
  }
  // Fetch and display the results
  $i = 1;
  while ($row = $result->fetch_object()){
    echo '<tr>';
      echo '<td>'.$i.'</td>';
      echo '<td><a href="show_post.php?id='.$row->idpost.'">'.$row->judul.'</a></td> ';
      echo '<td><a class="btn btn-warning btn-sm" href="edit_post.php?id='.$row->idpost.'">Edit</a>&nbsp;&nbsp; 
			<a onclick="javascript:confirmationDelete($(this));return false;" class="btn btn-danger btn-sm" href="delete_post.php?id='.$row->idpost.'">Delete</a>&nbsp;&nbsp';
	  $idpost_inrow = $row->idpost;
	  $idpenulis_inrow = $row->idpenulis;
	  $qkomentar = $db->query("SELECT * FROM komentar where idpost=$idpost_inrow and idpenulis=$idpenulis_inrow");
	  echo '<td>'.$qkomentar->num_rows;
	  echo '</td><td><a class="btn btn-primary btn-sm" href="atur_komentar.php?id='.$row->idpost.'">Atur Komentar</a>&nbsp;&nbsp;
	  </td>';
    echo '</tr>';
    $i++;
  }
  echo '</table>';
  echo '<br />';
  echo 'Total Rows = '.$result->num_rows;
  $result->free();
  $db->close();
  ?>
  </table>
<br>
</div>
</div>
</div>
<br><br>
<?php include('footer.html') ?>