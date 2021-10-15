<?php
include('header.html');
include('navbar.php');

?>
<br><br><br><br>


<?php include('footer.html') ?>

<?php
require_once('db_login.php');
    $id = $_GET['id'];
    $query = " SELECT * FROM penulis WHERE idpenulis=".$id."";
    $result = $db->query($query);
    if (!$result) {
        die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
    }
    $row = $result->fetch_object();
?>

<?php include('sidebar.php') ?>

<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Menghapus Kategori</h3>
          </div>
      </div>
     <br><br>
    <div class="container">
    <div class="card">
        <div class="card-header">Confirm Delete Penulis</div>
            <div class="card-body">
    <br>
    <table class="table table-striped">
        <tr>
            <td colspan="2">Nama Penulis: </td>
            <td><?php echo $row->nama; ?></td>
        </tr>
        <tr>
            <td colspan="2">Kota: </td>
            <td><?php echo $row->kota; ?></td>
        </tr>
        <tr>
            <td colspan="2">Alamat: </td>
            <td><?php echo $row->alamat; ?></td>
        </tr>
        <tr>
            <td colspan="2">Nomor Telpon: </td>
            <td><?php echo $row->no_telp; ?></td>
        </tr>
    </table>
    <p>Apakah anda yakin akan menghapus Penulis ini?</p>
    <a class="btn btn-danger" href="delete_penulis.php?id=<?php echo $id; ?>">Yakin</a>
    <a class="btn btn-primary" href="view_penulis.php">TIdak</a><br><br>
</div>
</div>
</div>
<br><br><br>
  </div>
</div>
<?php include('footer.html') ?>