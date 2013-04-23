
<div style="width:100%;position:relative;display:block;font-family:Helvetica,Arial,Sans-serif;font-size:13px;">
	<div style="width:100%;position:relative;display:block;">
		<div style="position:relative;display:inline-block;float:left;margin:0 30px 20px 0;"><img src="http://www.ipaconvex.com/images/ipa-logo.jpg"></div>
		<div style="width:80%;position:relative;display:inline-block;float:left;">
			<h2 style="display:inline-block;margin:15px 0 0 7px;">CONFIRMATION OF REGISTRATION (GOLF)</h2><br/>
			<h3 style="display:inline-block;margin:0 0 0 4px;">THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3><br/>
			<h5 style="display:inline-block;margin:0 0 0 4px;">JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block;float:left;">
		
		<div style="width:30%;position:relative;display:inline-block;float:left;">
			@if($data['regtype'] == 'PD' || $data['regtype'] == 'PO')
				<h4>DELEGATE</h4>
			@else
				<h4>STUDENT</h4>
			@endif
			
		</div>
		<div style="width:40%;position:relative;display:inline-block;float:left;">
			<table style="font-size:12px;margin-top:20px;">
			<tr style="vertical-align: top;">
				<td>
				<strong>Name</strong>
				</td>
				<td>:</td>
				<td>{{ $data['salutation']}}. {{ $data['firstname'].' '.$data['lastname'] }}<br/>
					{{ $data['position']}}<br/>
					{{ $data['company']}}<br/>
					{{ $data['address_1']}},<br/>
					{{ $data['address_2']}},<br/>
					{{ $data['city']}} - {{ $data['zip']}}<br/>
					{{ $data['country']}}<br/>
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
				<td>{{ $data['companyphonecountry']}}-{{ $data['companyphonearea']}}-{{ $data['companyphone']}}</td>
			</tr>
			<tr style="vertical-align: top;margin:10px 0;">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr style="vertical-align: top;">
				<td><strong>Fax</strong></td>
				<td>:</td>
				<td>{{ $data['companyfaxcountry']}}-{{ $data['companyfaxarea']}}-{{ $data['companyfax']}}</td>
			</tr>

			</table>
		</div>

		<div style="width:30%;position:relative;display:inline-block;float:left;text-align:right;">
			<h4>{{ $data['registrationnumber']}}</h4>
		</div>
	</div>

	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000; margin-top:15px;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>GOLF TOURNAMENT</strong><br/>
				<span>Pondok Indah Golf</span>
				<span>(12 May 2013)</span>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">2.500.000</span>
				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				
			</div>
		</div>
	</div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<strong>TOTAL PAYMENT</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">2.500.000</span>
				


				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;">

				
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>

				
			</div>
		</div>
	</div>

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong style="width:60%;position:relative;display:block;float:left;">PAYMENT RECEIVED</strong>
				<span style="width:40%;position:relative;display:block;float:left;"><?php echo date('l jS F Y');?></span>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<span style="width:50%;position:relative;display:block;float:left;">&nbsp;</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				<span style="width:50%;position:relative;display:block;float:left;">&nbsp;</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
			</div>
		</div>
	</div>


	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<strong>TOTAL PAYMENT DUE</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">2.500.000</span>

			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				

				
			</div>
		</div>
	</div>


	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;margin-bottom:20px;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:right;">
				<strong>BALANCE DUE</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				
				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				
				
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block; float:left;margin:20px 0 30px 0;">
		<ul style="display: block; list-style-type: disc; margin: 0 0 0 0;-webkit-padding-start: 20px;">
			<li style="padding:5px 0 0 0;">PLEASE REGARD THIS SLIP AS AN OFFICIAL RECEIPT</li>
			<li style="padding:5px 0 0 0;">PLEASE TAKE THIS SLIP TO THE REGISTRATION DESK TO OBTAIN YOUR ID BADGE & CONVENTION KITS</li>
			<li style="padding:5px 0 0 0;">REGISTRATION WILL START AT <strong>10:00 - 15:00 HOURS ON 13-14 MAY 2013 AND AT 08:00 - 15:00 HOURS ON 15-17 MAY 2013 (AT JCC REGISTRATION COUNTER)</strong></li>
			<li style="padding:5px 0 0 0;">PLEASE CHECK THE SPELLING OF YOUR NAME, AS THIS IS HOW IT WILL APPEAR ON YOUR BADGE.  IF THERE ARE ANY ERRORS, PLEASE MAKE THE CORRECTIONS ONTO THIS PAGE AND FAX BACK TO (62-21) 31997176</li>
			<li style="padding:5px 0 0 0;"><strong>NO REFUND</strong>WILL BE GRANTED FOR <strong>CANCELLATION AFTER 14 APRIL 2013</strong></li>
			<li style="padding:5px 0 0 0;">PLEASE CHECK YOUR NAME ON THIS RECEIPT AS THIS WILL BE USED FOR YOUR ID BADGE</li>
		</ul>
		
	</div>

</div>

