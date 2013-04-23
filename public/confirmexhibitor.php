<html>
<head>
<style>

body{
	font-size: 100%;
	font-family: 'Verdana','Helvetica','Arial',serif;
}
.row{
	width: 100%;
	position: relative;
	font-size:12px;
}
#header h2,#header h3,#header h5{
	margin:0;
	padding:0;
}
#header h2{
	font-size: 17px;
	margin-top: 6px;
}
#header h3{
	font-size: 15px;	
}
#header h5{
		font-size: 12px;	
}

</style>
</head>

<body>
<?php 
	setlocale(LC_MONETARY, "en_US");
	$subtotalall = $data['electricsubtotal']+$data['phonesubtotal']+ $data['addboothsubtotal']+ $data['advertsubtotal']+$data['furnituresubtotal']+ $data['internetsubtotal']+ $data['kiosksubtotal'];
	$lateorderfee = 0;
	$onsitefee = 0;
	$ppn = (10 * $subtotalall)/100;
	$grandtotal = $subtotalall+$lateorderfee+$onsitefee+$ppn;
?>

	<table id="header">
		<tr>
			<td rowspan="3"><img src="http://localhost/eventreg/public/images/ipa-logo.jpg"></td>
		</tr>
		<tr>
			<td><h2>CONFIRMATION OF OPERATIONAL FORMS</h2>
			<h3 >THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3>
			<h5>JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</tr>
			
		
		
	</table>
	<div style="clear:both;"></div>
	<div >
		
		<div >
			Company PIC
			
		</div>
		<div >
			<table>
			<tr >
				<td>
				<strong>Name</strong>
				</td>
				<td>:</td>
				<td>Mr. Taufiq Ridha<br/>
					PIC Booth<br/>
					Kickstart<br/>
					Jl. Tali 2 Rt.007/08 no.5,<br/>
					Kota bambu selatan palmerah jakarta barat,<br/>
					Jakarta - 11480<br/>
					Indonesia<br/>
				</td>
				
			</tr>

			<tr >
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>

			<tr >
				<td><strong>Telephone</strong></td>
				<td>:</td>
				<td>6283899008178-838-99008178</td>
			</tr>
			<tr >
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><strong>Fax</strong></td>
				<td>:</td>
				<td>3456-345-34567</td>
			</tr>

			</table>
		</div>

		<div>
			<h4>E-EXH-00-000003</h4>
		</div>
	</div>

	<div class="clear"></div>

	<div>

		<div >
			<div>
				<strong>FORMS</strong><br/>
			</div>
			<div >
				<strong>Filled (Y/N)</strong>
			</div>

			<div>
				<strong>Sub-Total (US$)</strong>
			</div>
		</div>
	</div>

	<div >

		<div>
			<div >
				<strong>Electricity Instalation</strong>
			</div>
			<div>
				
					<strong>Y</strong>
				
			</div>

			<div >
				<span>USD</span><?php
				
					echo number_format(2500, 2, ',', ' ');
				?>
			</div>
		</div>
	</div>
	<div >

		<div>
			<div>
				<strong>Telephone Instalation</strong>
			</div>
			<div>
				
					<strong>N</strong>
				
			</div>

			<div>
				<span>USD</span><?php
				
					echo number_format(2250, 2, ',', ' ');
				?>
			</div>
		</div>
	</div>
	

	<div ></div>
	<div >
		<ul >
			<li > -  PLEASE CHECK AGAIN IF THIS RECIEPT IS MATCH YOUR NEEDS</li>
			<li > -  PLEASE SIGNED THIS CONFIRMATION LETTER AND SEND IT BACK TO THE ORGANIZER</li>
			<li >  - AFTER WE RECEIVE THE CONFIRMATION LETTER, WE WILL SEND YOU THE INVOICE</li>
		</ul>
		
	</div>



</body>
</html>
