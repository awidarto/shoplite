<p>
<?php

setlocale(LC_MONETARY, "en_US");

//check date first
$dateA = date('Y-m-d G:i'); 

$earlybirddate = Config::get('eventreg.earlybirdconventiondate'); 
$conventionrate = Config::get('eventreg.conventionrate');
$golfrate = Config::get('eventreg.golffee');

//define first regtype

if(strtotime($dateA) > strtotime($earlybirddate)){
	if ($data['conventionPaymentStatus']=='free'){
		$PD_rate = 0;
		$PO_rate = 0;
		$SD_rate = 0;
		$SO_rate = 0;

	}elseif (isset($data['overrideratenormal']) && ($data['overrideratenormal']=='yes')) {
		$PD_rate = $conventionrate['PD-earlybird'];
		$PO_rate = $conventionrate['PO-earlybird'];
		$SD_rate = $conventionrate['SD'];
		$SO_rate = $conventionrate['SO'];
	}else{
		$PD_rate = $conventionrate['PD-normal'];
		$PO_rate = $conventionrate['PO-normal'];
		$SD_rate = $conventionrate['SD'];
		$SO_rate = $conventionrate['SO'];
	}
}else{

	$PD_rate = $conventionrate['PD-earlybird'];
	$PO_rate = $conventionrate['PO-earlybird'];
	$SD_rate = $conventionrate['SD'];
	$SO_rate = $conventionrate['SO'];
}

$totalIDRtax = 0.10*$data['totalIDR'];
$totalIDR = $data['totalIDR']+$totalIDRtax;

//$totalUSDtax = 0.10*$data['totalUSD'];
$totalUSD = $data['totalUSD'];

?>
<?php
	echo 'Jakarta, '.date('l jS F Y');
?>
</p>

<p>Attention to: <br/>
<strong>{{ $data['firstname'].' '.$data['lastname'] }}</strong><br/>
<strong>{{ $data['position'] }}</strong><br/>
<strong>{{ $data['company'] }}</strong><br/>
<strong>{{ $data['address_1'] }}</strong><br/>
{{ ($data['address_2'] == '')?'':'<strong>'.$data['address_2'].'</strong><br/>' }}
<strong>{{ $data['city'].' '.$data['zip'] }}</strong><br/>
<strong>Registration Number : {{ $data['registrationnumber'] }}</strong></p>

<p>Dear Sir/Madam,<br />
Thank you for registering to 37th IPA Convention & Exhibition. Please find below summary of your registration:</p>

<p><strong><u>CONVENTION REGISTRATION</u></strong></p>
@if (isset($paymentstatus) && $paymentstatus=='free')
	<p>
		@if($data['regtype'] == 'PO')
			Professional / Delegate Overseas | Free of Charge
		@elseif($data['regtype'] == 'PD')
			Professional / Delegate Domestic | Free of Charge
		@elseif($data['regtype'] == 'SD')
			Student Domestic | Free of Charge
		@elseif($data['regtype'] == 'SO')
			Student Overseas | Free of Charge
		@endif
	</p>
@endif
<table>
	@if (isset($paymentstatus) && $paymentstatus!='free')
		@if($data['regtype'] == 'PO')
			<tr>
				<td style="padding:10px;"><strong>Professional / Delegate Overseas</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $PO_rate) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD')
			<tr>
				<td style="padding:10px;"><strong>Professional / Delegate Domestic</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp($PD_rate) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SD')
			<tr>
				<td style="padding:10px;"><strong>Student Domestic</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp($SD_rate) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SO')
			<tr>
				<td style="padding:10px;"><strong>Student Overseas</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $SO_rate) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@endif

		@if($data['golf'] == 'Yes')
			<tr>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>Golf Tournament</strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>USD - </strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>IDR {{ formatrp($golfrate) }}</strong></td>
			</tr>
		@else
			<tr>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>Golf Tournament</strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>USD - </strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>IDR - </strong></td>
			</tr>
		@endif
		@if(($data['regtype'] == 'PD') || ($data['regtype'] == 'SD'))
		<tr>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>VAT</strong></td>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>10% </strong></td>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>&nbsp;</strong></td>
		</tr>
		@endif
		@if($data['regtype'] == 'PO' && $data['golf'] == 'Yes')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD' && $data['golf'] == 'Yes')

			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'PO' && $data['golf'] == 'No')
			
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD' && $data['golf'] == 'No')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SD')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SO')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@endif

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><strong>Payment should be made in FULL AMOUNT.</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="padding:10px;" colspan="2"><strong>Attend on Industrial Dinner (16 May 2013)</strong></td>
			<td style="padding:10px;"><strong>{{ $data['attenddinner'] }}</strong></td>
		</tr>

	@elseif(isset($paymentstatus) && $paymentstatus=='free')
	
	@else
		@if($data['regtype'] == 'PO')
			<tr>
				<td style="padding:10px;"><strong>Professional / Delegate Overseas</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $PO_rate) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD')
			<tr>
				<td style="padding:10px;"><strong>Professional / Delegate Domestic</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp($PD_rate) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SD')
			<tr>
				<td style="padding:10px;"><strong>Student Domestic</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp($SD_rate) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SO')
			<tr>
				<td style="padding:10px;"><strong>Student Overseas</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $SO_rate) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@endif

		@if($data['golf'] == 'Yes')
			<tr>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>Golf Tournament</strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>USD - </strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>IDR {{ formatrp($golfrate) }}</strong></td>
			</tr>
		@else
			<tr>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>Golf Tournament</strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>USD - </strong></td>
				<td style="padding:10px;border-bottom:1px solid #000;"><strong>IDR - </strong></td>
			</tr>
		@endif

		@if(($data['regtype'] == 'PD') || ($data['regtype'] == 'SD'))
		<tr>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>VAT</strong></td>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>10% </strong></td>
			<td style="padding:10px;border-bottom:1px solid #000;"><strong>&nbsp;</strong></td>
		</tr>
		@endif

		@if($data['regtype'] == 'PO' && $data['golf'] == 'Yes')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD' && $data['golf'] == 'Yes')

			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'PO' && $data['golf'] == 'No')
			
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@elseif($data['regtype'] == 'PD' && $data['golf'] == 'No')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SD')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>USD - </strong></td>
				<td style="padding:10px;"><strong>IDR {{ formatrp( $totalIDR ) }}</strong></td>
			</tr>
		@elseif($data['regtype'] == 'SO')
			<tr>
				<td style="padding:10px;"><strong>Grand Total</strong></td>
				<td style="padding:10px;"><strong>{{ money_format(" %i ", $totalUSD ) }}</strong></td>
				<td style="padding:10px;"><strong>IDR - </strong></td>
			</tr>
		@endif

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><strong>Payment should be made in FULL AMOUNT.</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="padding:10px;" colspan="2"><strong>Attend on Industrial Dinner (16 May 2013)</strong></td>
			<td style="padding:10px;"><strong>{{ $data['attenddinner'] }}</strong></td>
		</tr>
	@endif
</table>
</p>

@if($passwordRandom == 'nochange')

@elseif($fromadmin == 'yes')
<p><strong><u>LOGIN INFO</u></strong></p>
<table>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td>{{ $data['email'] }}</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td>{{ $passwordRandom }}</td>
	</tr>
</table>
@endif



<p><i>Convention registration fee includes admission to all Plenary & Technical Sessions, Conference Kits, Opening and Closing Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Entrance to Exhibition Area.<br/><br/>
* The cost of the Golf Tournament includes green fee, caddy & cart fee.</i><br/><br/>
@if($data['regtype'] != 'PD')
<!--<strong>* Fees above exclude VAT 10%</strong></i>-->
@endif
</p>
<p>For the registration payment, you can settle it by bank transfer to:</p>

<strong>IDR Account:</strong><br/>
<ul>
	<li style="margin-bottom:5px;">
		BCA - Mangga Dua Branch<br/>
		Acc. No.  : 335.302.7677<br/>
		Acc. Name : PT Dyandra Promosindo
	</li>
	<li style="margin-bottom:5px;">
		Mandiri - Wisma Nusantara Branch<br/>
		Acc. No.  : 103.000.1065180<br/>
		Acc. Name : PT Dyandra Promosindo
	</li>
</ul>

<strong>USD Account:</strong><br/>
<ul>
	<li>
		BCA - Wisma Nusantara Branch<br/>
		Acc. No.  : 734.038.5700<br/>
		Acc. Name : PT Dyandra Promosindo<br/>
		Swiftcode : CENAIDJA
	</li>
</ul>

<p>For payment confirmation, please login to your profile in <a href="http://www.ipaconvex.com" > www.ipaconvex.com</a> and <strong>upload the copy of bank transfer in payment confirmation page</strong>. Confirmation of Registration will be sent once the payment received.  <strong>Please bring the confirmation of registration to the registration counter when you re-register on the convention day.</strong>
<br/><strong><i>Payment by credit card (VISA/MASTER CARD) accepted on-site</i></strong>
</p>


<p><strong><u>IMPORTANT NOTES</u></strong></p>
<ol>
	<li style="margin:3px;"><strong>Early Bird scheme applies to those who have registered and have settled payment by 15 March 2013 at the latest</strong>. Normal rate will be applied for the registration payment after 15 March 2013.</li>
	<li style="margin:3px;">Registration Forms received without registration fees will not be processed. </li>
	<li style="margin:3px;"><strong>No refund will be granted for cancellation after 14 April 2013.</strong> All cancellations must be made in writing to the Convention Secretariat and the refund for cancellations before 14 April 2013 will be made after the convention.</li>
	<li style="margin:3px;"><strong>If billing address for sending the invoice is different from participant’s company information, please send billing address information along with the registration form.</strong></li>
	<li style="margin:3px;"><strong>Convention registration payment deadline is 30 April 2013.</strong></li>
	<li style="margin:3px;">For those who <strong>participate in golf tournament, the payment must be settled before 14 April 2013.</strong></li>
	<li style="margin:3px;">Registration counter will be open in front of JCC Main Lobby on:
		<ul>
			<li><span style="margin:6px;display:inline-block;width:20%;">Monday</span> <span style="display:inline-block;width:20%;">13 May 2013</span><span style="display:inline-block;width:30%;">10.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Tuesday</span> <span style="display:inline-block;width:20%;">14 May 2013</span><span style="display:inline-block;width:30%;">10.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Wednesday</span> <span style="display:inline-block;width:20%;">15 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Thursday</span> <span style="display:inline-block;width:20%;">16 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 03.00 PM</span></li>
			<li><span style="margin:6px;display:inline-block;width:20%;">Friday</span> <span style="display:inline-block;width:20%;">17 May 2013</span><span style="display:inline-block;width:30%;">08.00 AM – 12.00 PM</span></li>
			<li style="margin:6px;display:inline-block;">Participants will be able to collect the convention kits at registration counter</li>
		</ul>
	</li>
	<li>Registered participants <strong>must wear ID badges</strong> all the times for sessions and function access</li>

</ol>

<p>If you need further information regarding the convention, please feel free to contact us.
Thank you very much for your participation and we look forward to see you on 37th IPA Convex.
</p>

<p>Regards,<br/>
<strong>37th IPA Convex Secretariat</strong><br/>
PT Dyandra Promosindo<br/>
The City Tower, 7th Floor | Jl. M.H. Thamrin No. 81 | Jakarta 10310 - Indonesia<br/>
T. +62-21-31996077, 31997174 (direct) | F. +62-21-31997176<br/>
E. conventionipa2013@dyandra.com | W. www.ipaconvex.com</p>
