<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $query=mysqli_query($db,"SELECT * FROM penulis where email='$user'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
  
  $qpost=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC LIMIT 6")or die(mysqli_error());
  $rpost=mysqli_fetch_array($qpost);	
?>

<?php include('header.html') ?>
<?php include('navbar_login.html') ?>

 <div class="site-section py-0">
	<?php
	  $qpost_new=mysqli_query($db,"SELECT * FROM post ORDER BY tgl_insert DESC")or die(mysqli_error());
	  $rpost_new=mysqli_fetch_array($qpost_new);	  
	?>
      <div class="owl-carousel hero-slide owl-style">
        <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
			<?php
				echo '<div class="img-bg" style="background-image: url(data:image/jpeg;base64,'.base64_encode($rpost_new['file_gambar']).')"></div>';
            ?>
			  <div class="contents">
                <span class="caption">Topik Hangat</span>                
				<?php
					echo '<h2><a href="show_post.php?id='.$rpost_new['idpost'].'">'.$rpost_new['judul'].'</a></h2>';
					echo '<p class="mb-3">';
					$text=$rpost_new['isipost'];
					$num_char=550;
					$cut_text = substr($text, 0, $num_char);
					if ($text{$num_char - 1} != ' ') {
						$new_pos = strrpos($cut_text, ' ');
						$cut_text = substr($text, 0, $new_pos);
					}
					echo $cut_text . '...';
					echo '</p>';
                ?>
				<div class="post-meta">
                  <span class="d-block">
				  <?php
				  $idpenulis = $rpost['idpenulis'];
				  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
				  $rpenulis=mysqli_fetch_array($qpenulis);
				  echo $rpenulis['nama'];
				  $idkategori = $rpost['idkategori'];
				  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
				  $rkategori=mysqli_fetch_array($qkategori);
					echo ' in <a href="categories_login.php?id='.$rpost_new['idkategori'].'">';
					echo $rkategori['nama'];
					echo '</a></span>';
				  ?>
					<span class="date-read">
					<?php
					$date = new DateTime($rpost['tgl_insert']);
					echo $date->format('M d, Y');
					?>
				  <span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
			<?php
				$rpost_new=mysqli_fetch_array($qpost_new);
				echo '<div class="img-bg" style="background-image: url(data:image/jpeg;base64,'.base64_encode($rpost_new['file_gambar']).')"></div>';
            ?>
			  <div class="contents">
                <span class="caption">Topik Hangat</span>                
				<?php
					echo '<h2><a href="show_post.php?id='.$rpost_new['idpost'].'">'.$rpost_new['judul'].'</a></h2>';
					echo '<p class="mb-3">';
					$text=$rpost_new['isipost'];
					$num_char=550;
					$cut_text = substr($text, 0, $num_char);
					if ($text{$num_char - 1} != ' ') {
						$new_pos = strrpos($cut_text, ' ');
						$cut_text = substr($text, 0, $new_pos);
					}
					echo $cut_text . '...';
					echo '</p>';
                ?>
				<div class="post-meta">
                  <span class="d-block">
				  <?php
				  $idpenulis = $rpost['idpenulis'];
				  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
				  $rpenulis=mysqli_fetch_array($qpenulis);
				  echo $rpenulis['nama'];
				  $idkategori = $rpost['idkategori'];
				  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
				  $rkategori=mysqli_fetch_array($qkategori);
					echo ' in <a href="categories_login.php?id='.$rpost_new['idkategori'].'">';
					echo $rkategori['nama'];
					echo '</a></span>';
				  ?>
					<span class="date-read">
					<?php
					$date = new DateTime($rpost['tgl_insert']);
					echo $date->format('M d, Y');
					?>
				  <span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="section-title" style="margin-bottom:30px">
                  <h2>Tulisan Terbaru</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="post-entry-1">
				  <?php echo '<a href="show_post.php?id='.$rpost['idpost'].'">';
					echo '<img src="data:image/jpeg;base64,'.base64_encode($rpost['file_gambar']).'" alt="Image" class="img-fluid"/>';
				  ?>
				  </a>
                  <h2>
					<?php 
						echo '<a href="show_post.php?id='.$rpost['idpost'].'">';
						echo $rpost['judul'];
						echo '</a>';
					?>
				  </h2>
					<?php
						echo '<p>';
						$text=$rpost['isipost'];
						$num_char=700;
						$cut_text = substr($text, 0, $num_char);
						if ($text{$num_char - 1} != ' ') {
							$new_pos = strrpos($cut_text, ' ');
							$cut_text = substr($text, 0, $new_pos);
						}
						echo $cut_text . '...';
						echo '</p>';
					?>
                  <div class="post-meta">
					  <div class="vcard">
						<span class="d-block"><?php 
						  $idpenulis = $rpost['idpenulis'];
						  $qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
						  $rpenulis=mysqli_fetch_array($qpenulis);
						  echo $rpenulis['nama'];
						  $idkategori = $rpost['idkategori'];
						  $qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
						  $rkategori=mysqli_fetch_array($qkategori);
							echo ' in <a href="categories_login.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
							echo '<span class="date-read">';
							$date = new DateTime($rpost['tgl_insert']);
							echo $date->format('M d, Y');
						?><span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>
					  </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
				<?php  	
					while ($row = $qpost->fetch_object()){
						echo '<div class="post-entry-2 d-flex">';
						echo '<div class="thumbnail" style="background-image: url(data:image/jpeg;base64,'.base64_encode($row->file_gambar).')"></div>';
						echo '<div class="contents">';
						echo '<h2><a href="show_post.php?id='.$row->idpost.'">'.$row->judul.'</a></h2>';
						echo '<div class="post-meta">';
						echo '<span class="d-block">';
						$idpenulis = $row->idpenulis;
						$qpenulis=mysqli_query($db,"SELECT * FROM penulis where idpenulis='$idpenulis'")or die(mysqli_error());
						$rpenulis=mysqli_fetch_array($qpenulis);
						echo $rpenulis['nama'];
						$idkategori = $row->idkategori;
						$qkategori=mysqli_query($db,"SELECT * FROM kategori where idkategori='$idkategori'")or die(mysqli_error());
						$rkategori=mysqli_fetch_array($qkategori);
						echo ' in <a href="categories_login.php?id='.$rkategori['idkategori'].'">'.$rkategori['nama'].'</a></span>';
						echo '<span class="date-read">';
						$date = new DateTime($row->tgl_insert);
						echo $date->format('M d, Y');
						echo '<span class="mx-1">&bullet;</span> <span class="icon-star2"></span></span>';
						echo '</div></div></div>';
					}
				?>
				<p>
				  <a href="new_post_login.php" class="more">See All New Post <span class="icon-keyboard_arrow_right"></span></a>
				</p>
              </div>
            </div>
      </div>
    </div>
    <!-- END section -->

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
<?php include('footer.html') ?>