<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
  
  $idpost = $_GET['id'];
  $qpost=mysqli_query($db,"SELECT * FROM post where idpost='$idpost'")or die(mysqli_error());
  $rpost=mysqli_fetch_array($qpost);
	
  $idpenulis = $rpost['idpenulis'];
  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
  $rpenulis=mysqli_fetch_array($qpenulis);

  $idkategori = $rpost['idkategori'];
  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
  $rkategori=mysqli_fetch_array($qkategori);
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 single-content">
            
            <p class="mb-5">
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($rpost['file_gambar']).'" width="700" height="400"/>';
				?>
            </p>  
            <h1 class="mb-3">
				<?php echo $rpost['judul'];?>
			</h1>
            <div class="post-meta d-flex mb-4">
              <div class="vcard">
                <span class="d-block"><?php echo $rpenulis['nama'];?> in
				<?php 
					echo '<a href="categories_login.php?id='.$idkategori.'">';
					echo $rkategori['nama'];
				?></a></span>
                <span class="date-read"><?php
					$date = new DateTime($rpost['tgl_insert']);
					echo $date->format('M d, Y');
				?><span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
              </div>
            </div>
				<?php echo $rpost['isipost'];?>
            <div class="pt-5">
                    <p>Categories:  
					<?php 
						echo '<a href="categories_login.php?id='.$idkategori.'">';
						echo $rkategori['nama'];
					?></a></p>
                  </div>
				  
                  <div class="pt-5">
                    <div class="section-title" style="margin-bottom: 20px">
                      <h2>
						<?php	
							$result = $db->query(" SELECT * FROM komentar WHERE idpost=$idpost AND idpenulis=$idpenulis");
							echo $result->num_rows.'&nbsp;&nbsp';
						?>
					  Comments</h2>
                    </div>
                    <ul class="comment-list">
                      <li class="comment">
						<div class="container">
						  <script>
							function confirmationDelete(anchor){
							var conf = confirm('Are you sure want to delete this comment?');
							if(conf)
								window.location=anchor.attr("href");
							}
						  </script>
							<?php
							  while ($rkomen = $result->fetch_object()){
								  echo '<div class="row">';
								  echo '<div class="col-md-3">';
								  echo '<h5 style="margin-bottom: 0px">Anonim</h5>';
								  $dkomen = new DateTime(''.$rkomen->tgl_update.'');
								  echo '<span class="date-read">';
								  echo $dkomen->format('M d, Y');
								  echo '</span><br>';
								  echo ''.$rkomen->isi.'';
								  echo '</div><div class="col-md-3">';
								  echo '<br><a onclick="javascript:confirmationDelete($(this));return false;" class="btn btn-danger btn-sm" href="delete_komen.php?id='.$rkomen->idkomentar.'&idpost='.$idpost.'">Delete</a>';
								  echo '</div>';
								  echo '</div><br>';
							  }
							?>
						</div>
                      </li>
					</ul>
                    <!-- END comment-list -->
                    
                  </div>
          </div>


        </div>
        
      </div>
    </div>

  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>