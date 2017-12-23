<xsl:stylesheet version="1.0" 
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML>
	<head>
	<script>
		function info(isbn){
				window.location.href= ("liburuaInfo.php?isbn="+isbn);
		}
	</script>
	<script>
		function itzuli(kod){
				window.location.href= ("liburuaItzuli.php?kod="+kod);
		}
	</script>

	</head>
	<BODY>
	<?php
		session_start();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			if($_SESSION['mota']=='BAZKIDEA'){

			include 'konexioa.php';
			$posta=$_SESSION['posta'];
			$itzulia = $_GET['itzulia'];
			//saioa hasita dagoen posta hartuko dugu, eta itzuliak dauden edo itzuli gabe dauden
			//liburulista ikusi nahi dugun jakitzeko, GET bitartez eskaera $itzulia aldagaian gordeko dugu.
			//kodea ere gordeko dugu, itzultzerako orduan zein eragiketa den errezago jakitzeko.
			$sqlIsbnKod = "SELECT isbn,kod FROM liburulista WHERE posta = '$posta' AND itzulia='$itzulia'";
			$isbnKodErantzuna= $esteka->query($sqlIsbnKod);
			if (!$isbnKodErantzuna) {
				echo 'ezin izan da kontsulta egin: ' . $esteka->error;
				exit;
			}
		?>
				<!--liburulista-ko elementu guztiak taula baten kargatuko ditugu, eta listako
				elementu bakoitzaren isbn bitartez, liburu hori aurkitu eta bere datuak erakutsiko
				ditugu-->
				<TABLE>
					<THEAD><TR><TH>ERAGIKETA KODEA</TH><TH>ISBN</TH><TH>IZENBURUA</TH><TH>IDAZLEA</TH><TH>HIZKUNTZA</TH><TH>ARGITALETXEA</TH><TH>URTEA</TH><TH>AUKERAK</TH></TR></THEAD>
		<?php		while ($isbnKod =  mysqli_fetch_array($isbnKodErantzuna,MYSQLI_ASSOC)){
						$kodea = $isbnKod['kod'];
						$isbn=$isbnKod['isbn'];
						$sqlLiburua = "SELECT * FROM liburua WHERE isbn = '$isbn'";
						$liburuaErantzuna= $esteka->query($sqlLiburua);
						if (!$liburuaErantzuna) {
							echo 'ezin izan da kontsulta egin: ' . $esteka->error;
							exit;
						}
						$liburua =  mysqli_fetch_array($liburuaErantzuna,MYSQLI_ASSOC);

						//idazlearen izena lortu
						$idazleKodea = $liburua['idazlea'];
						$sqlIdazlea = "SELECT izena FROM idazlea WHERE kodea = '$idazleKodea'";
						$idazleaErantzuna= $esteka->query($sqlIdazlea);
						if (!$idazleaErantzuna) {
							echo 'ezin izan da kontsulta egin: ' . $esteka->error;
							exit;
						}
						$idazlea =  mysqli_fetch_array($idazleaErantzuna,MYSQLI_ASSOC);

			?>
							<TR>
								<TD>
									<?php echo $kodea;  ?><BR/>
								</TD>
								<TD>
									<?php echo $liburua['isbn'];  ?><BR/>
								</TD>
								<TD>
									<?php echo $liburua['izenburua'];  ?> <BR/>
								</TD>
								<TD>
									<?php echo $idazlea['izena'];  ?> <BR/>
								</TD>
								<TD>
									<?php echo $liburua['hizkuntza'];  ?><BR/>
								</TD>
								<TD>
									<?php echo $liburua['argitaletxea'];  ?> <BR/>
								</TD>
								<TD>
									<?php echo $liburua['urtea'];  ?><BR/>
								</TD>

								<TD>
								<!--Erabiltzaile guztiek ikusi ahal izango dute liburuan informazioa -->
								<button type="button"  id="liburuaInfobtn"  class="infobtn" onclick="info(<?php echo  $isbn; ?>);" >INFO</button>
								<!--Liburua itzultzeko, liburulista-ko kodea pasatuko zaio -->
								<?php if($itzulia=="EZ"){echo '<button type="button"  id="itzulibtn"  class="alokatubtn" onclick="itzuli('.$kodea.');" >ITZULI</button>';}  ?>
								</TD>
							</TR>
		<?php
					}
		}else{header("Location: erregistratu.php");}
	}else{header("Location: erregistratu.php");}
		?>
				</TABLE>
	</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>
