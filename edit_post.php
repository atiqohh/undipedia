<?php
  include 'db_login.php';
  session_start();
$user=$_SESSION['username'];
$query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
$id=$_GET['id'];
$qpost=mysqli_query($db,"SELECT * FROM post where idpost='$id'")or die(mysqli_error());
$rpost=mysqli_fetch_array($qpost);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

<?php
if (isset($_POST["submit"])) {
    $valid = TRUE;
    $judul = test_input($_POST['judul']);
    if ($judul == '') {
        $error_judul = "Name is required";
        $valid = FALSE;
    }
	$kategori = test_input($_POST['kategori']);
	$isi = test_input($_POST['isi']);
    if ($judul == '') {
        $error_judul = "Name is required";
        $valid = FALSE;
    }

    if($valid){
        #escape inputs data
        $judul = $db->real_escape_string($judul);
		$idpenulis = $row['idpenulis'];
		$imgData = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
        #assign a query
        $query = " UPDATE post SET judul='".$judul."', idkategori=$kategori, isipost='".$isi."', file_gambar='{$imgData}' WHERE idpost='$id'";
        #execute query
        $result =$db->query($query);
        if (!$result) {
            die ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: view_post.php');
        }
        #close connection
        $db->close();
    }
}
?>

<br><br><br><br>
<div class="container">
<div class="card">
<div class="card-header">Edit Post</div>
<div class="card-body">
<form method="POST" autocomplete="on" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="judul">Judul :</label>
        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $rpost['judul'];?>">
        <div class="error"><?php if (isset($error_judul)) echo $error_judul;?></div>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori :</label>
        <select id="kategori" name="kategori" class="form-control">
			<?php
				$idkategori = $rpost['idkategori'];
				$query = " SELECT * FROM kategori WHERE idkategori=$idkategori ";
				$result =$db->query($query);
				$row=$result->fetch_object();
				echo'<option value="'.$row->idkategori.'">'.$row->nama.'</option>';
            ?>
			<?php
				require_once('db_login.php');
				$query = " SELECT * FROM kategori ORDER BY idkategori ";
				#execute query
				$result =$db->query($query);
				if (!$result) {
					die("Could not query the database: <br>".$db->error);
				}
				while ($row=$result->fetch_object()) {
					echo'<option value="'.$row->idkategori.'">'.$row->nama.'</option>';
				}
				$result->free();
				$db->close();
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="isi">Isi Post :</label>
        <textarea class="form-control" id="isi" name="isi" rows="3" cols="40" minlength="5">
			<?php echo $rpost['isipost'];?>
		</textarea>
        <div class="error"><?php if (isset($error_isi)) echo $error_isi;?></div>
    </div>
    <div class="form-group">
      <label>Pilih file gambar :</label><br>
      <input class="inputFile" type="file" id="gambar" name="gambar">
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    <a href="view_post.php" class="btn btn-secondary">Cancel</a>
</form>
</div>
</div>
</div>
<br><br>
<?php include('footer.html') ?>