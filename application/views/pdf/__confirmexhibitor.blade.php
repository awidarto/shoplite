<html>
<head>
<style type="text/css">

body{
	font-size: 11px;
	font-family: 'Verdana','Helvetica','Arial',serif;
}
.row{
	width: 100%;
	position: relative;
	font-size:12px;
}
#logo{
	width:130px;
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
.big{
	width:200px;
}
.aligntop{
	vertical-align: top;
}
.alignright{
	text-align: right;
}
.aligncenter{
	text-align: center;
}
hr{
	background-color: #d2d2d2;
	color: #d2d2d2;
	margin:0 0 15px 0;
}
.headrow td{
	background-color:#a8a8a8; 
	padding:20px;
	color: #fff;
	margin:0;
}
.bigheader{
	width: 180px;
}
.detailheader{
	width: 210px;
}
#detail-request{
	margin-top: 15px;
}
.floatleft{
	float: left;
	text-align: left;
}
.contentrow td{
	padding:8px;
	margin:0;

}
.odd td{
	background-color: #dadada;
}
td.detailsitem{
	color: #4a4a4a;
	font-size: 10px;
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
			<td rowspan="3" id="logo"><img src="http://localhost/eventreg/public/images/ipa-logo.jpg"></td>
		</tr>
		<tr colspan="15">
			<td><h2>CONFIRMATION OF OPERATIONAL FORMS</h2>
			<h3 >THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3>
			<h5>JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</tr>
		
	</table>
	<hr/>
	<table id="personalinfo">
		<tr>
			<td class="big aligntop">
				Company PIC
			</td>
			<td class="aligntop">
			Name
			</td>
			<td>:</td>
			<td>{{ $user['salutation']}}. {{ $user['firstname'].' '.$user['lastname'] }}<br/>
				{{ $user['position']}}<br/>
				{{ $user['company']}}<br/>
				{{ $user['address_1']}},<br/>
				{{ $user['address_2']}},<br/>
				{{ $user['city']}} - {{ $user['zip']}}<br/>
				{{ $user['country']}}<br/>
			</td>
			<td class="big aligntop alignright">{{ $user['registrationnumber']}}</td>
		</tr>

		<tr >
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr >
			<td>&nbsp;</td>
			<td>Telephone</td>
			<td>:</td>
			<td>{{ $user['companyphonecountry']}}-{{ $user['companyphonearea']}}-{{ $user['companyphone']}}</td>
			<td>&nbsp;</td>
		</tr>
		<tr >
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Fax</td>
			<td>:</td>
			<td>{{ $user['companyfaxcountry']}}-{{ $user['companyfaxarea']}}-{{ $user['companyfax']}}</td>
			<td>&nbsp;</td>
		</tr>

	</table>
	

	<div class="clear"></div>

	<table id="detail-request">
		<tr class="headrow">
			<td class="bigheader">FORMS</td>
			<td>Filled (Y/N)</td>
			<td class="detailheader">Details</td>
			<td>Sub-Total (US$)</td>
		</tr>
		<tr class="contentrow">
			<td>Electricity Instalation</td>
			<td class="aligncenter">
				@if( $data['electricsubtotal']!='' && $data['electricsubtotal']!=0)
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['electricsubtotal']!=''&& $data['electricsubtotal']!=0){
					
					$i = -1;
					$m = 0;
					$toprint='';
					$details = Config::get('eventreg.electriclist');
					for($n=0;$n<=8;$n++){
						$i++;
						$m++;
						
						if($data['electric'.$m.''] !='' && $data['electric'.$m.''] !=0){
							$toprint .= $data['electric'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp; = &nbsp;&nbsp;$ '.$data['rowelectric'.$m.''].'<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span class="floatleft">USD </span>
				<?php
				if($data['electricsubtotal']!= 0 && $data['electricsubtotal']!= ''):
					echo number_format($data['electricsubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>

		<tr class="contentrow odd">
			<td>Telephone Instalation</td>
			<td class="aligncenter">
				@if( $data['phonesubtotal']!='' && $data['phonesubtotal']!=0)
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['phonesubtotal']!=''&& $data['phonesubtotal']!=0){
					$i = -1;
					$m = 0;
					$toprint='';
					$details = Config::get('eventreg.phonelist');
					for($n=0;$n<=1;$n++){
						$i++;
						$m++;
						//$toprint2 .= $details2[$i];
						//$type.$i = $data['electric'.$i];
						//$rowtotal.$i = $data['rowelectric'.$i];
						if($data['phone'.$m.''] !='' && $data['phone'.$m.''] !=0){
							$toprint .= $data['phone'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp;= &nbsp;&nbsp;$ '.$data['rowphone'.$m.''].'<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span class="floatleft">USD </span>
				<?php
				if($data['phonesubtotal']!= 0 && $data['phonesubtotal']!= ''):
					echo number_format($data['phonesubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>

		<tr class="contentrow">
		
			<td>
				Booth Contractor (special design)
			</td>
			<td class="aligncenter">
				@if( $data['companyContractor']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr class="contentrow odd">
			<td>
				Fascia Name (standard stand)
			</td>
			<td class="aligncenter">
				@if( $data['fascianame']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">{{ isset($data['fascianame'])?$data['fascianame']:'' }}</td>
			<td>&nbsp;</td>
		</tr>
	
		<tr class="contentrow">
			<td>
				Free Exhibitor Pass
			</td>
			<td class="aligncenter">
				@if( $data['freepassname1']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	
	

		<tr class="contentrow odd">
			<td>
				Booth Assistant Pass
			</td>
			<td class="aligncenter">
				@if( $data['boothassistant1']!='')
					Y
				@else
					N
				@endif
			</td>

			<td class="detailsitem">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	
		<tr class="contentrow">
			<td>
				Additional Booth Assistant(s) pass
			</td>
			<td class="aligncenter">
				@if( $data['addboothsubtotal']!=0 && $data['addboothsubtotal']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['addboothsubtotal']!=''&& $data['addboothsubtotal']!=0){
					
					$toprint = $data['totaladdbooth'].'&nbsp;&nbsp; x &nbsp;&nbsp; Additional Booth = &nbsp;&nbsp;$ '.$data['addboothsubtotal'].'<br/>';
					
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php
				if($data['addboothsubtotal']!=0 && $data['addboothsubtotal']!=''):
					echo number_format($data['addboothsubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>
		

		<tr class="contentrow odd">
			<td>
				Booth Program Schedule
			</td>
			<td class="aligncenter">
				@if ($data['programdetail1']!=0 || $data['programdetail1']!='' || $data['cocktaildetail1']!=0 || $data['cocktaildetail1']!='')
					Y
				@else
					N
				@endif
			</td>

			<td class="detailsitem"></td>
			<td>&nbsp;</td>
		</tr>
	
	

		<tr class="contentrow">
			<td>
				Advertising
			</td>
			<td class="aligncenter">
				@if( $data['advertsubtotal']!=0 && $data['advertsubtotal']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['advertsubtotal']!=''&& $data['advertsubtotal']!=0){

					$toprint = $data['advert'].'&nbsp;&nbsp; x &nbsp;&nbsp;Hanging Banner Above the booth = &nbsp;&nbsp;$ '.$data['rowadvert'].'<br/>';
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php
				if($data['advertsubtotal']!=0 && $data['advertsubtotal']!=''):
					echo number_format($data['advertsubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>

		<tr class="contentrow odd">
			<td>
				Furniture Rental
			</td>
			<td class="aligncenter">
				@if( $data['furnituresubtotal']!='' && $data['furnituresubtotal']!=0)
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['furnituresubtotal']!=''&& $data['furnituresubtotal']!=0){
					$i = -1;
					$m = 0;
					$toprint='';
					$details = Config::get('eventreg.furniturelist');
					for($n=0;$n<=5;$n++){
						$i++;
						$m++;
						//$toprint2 .= $details2[$i];
						//$type.$i = $data['electric'.$i];
						//$rowtotal.$i = $data['rowelectric'.$i];
						if($data['furniture'.$m.''] !='' && $data['furniture'.$m.''] !=0){
							$toprint .= $data['furniture'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp;= &nbsp;&nbsp;$ '.$data['rowfurniture'.$m.''].'<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php
				if($data['furnituresubtotal']!='' && $data['furnituresubtotal']!=0):
					echo number_format($data['furnituresubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>

		<tr class="contentrow">
			<td>
				Internet Connection
			</td>
			<td class="aligncenter">
				@if ($data['internetsubtotal']!=0 && $data['internetsubtotal']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['internetsubtotal']!=''&& $data['internetsubtotal']!=0){
					$i = -1;
					$m = 0;
					$toprint='';
					$details = Config::get('eventreg.internetlist');
					for($n=0;$n<=1;$n++){
						$i++;
						$m++;
						//$toprint2 .= $details2[$i];
						//$type.$i = $data['electric'.$i];
						//$rowtotal.$i = $data['rowelectric'.$i];
						if($data['internet'.$m.''] !='' && $data['internet'.$m.''] !=0){
							$toprint .= $data['internet'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp;= &nbsp;&nbsp;$ '.$data['rowinternet'.$m.''].'<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php 
				if ($data['internetsubtotal']!=0 && $data['internetsubtotal']!=''):
					echo number_format($data['internetsubtotal'], 2, ',', ' ');
				endif;?>
			</td>
		</tr>
	
		<tr class="contentrow odd">
			<td>
				Kiosk Rental
			</td>
			<td class="aligncenter">
				@if ($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['kiosksubtotal']!=''&& $data['kiosksubtotal']!=0){
					$i = -1;
					$m = 0;
					$toprint='';
					$details = Config::get('eventreg.kiosklist');
					for($n=0;$n<=1;$n++){
						$i++;
						$m++;
						if($data['kiosk'.$m.''] !='' && $data['kiosk'.$m.''] !=0){
							$toprint .= $data['kiosk'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp;= &nbsp;&nbsp;$ '.$data['rowkiosk'].'<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php if($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!=''):
					echo number_format($data['kiosksubtotal'], 2, ',', ' ');
					endif;?>
			</td>
		</tr>

		<tr class="contentrow">
			<td colspan="3">
				Total
			</td>
			
			<td class="alignright">
				<span style="float:left;">USD </span>{{ number_format($subtotalall, 2, ',', ' ') }}
			</td>
		</tr>

		<tr class="contentrow odd" style="line-height:20px;">
			<td colspan="3" class="alignright">
				Late Order Surcharge 30%<br/>
				On-Site Order Surcharge 50%<br/>
				PPn (VAT) Tax 10%
			</td>
			
			<td class="alignright" style="line-height:20px;">
				USD &nbsp;{{ number_format($lateorderfee, 2, ',', ' ') }}<br/>
				
				USD &nbsp;{{ number_format($onsitefee, 2, ',', ' ') }}<br/>
				
				USD &nbsp;{{ number_format($ppn, 2, ',', ' ') }}
			</td>
		</tr>

		<tr class="contentrow">
			<td colspan="3">
				<strong>TOTAL PAYMENT</strong><br/>
			</td>
			
			<td class="alignright">
				<strong><span style="float:left;">USD </span>{{ number_format($grandtotal, 2, ',', ' ') }}</strong>
			</td>
		</tr>

		<tr class="contentrow">
			<td colspan="3">
				&nbsp;
			</td>
			
			<td class="alignright">
				&nbsp;
			</td>
		</tr>
		
		<tr class="contentrow">
			<td colspan="3">
				INVOICE ISSUED DATE : <?php echo date('l jS F Y');?>
			</td>
			
			<td class="alignright">
				&nbsp;
			</td>
		</tr>

	</table>
	
	<div >
		<ul >
			<li > -  PLEASE CHECK AGAIN IF THIS RECIEPT IS MATCH YOUR NEEDS</li>
			<li > -  PLEASE SIGNED THIS CONFIRMATION LETTER AND SEND IT BACK TO THE ORGANIZER</li>
			<li >  - AFTER WE RECEIVE THE CONFIRMATION LETTER, WE WILL SEND YOU THE INVOICE</li>
		</ul>
		
	</div>



</body>
</html>
