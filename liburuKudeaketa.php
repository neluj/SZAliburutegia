
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
			<?php
				include 'nabigaziobarra.php';
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						if($_SESSION['mota']=='LANGILEA'){
							//Liburu bat editatu nahi bada, GET bidez liburuaren isbn
							//pasatuko zaio.
							$editatu=false;
							if(isset($_GET['isbn'])){
								$isbn=$_GET['isbn'];
								include 'konexioa.php';
								//isbn hori duen liburua billatuko da. Aurkitzen bada, bere datuak
								//formularioan kargatuko dira
								 $sql = "SELECT * FROM liburua WHERE isbn = '$isbn' ";

								$erantzuna = mysqli_query($esteka,$sql);
								$count = mysqli_num_rows($erantzuna);
                
								if($count == 1){
									$liburua =  mysqli_fetch_array($erantzuna,MYSQLI_ASSOC);
									$editatu=true;
									 ?>
									<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
										<script>
										$(function() {
											$("#isbn").val("<?php echo $liburua['isbn']; ?>");
											$("#isbn").prop('readonly', true);
											$("#izenburua").val("<?php echo $liburua['izenburua']; ?>");
											$("#argitaletxea").val("<?php echo $liburua['argitaletxea']; ?>");
											$("#sinopsia").val("<?php echo $liburua['sinopsia']; ?>");
											$("#urtea").val("<?php echo $liburua['urtea']; ?>");
											$("#stock").val("<?php echo $liburua['stock']; ?>");
										})
										</script>

					  <?php 		mysqli_close($esteka);
								} else{header("Location: erregistratu.php");}

							}?>
							<script src="https://code.jquery.com/jquery-2.2.4.js">	</script>
							 <script>
								//idazleBerriabtn botoian klick egiterakoan, idazleBerria div-ean idazleBerria.php
								//fitxategia kargatuko du (AJAX Jquery)
								$(document).ready(function(){
									$("#idazleBerriabtn").on("click", function(e){
										e.preventDefault();
										$("#idazleBerria").load("idazleBerria.php");
									});
								});
							</script>


							</head>
							<div class="karratua">
							<body>
								<!--Liburua editatu edo Liburu berria sartu behar bada, action bat edo bestea izango da. -->
								<form <?php if($editatu==true){echo 'action="liburuaEditatu.php"';}else{echo 'action="liburuaEnroll.php"';}  ?> enctype="multipart/form-data" method="post" id="liburuBerria" ></form>
									<p>
									<label><b>ISBN</b></label>
									<input type="text" placeholder="ISBN" name="isbn" id="isbn" form="liburuBerria" required>
									<p>
									<label><b>IZENBURUA</b></label>
									<input type="text" placeholder="Izenburua" name="izenburua" id="izenburua" form="liburuBerria" required>
									<p>
									<label><b>IDAZLEA</b></label>
									<?php
										include 'konexioa.php';

										$sqlidazlea = "SELECT kodea, izena FROM idazlea ";
										$idazleaerantzuna= $esteka->query($sqlidazlea);
										if (!$idazleaerantzuna) {
											echo 'ezin izan dira idazleak kargatu: ' . $esteka->error;
											exit;
										}
										echo '<select  name="idazlea" id="idazlea" form="liburuBerria">';
										while ($idalea =  mysqli_fetch_array($idazleaerantzuna,MYSQLI_ASSOC)){
											echo '<option value='.$idalea['kodea'].'>'.$idalea['izena'].'</option>';
										}
										echo '</select>';
										mysqli_close($esteka);
									?>
									<!--Botoia klikatzerakoan, JQUERY funtzioak idazleBerria.php-ri deia egingo dio eta emaitza idazleBerria div-ean kargatuko du-->
									<input type="button"  id="idazleBerriabtn"  class="actionbtn" href="#" value="Idazle berria"/>
									<div id="idazleBerria" class="subkarratua">
									</div>
									<p>
									<label><b>HIZKUNTZA</b></label>
									<select  name="hizkuntza" id="hizkuntza" form="liburuBerria">
										<option value="EU">EUSKERA</option>
										<option value="ERD">ERDARA</option>
										<option value="ING">INGELESA</option>
										<option value="BEST">BESTERIK</option>
									</select>
									<p>
									<label><b>ARGITALETXEA</b></label>
									<input type="text" placeholder="Argitaletxea" name="argitaletxea" id="argitaletxea" form="liburuBerria">
									<p>
									<label><b>SINOPSIA</b></label>
									<textarea type="text" placeholder="Idatzi hemen liburuaren sinopsia..." name="sinopsia" id="sinopsia" rows="7"  form="liburuBerria"></textarea>
									<p>
									<label><b>URTEA</b></label>
									<input type="text" placeholder="Urtea" name="urtea" id="urtea" form="liburuBerria">
									<p>
									<label><b>STOCK-A</b></label>
									<input type="text" placeholder="Stocka" name="stock" id="stock" form="liburuBerria">
									<p>
									<label><b>ARGAZKIA</b></label>
									<input type="file" id="argazkia" name="argazkia" form="liburuBerria">
									<p>
									<p>
									<p>
									<button type="submit" class="submitbtn" form="liburuBerria">Gorde</button>

							</div>
	<?php
			}else{
					header("Location: erregistratu.php");
			}
		}else{
				header("Location: erregistratu.php");
		}


	?>
    </body>
</html>
