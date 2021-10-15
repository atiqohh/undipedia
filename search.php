<?php
  include 'db_login.php';
  
  $qpost=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC LIMIT 5")or die(mysqli_error());
  $rpost=mysqli_fetch_array($qpost);	
	$search=$_GET['search'];
	$query = "SELECT * FROM post WHERE judul LIKE '%$search%' OR isipost LIKE '%$search%'";
	$query_search = mysqli_query($db, $query);

	if(!$query_search){
		die("QUERY FAILED" . mysqli_error($db));
	}

	$count = mysqli_num_rows($query_search);

	if($count == 0){
		$error_search="<h5 class='text-center'> Pencarian tidak ditemukan.</h5>";
	}
?>

<?php include('header.html') ?>
<?php include('navbar.html') ?>

    <div class="site-section">
      <div class="container">
            <div class="section-title" style="margin-bottom:30px">
              <h2>Hasil Pencarian</h2>
            </div>
			<div class="error"><?php if (isset($error_search)) echo $error_search;?></div>
			<?php  	
				while($data = mysqli_fetch_assoc($query_search)){
					$idpost = $data['idpost'];
					$judul = $data['judul'];
					$idkategori = $data['idkategori'];
					$isipost = substr($data['isipost'], 0, 300) . "...";
					$file_gambar = $data['file_gambar'];
					$tgl_insert = $data['tgl_insert'];
					$idpenulis = $data['idpenulis'];
					echo '<div class="post-entry-2 d-flex">';
					echo '<div class="thumbnail order-md-2" style="background-image: url(data:image/jpeg;base64,'.base64_encode($file_gambar).')"></div>';
					echo '<div class="contents order-md-1 pl-0">';
					echo '<h2><a href="show_post_pengunjung.php?id='.$idpost.'">'.$judul.'</a></h2>';
						echo '<p>';
						$text=$isipost;
						$num_char=255;
						$cut_text = substr($text, 0, $num_char);
						if ($text{$num_char - 1} != ' ') {
							$new_pos = strrpos($cut_text, ' ');
							$cut_text = substr($text, 0, $new_pos);
						}
						echo $cut_text . '...';
						echo '</p>';
					echo '<div class="post-meta">';
					echo '<span class="d-block">';
					$idpenulis = $idpenulis;
					$qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
					$rpenulis=mysqli_fetch_array($qpenulis);
					echo $rpenulis['nama'];
					$idkategori = $idkategori;
					$qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
					$rkategori=mysqli_fetch_array($qkategori);
					echo ' in <a href="categories.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
					echo '<span class="date-read">';
					$date = new DateTime($tgl_insert);
					echo $date->format('M d, Y');
					echo '<span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>';
					echo '</div></div></div>';
				}
			?>
      </div>
    </div>

    <div class="site-section subscribe bg-light">
        <div class="container">
            <form action="#" class="row align-items-center">
            <div class="col-md-10 mr-auto" style="text-align: justify;">
                <h2>UNDIPedia</h2>
                <p>UDIPedia adalah sebuah blog dimana kamu dapat mencari dan saling berbagi mengenai informasi unik, terbaru, terhangat dan juga informatif mengenai semua hal yang terjadi di sekitar Undip. Banyak artikel-artikel yang membantu dan juga bermanfaat, mulai dari tips bagi mahasiswa yang merantau, tips olahraga, mengenal lingkungan di sekitar Undip, serta mencari informasi mengenai lomba. Kamu dapat menjadi pengunjung, maupun penulis dalam blog ini. Tunggu apalagi? Ayo join blog kita sekarang!</p>
            </div>
            </form>
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