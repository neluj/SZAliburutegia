
<?php
	session_start();
	include 'konexioa.php';
	 
	 $tbl_name = "erabiltzailea";
	if ($esteka->connect_error) {
	 die("ezin izan da datu basera konektatu: " . $esteka->connect_error);
	}
	 $posta = mysqli_real_escape_string($esteka,$_POST['posta']);
	 $pass = mysqli_real_escape_string($esteka,$_POST['pasahitza']);
	  
	 $passkript = sha1($pass);
	 $sql = "SELECT * FROM $tbl_name WHERE Posta = '$posta' and Pasahitza = '$passkript'";

	 $erantzuna = mysqli_query($esteka,$sql);

      
     $count = mysqli_num_rows($erantzuna);
	 
	 
	if ($count == 1) {    

		$_SESSION['loggedin'] = true;
		$erabiltzailea =  mysqli_fetch_array($erantzuna,MYSQLI_ASSOC);

	    $_SESSION['posta'] = $erabiltzailea['posta'];
		$_SESSION['erabiltzaileizena'] = $erabiltzailea['erabiltzaileizena'];
		$_SESSION['mota'] = $erabiltzailea['mota'];
		$_SESSION['argazkia'] = base64_encode($erabiltzailea['argazkia']);	

		if ( $_SESSION['mota']=='BAZKIDEA'){
			header('Location: index.php');
		}else if($_SESSION['mota']=='LANGILEA'){
			header('Location: index.php');	 
		}
	 } else { 
	   echo "Posta edo pasahitza ez da zuzena.";
	 }
	
	 mysqli_close($esteka);
?>