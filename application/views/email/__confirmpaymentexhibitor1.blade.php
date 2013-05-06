<?php 
	setlocale(LC_MONETARY, "en_US");
	$subtotalall = $data['electricsubtotal']+$data['phonesubtotal']+ $data['addboothsubtotal']+ $data['advertsubtotal']+$data['furnituresubtotal']+ $data['internetsubtotal']+ $data['kiosksubtotal'];
	$lateorderfee = 0;
	$onsitefee = 0;
	$ppn = (10 * $subtotalall)/100;
	$grandtotal = $subtotalall+$lateorderfee+$onsitefee+$ppn;
?>
<div style="width:100%;position:relative;display:block;font-family:Helvetica,Arial,Sans-serif;font-size:13px;">
	<div style="width:100%;position:relative;display:block;">
		<div style="position:relative;display:inline-block;float:left;margin:0 30px 20px 0;"><img src="http://localhost/eventreg/public/images/ipa-logo.jpg"></div>
		<div style="width:80%;position:relative;display:inline-block;float:left;">
			<h2 style="display:inline-block;margin:15px 0 0 7px;">CONFIRMATION OF OPERATIONAL FORM #1</h2><br/>
			<h3 style="display:inline-block;margin:0 0 0 4px;">THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3><br/>
			<h5 style="display:inline-block;margin:0 0 0 4px;">JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block;float:left;">
		
		<div style="width:30%;position:relative;display:inline-block;float:left;">
			Company PIC
			
		</div>
		<div style="width:40%;position:relative;display:inline-block;float:left;">
			<table style="font-size:12px;margin-top:20px;">
			<tr style="vertical-align: top;">
				<td>
				<strong>Name</strong>
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
				
			</tr>

			<tr style="vertical-align: top;margin:10px 0;">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>

			<tr style="vertical-align: top;">
				<td><strong>Telephone</strong></td>
				<td>:</td>
				<td>{{ $user['companyphonecountry']}}-{{ $user['companyphonearea']}}-{{ $user['companyphone']}}</td>
			</tr>
			<tr style="vertical-align: top;margin:10px 0;">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr style="vertical-align: top;">
				<td><strong>Fax</strong></td>
				<td>:</td>
				<td>{{ $user['companyfaxcountry']}}-{{ $user['companyfaxarea']}}-{{ $user['companyfax']}}</td>
			</tr>

			</table>
		</div>

		<div style="width:30%;position:relative;display:inline-block;float:left;text-align:right;">
			<h4>{{ $user['registrationnumber']}}</h4>
		</div>
	</div>

	<div style="clear:both;"></div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000; margin-top:15px; background-color:#6c6c6c;color:#fff;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>FORMS</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;text-align:center;">
				<strong>Filled (Y/N)</strong>
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:center;">
				<strong>Sub-Total (US$)</strong>
			</div>
		</div>
	</div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;margin-top:15px;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Electricity Instalation</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['electricsubtotal']!='' && $data['electricsubtotal']!=0)
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php
				if($data['electricsubtotal']!= 0 && $data['electricsubtotal']!= ''):
					echo number_format($data['electricsubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Telephone Instalation</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['phonesubtotal']!=0 && $data['phonesubtotal']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php
				if($data['phonesubtotal']!=0 && $data['phonesubtotal']!=''):
					echo number_format($data['phonesubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Booth Contractor (special design)</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['companyContractor']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Fascia Name (standard stand)</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['fascianame']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Free Exhibitor Pass</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['freepassname1']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Booth Assistant Pass</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['boothassistant1']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Additional Booth Assistant(s) pass</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['addboothsubtotal']!=0 && $data['addboothsubtotal']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php
				if($data['addboothsubtotal']!=0 && $data['addboothsubtotal']!=''):
					echo number_format($data['addboothsubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Booth Program Schedule</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if ($data['programdetail1']!=0 || $data['programdetail1']!='' || $data['cocktaildetail1']!=0 || $data['cocktaildetail1']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Advertising</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['advertsubtotal']!=0 && $data['advertsubtotal']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php
				if($data['advertsubtotal']!=0 && $data['advertsubtotal']!=''):
					echo number_format($data['advertsubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Furniture Rental</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if( $data['furnituresubtotal']!='' && $data['furnituresubtotal']!=0)
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php
				if($data['furnituresubtotal']!='' && $data['furnituresubtotal']!=0):
					echo number_format($data['furnituresubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Internet Connection</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if ($data['internetsubtotal']!=0 && $data['internetsubtotal']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php 
				if ($data['internetsubtotal']!=0 && $data['internetsubtotal']!=''):
					echo number_format($data['internetsubtotal'], 2, ',', ' ');
				endif;?>
			</div>
		</div>
	</div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;">

		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Kiosk Rental</strong>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				@if ($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!='')
					<strong>Y</strong>
				@else
					<strong>N</strong>
				@endif
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;text-align:right;">
				<span style="float:left;">USD</span><?php if($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!=''):
					echo number_format($data['kiosksubtotal'], 2, ',', ' ');
					endif;?>
			</div>
		</div>
	</div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;line-height:30px;">
			<div style="width:40%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<strong>TOTAL</strong><br/>
				<strong>&nbsp;</strong><br/>
				<strong>&nbsp;</strong><br/>
				<strong>&nbsp;</strong><br/>
			</div>
			<div style="width:30%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<span>&nbsp;</span><br/>
				Late Order Surcharge 30%<br/>
				On-Site Order Surcharge 50%<br/>
				PPn (VAT) Tax 10%

				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;text-align:right;">

				<span style="float:left;">USD</span>{{ number_format($subtotalall, 2, ',', ' ') }}<br/>
				<div style="clear:both"></div>
				<span style="float:left;">USD</span>{{ number_format($lateorderfee, 2, ',', ' ') }}<br/>
				<div style="clear:both"></div>
				<span style="float:left;">USD</span>{{ number_format($onsitefee, 2, ',', ' ') }}<br/>
				<div style="clear:both"></div>
				<span style="float:left;">USD</span>{{ number_format($ppn, 2, ',', ' ') }}
				
			</div>
		</div>
	</div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:40%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<strong>TOTAL PAYMENT</strong><br/>
			</div>
			<div style="width:30%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">

				&nbsp;
				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;text-align:right;">

				<strong><span style="float:left;">USD</span>{{ number_format($grandtotal, 2, ',', ' ') }}</strong>
				
				
			</div>
		</div>
	</div>

	<br/>
	<br/>
	<div style="width:100%;position:relative;display:block; float:left;margin:20px 0 30px 0;">
		INVOICE ISSUED DATE : <?php echo date('l jS F Y');?>
		
	</div>

	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block; float:left;margin:20px 0 30px 0;">
		<ul style="display: block; list-style-type: disc; margin: 0 0 0 0;-webkit-padding-start: 20px;">
			<li style="padding:5px 0 0 0;"> -  PLEASE CHECK AGAIN IF THIS RECIEPT IS MATCH YOUR NEEDS</li>
			<li style="padding:5px 0 0 0;"> -  PLEASE SIGNED THIS CONFIRMATION LETTER AND SEND IT BACK TO THE ORGANIZER</li>
			<li style="padding:5px 0 0 0;">  - AFTER WE RECEIVE THE CONFIRMATION LETTER, WE WILL SEND YOU THE INVOICE</li>
		</ul>
		
	</div>

</div>