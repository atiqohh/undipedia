<?php
	$id = $_GET['id'];
	#include login information
	require_once('db_login.php');
	#assign query
	$query = " DELETE FROM kategori WHERE idkategori=".$id." ";
	#execute query
	$result = $db->query($query);
	if (!$result) {
	    die ("Could not query the database: <br>".$db->error);
	}else {
	    $db->close();
	    header('Location: view_kategori.php');
	}
	#close db connection
	$db->close();
?>