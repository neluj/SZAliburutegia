
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML>
	<head>
	<script src="https://code.jquery.com/jquery-2.2.4.js">	</script>
	<script>
		function info(isbn){
				window.location.href= ("liburuaInfo.php?isbn="+isbn);
		}

		function editatu(isbn){
				window.location.href= ("liburuKudeaketa.php?isbn="+isbn);
		}

		function ezabatu(isbn){
				window.location.href= ("liburuaEzabatu.php?isbn="+isbn);
		}
	</script>
	<script type="text/javascript">
		//Liburua alokatzean fitxategiak mezu bat bidaliko du eragiketa egin eta gero.
		//Arazorik baldinbadago, mezua botien azpian inprimatuko du.Bestela, "OK" itzuliko
		//du eta erabiltzaile panelera bidaliko du alokatutako liburuak ikustera.
		xhttp = new XMLHttpRequest();
		function alokatu(isbn){
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState==4){
					if(xhttp.status==200){
						if(xhttp.responseText=="OK"){
							window.location.href= ("erabiltzailePanela.php");
						}else{
							document.getElementById("mezua"+isbn).innerHTML=xhttp.responseText;
						}
					}
				}
			}
			xhttp.open("GET","liburuaAlokatu.php?isbn="+isbn, true);
			xhttp.send();

		}

	</script>

	</head>
	<BODY>

		<TABLE>
			<THEAD><TR><TH>ISBN</TH><TH>IZENBURUA</TH><TH>IDAZLEA</TH><TH>HIZKUNTZA</TH><TH>ARGITALETXEA</TH><TH>URTEA</TH><TH>STOCK</TH><TH>AUKERAK</TH></TR></THEAD>
			<xsl:for-each select="/liburutegia/liburua" >
			<TR>
				<TD>
					<xsl:value-of select="@isbn"/><BR/>
				</TD>
				<TD>
					<xsl:value-of select="izenburua"/> <BR/>
				</TD>
				<TD>
				<a href="idazleaInfo.php?kod={@idazleKodea}">
				  <xsl:value-of select="idazleIzena" /><BR/>
				</a>
				</TD>
				<TD>
					<xsl:value-of select="@hizkuntza"/><BR/>
				</TD>
				<TD>
					<xsl:value-of select="argitaletxea"/> <BR/>
				</TD>
				<TD>
					<xsl:value-of select="urtea"/> <BR/>
				</TD>
				<TD>
					<xsl:value-of select="stock"/> <BR/>
				</TD>
				<TD>
				<!--Erabiltzaile guztiek ikusi ahal izango dute liburuan informazioa -->
				<button type="button"  id="liburuaInfobtn"  class="infobtn" onclick="info({@isbn});" >INFO</button>
				<!--Erabiltzaile motaren arabera, aukera desberdinak izango ditu:
					-BAZKIDEA:Liburuak alokatu ahal izango ditu
					-LANGILEA:Liburuak kudeatu ahal izango ditu (editatu edo ezabatu)-->
				<?php
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						if($_SESSION['mota']=='BAZKIDEA'){
							echo '<button type="button"  id="liburuaAlokatubtn"  class="alokatubtn" onclick="alokatu({@isbn});" >ALOKATU</button>';
						}
						else if($_SESSION['mota']=='LANGILEA'){
							echo '<button type="button"  id="liburuaAlokatubtn"  class="alokatubtn" onclick="editatu({@isbn});" >EDITATU</button>';
							echo '<button type="button"  id="liburuaAlokatubtn"  class="cancelbtn" onclick="ezabatu({@isbn});" >EZABATU</button>';
						}
				}
				?>
				<div id="mezua{@isbn}" class="erroreMezua"></div>
				</TD>
			</TR>
			</xsl:for-each>
		</TABLE>
	</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>
