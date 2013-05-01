<?php

setlocale(LC_MONETARY, "en_US");
$golf = 2500000;

if($data['regtype'] == 'PD'){

	$feeregist = $data['regPD'];

	if($data['golf']=='Yes' && $data['golfPaymentStatus']!='cancel'){
		$vat = 0.1*($feeregist+$golf);
		$chargecc = (0.03*($feeregist+$golf+$vat))+2200;
	}else{
		$vat = 0.1*($feeregist);
		$chargecc = (0.03*($feeregist+$vat))+2200;
		
	}

	if($data['golf']=='Yes' && $data['golfPaymentStatus']!='cancel'){
	
		$total = $feeregist+$golf+$vat+$chargecc;
	
	}else{
		$total = $feeregist+$vat+$chargecc;
	
	}

}elseif($data['regtype'] == 'PO'){

	$feeregist = $data['regPO']*9800;

	if($data['golf']=='Yes' && $data['golfPaymentStatus']!='cancel'){
		
		$chargecc = (0.03*($feeregist+$golf))+2200;
	}else{

		$chargecc = (0.03*$feeregist)+2200;
	}

	if($data['golf']=='Yes' && $data['golfPaymentStatus']!='cancel'){
		$total = $feeregist+$golf+$chargecc;
	}else{
		$total = $feeregist+$chargecc;
	}

}elseif($data['regtype'] == 'SD'){

	$feeregist = $data['regSD'];
	
	$vat = 0.1*($feeregist);
	$chargecc = (0.03*($feeregist+$vat))+2200;
	
	$total = $feeregist+$vat+$chargecc;
	
	

}elseif($data['regtype'] == 'SO'){

	$feeregist = $data['regSO']*9800;

	
	$chargecc = (0.03*$feeregist)+2200;

	
	$total = $feeregist+$chargecc;
	
}

?>
<div style="width:100%;position:relative;display:block;font-family:Helvetica,Arial,Sans-serif;font-size:13px;">
	<div style="width:100%;position:relative;display:block;">
		<div style="position:relative;display:inline-block;float:left;margin:0 30px 20px 0;"><img src="http://www.ipaconvex.com/images/ipa-logo.jpg"></div>
		<div style="width:80%;position:relative;display:inline-block;float:left;">
			<h2 style="display:inline-block;margin:15px 0 0 7px;">RECEIPT</h2><br/>
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
				<strong>REGISTRATION FEES</strong><br/>
				@if($data['regtype'] == 'PD' || $data['regtype'] == 'SD')
					<span>Participant - Domestic</span>
				@else
					<span>Participant - International</span>
				@endif
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				
				<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">{{ formatrp ($feeregist) }}</span>
				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
				
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				
			</div>
		</div>
	</div>

	@if($data['golf']=='Yes' && $data['golfPaymentStatus']!='cancel')
		<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
			<div style="width:100%;position:relative;display:block;float:left;">
				<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
					<strong>GOLF TOURNAMENT</strong><br/>
				</div>
				<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
					
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">2.500.000,00</span>
					
				</div>

				<div style="width:20%;position:relative;display:block;float:left;height:40px;padding:10px;">
					
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
					
				</div>
			</div>
		</div>
	@endif

	@if($data['regtype'] == 'PD' || $data['regtype'] == 'SD')
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:20px;padding:10px;text-align:left;">
				<strong>VAT 10%</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:20px;padding:10px;">

				<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">{{ formatrp ($vat) }}</span>
				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:20px;padding:10px;">

				<span style="width:50%;position:relative;display:block;float:left;">USD</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				
				
			</div>
		</div>
	</div>
	@endif

	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				<strong>Payment Charges via Credit Card</strong><br/>
				<span>3% * Total payment + 2200 IDR</span>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:40px;padding:10px;">
				
				<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">{{ formatrp ($chargecc) }}</span>
				
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
				<span style="width:50%;position:relative;display:block;float:left;text-align:right;">{{ formatrp ($total) }}</span>
				
				
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


	
	<div style="clear:both;"></div>
	

</div>

