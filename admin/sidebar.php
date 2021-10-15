<?php include('header.html') ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  <!-- CSS -->
    body {
      font-family: "Lato", sans-serif;
    }

    .sidenav {
      height: 100%;
      width: 200px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      padding-top: 20px;
    }

    .sidenav a {
      padding: 6px 6px 6px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

    .main {
      margin-left: 200px; /* Same as the width of the sidenav */
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
      .sidenav a {color: white;}
    }
</style>

<div class="sidenav">
  <div class="container">
        <a href="indexadm.php" class="site-logo"><img src="images/logo.png" width="70%">UNDIPedia</a>
        <a href="indexadm.php" class="ml-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black">
		<span class="icon-menu h3"></span></a><hr style="border-top: 1px solid white">
	    <a href="indexadm.php">REKAP</a>
	    <a href="view_kategori.php">KATEGORI</a>
	    <a href="view_penulis.php">PENULIS</a>
	    <a href="profile_adm.php">PROFILE</a>
  </div>
</div>
