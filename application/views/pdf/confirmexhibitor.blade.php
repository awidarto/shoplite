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
#header{
	margin-top: -50px;
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
#terms{
	margin-bottom: 15px;
}
#signature-table{
	position:relative;
	margin-top: 10px;
	
}
.namesignature{
	
	text-align:center;
	margin-right:10px;
	
}
.linesignature{
	border-bottom:4px solid #000000;"
}
.brown{
	color:#bfbfbf;
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
	$freepasscount = 0;
	$boothassistantcount = 0;


	$booths = new Booth();
	
	
	$booth = '';


	if(isset($user['boothid'])){
		$_boothID = new MongoId($user['boothid']);
		$booth = $booths->get(array('_id'=>$_boothID));
	}

	$sizebooth = $booth['size'];

    /*if($sizebooth >= 9 && $sizebooth <= 18){
      $pass = 2;
    }else if($sizebooth >= 18 && $sizebooth <= 27){
      $pass = 4;
    }else if($sizebooth >= 27 && $sizebooth <= 36){
      $pass = 6;
    }else if($sizebooth >= 36 && $sizebooth <= 45){
      $pass = 8;
    }else if($sizebooth >= 45){
      $pass = 10;
    }else{
      $pass = 10;
    }*/
    $pass = $booth['freepassslot'];

    //count freepass
    for($i=1;$i<$pass+1;$i++){
    	if($data['freepassname'.$i.'']!=''){
			$freepasscount++;
		}
    }


	for($i=1;$i<11;$i++){
		if($data['boothassistant'.$i.'']!=''){
			$boothassistantcount++;
		}
	}
?>

	<table id="header">
		<tr>
			<td rowspan="3" id="logo"><img src="http://www.ipaconvex.com/images/ipa-logo.jpg"></td>
		</tr>
		<tr colspan="15">
			<td>
				<h2>CONFIRMATION OF OPERATIONAL FORMS</h2>
				<h3>THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3>
				<h5>JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
			</td>
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
			<td>Electricity Installation</td>
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
					if($data['electricsubtotal']!= 0 && $data['electricsubtotal']!= ''):
						$toprint .= '1&nbsp;&nbsp; x &nbsp;&nbsp;Installation fee&nbsp;&nbsp; = &nbsp;&nbsp;$ 23<br/>';
					endif;
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span class="floatleft">USD </span>
				<?php
				if($data['electricsubtotal']!= 0 && $data['electricsubtotal']!= ''):
					echo money_format(" %!n ", $data['electricsubtotal']);
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
					echo money_format(" %!n ", $data['phonesubtotal']);
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
				Exhibitor Pass (FREE)
			</td>
			<td class="aligncenter">
				@if( $data['freepassname1']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				if( $freepasscount!=0){
					
					$toprint = $freepasscount.'&nbsp;&nbsp; Exhibitor Pass (FREE) Registered <br/>';
					
					echo $toprint;

				}
				?>
			</td>
			<td>&nbsp;</td>
		</tr>
	
	

		<tr class="contentrow odd">
			<td>
				Additional Exhibitor Pass (FREE)
			</td>
			<td class="aligncenter">
				@if( $data['boothassistant1']!='')
					Y
				@else
					N
				@endif
			</td>

			<td class="detailsitem">
				<?php
				if( $boothassistantcount!=0){
					
					$toprint = $boothassistantcount.'&nbsp;&nbsp; Additional Exhibitor Pass (FREE) Registered <br/>';
					
					echo $toprint;

				}
				?>
			</td>
			<td>&nbsp;</td>
		</tr>
	
		<tr class="contentrow">
			<td>
				Additional Exhibitor Pass (PAYABLE)
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
					echo money_format(" %!n ", $data['addboothsubtotal']);
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
				@if( $data['advertgrandtotal']!=0 && $data['advertgrandtotal']!='')
					Y
				@else
					N
				@endif
			</td>
			<td class="detailsitem">
				<?php
				
				if( $data['advertgrandtotal']!=''&& $data['advertgrandtotal']!=0){

					$toprint = $data['advert'].'&nbsp;&nbsp; x &nbsp;&nbsp;Hanging Banner Above the booth = &nbsp;&nbsp;$ '.$data['rowadvert'].'<br/>';
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php
				if($data['advertgrandtotal']!=0 && $data['advertgrandtotal']!=''):
					echo money_format(" %!n ", $data['advertgrandtotal']);
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
					echo money_format(" %!n ", $data['furnituresubtotal']);
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
					echo money_format(" %!n ", $data['internetsubtotal']);
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
							$toprint .= $data['kiosk'.$m.''].'&nbsp;&nbsp; x &nbsp;&nbsp;'.$details[$i].'&nbsp;&nbsp;= &nbsp;&nbsp;$ 480<br/>';

						}
					}
					echo $toprint;

				}
				?>
			</td>
			<td class="alignright">
				<span style="float:left;">USD </span><?php if($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!=''):
					echo money_format(" %!n ", $data['kiosksubtotal']);
					endif;?>
			</td>
		</tr>

		

		<tr class="contentrow">
			<td colspan="3">
				<strong>TOTAL PAYMENT</strong><br/>
			</td>
			
			<td class="alignright">
				<strong><span style="float:left;">USD </span>{{ money_format(" %!n ", $subtotalall) }}</strong>
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
	
	<div id="terms">
		<ul >
			<li > - Please check again if this reciept is match your needs</li>
			<li > - Please print the form, sign and email this form to your Hall Coordinator</li>
			<li > - After we receive the confirmation letter, we will send you the invoice</li>
		</ul>
		
	</div>
	<div class="clear"></div>
	
	<table id="signature-table">
		<tr>
			<td class="namesignature">Exhibitor,</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="namesignature">Co-organizer,</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="linesignature">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="linesignature">&nbsp;</td>
		</tr>

		<tr>
			<td class="brown">Name, Signature, & Company Stamp</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>DYANDRA PROMOSINDO</td>
		</tr>

	</table>



</body>
</html>
