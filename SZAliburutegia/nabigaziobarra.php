<link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/formularioak.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/estiloak.css" media="screen" />

<div class="navbar">
		  <a href="index.php">Home</a>
		  <a href="liburuakIkusi.php">Liburuak</a>
			<?php
			session_start();
			echo '<div id="erabiltzailemenu">';
				echo   '<div class="dropdown">';
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					echo   '<button class="dropbtn">'.$_SESSION['posta'];
					echo   '<span class="arrow">&#9660</span>';
					echo   '</button>';
					echo   '<div class="dropdown-content">';
						if($_SESSION['mota']=='LANGILEA'){

							echo   '<a href="erabiltzailePanela.php">Erabiltzaile Panela</a>';
							echo   '<a href="liburuKudeaketa.php">Liburu Berria</a>';

						}
						else if($_SESSION['mota']=='BAZKIDEA'){

							echo   '<a href="erabiltzailePanela.php">Erabiltzaile Panela</a>';
						}
					echo   '<a href="saioaAmaitu.php">Saioa amaitu</a>';
				} else {
					echo   '<button class="dropbtn">Erabiltzaile Panela';
					echo   '<span class="arrow">&#9660</span>';
					echo   '</button>';
					echo   '<div class="dropdown-content">';
				    echo   '<a href="saioaHasi.php">Saioa hasi</a>';
				    echo   '<a href="erregistratu.php">Erregistratu</a>';

				}
					echo    '</div>';
					echo    '</div>';
					echo    '</div>';
                ?>

</div>
