<?php include('header.html') ?>
<?php include 'sidebar.php'; ?>
<div class="main">
    <div class="py-0">
        <div class="half-post-entry d-block d-lg-flex bg-light">
          <div class="contents">
            <h2><a href="blog-single.html">DASHBOARD ADMIN</a></h2>
            <h3 class="mb-3">Selamat Datang, Admin!</h3>
          </div>
        </div><br><br>
      <div class="container">
        <div class="container">
          <div class="card">
              <div class="card-header">Rekap Post per Kategori</div>
                  <div class="card-body"><br>
                  <table class="table table-striped">
                      <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Post</th>
                      </tr>
                      <?php
                          // Include our login information
                          require_once('db_login.php');
                          // Execute the query
                          $result = $db->query(" SELECT k.idkategori as idkategori, k.nama as kategori, count(p.idkategori) as jumlah from post p join kategori k on p.idkategori = k.idkategori Group by k.idkategori ");
                          if (!$result){
                             die ("Could not query the database: <br />". $db->error);
                          }
                          // Fetch and display the results
                          $i = 1;
                          while ($row = $result->fetch_object()){
                            echo '<tr>';
                              echo '<td>'.$i.'</td>';
                              echo '<td>'.$row->kategori.'</td> ';
                              echo '<td>'.$row->jumlah.'</td>';
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
      </div>
    </div>
  </div><br><br><br>
<?php include('footer.html') ?>