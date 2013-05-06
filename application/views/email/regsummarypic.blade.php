<?php


setlocale(LC_MONETARY, "en_US");

//check date first
$dateA = date('Y-m-d G:i'); 

$earlybirddate = Config::get('eventreg.earlybirdconventiondate'); 
$conventionrate = Config::get('eventreg.conventionrate');
$golfrate = Config::get('eventreg.golffee');

/*if(strtotime($dateA) > strtotime($earlybirddate)){
	if (isset($data['overrideratenormal']) && ($data['overrideratenormal']=='yes')){
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
}*/


?>


<p><?php
	echo 'Jakarta, '.date('l jS F Y');
?>
</p>

<p>Attention to: <br/>
<strong>{{ $pic['firstname'].' '.$pic['firstname'].' '.$pic['lastname'] }}</strong><br/>
<strong>{{ $pic['position'] }}</strong><br/>
<strong>{{ $pic['company'] }}</strong><br/>
<strong>{{ $pic['address_1'] }}</strong><br/>
{{ ($pic['address_2'] == '')?'':'<strong>'.$pic['address_2'].'</strong><br/>' }}
<strong>{{ $pic['city'].' '.$pic['zip'] }}</strong><br/>

<p>Dear Sir/Madam,<br />
Thank you for registering to 37th IPA Convention & Exhibition. Please find below summary of your registration:</p>

<table style="border-collapse: collapse;">
	
	<tr style="border:1px solid #545454;">
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">No</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">Name</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">Domestic / Fee</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">International / Fee</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">Attend Industry Dinner</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;">Golf Tournament</td>
	</tr>
<?php 
$no = 0;
$PDCount = 0;
$POCount = 0;
$SDCount = 0;
$SOCount = 0;

$PDRateCount = 0;
$PORateCount = 0;
$SORateCount = 0;
$SDRateCount = 0;

$golfCount = 0;
foreach($attendee as $data):
	$no ++;
	

	if($data['regtype'] == 'PD'):
	$PDCount ++;
	$PDRateCount += $data['regPD'];
	
?>
		<tr style="border:1px solid #545454;border-top:0;">
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $no ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['salutation'].' '.$data['firstname'].' '.$data['lastname'] ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">
				@if($data['conventionPaymentStatus']!='free')
					IDR {{ formatrp($data['regPD']) }}
				@else
					IDR FREE
				@endif
			</td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp; </td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['attenddinner'] ?> </td>
			<?php if($data['golf'] == 'Yes'): ?>
				<td style="padding:3px 7px 2px 7px;">
					@if($data['conventionPaymentStatus']!='free')
						IDR {{ formatrp($golfrate) }}
					@else
						IDR FREE
					@endif
				</td>
				<?php $golfCount++ ?>
			<?php else: ?>
				<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
			<?php endif; ?>
		</tr>
<?php
	elseif ($data['regtype'] == 'PO'):

	$POCount ++;
	$PORateCount += $data['regPO'];

?>
		<tr style="border:1px solid #545454;border-top:0;">
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $no ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['salutation'].' '.$data['firstname'].' '.$data['lastname'] ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">
				@if($data['conventionPaymentStatus']!='free')
					USD {{  money_format(" %!n ", $data['regPO'] ) }}
				@else
					USD FREE
				@endif
				
			</td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['attenddinner'] ?> </td>
			<?php if($data['golf'] == 'Yes'): ?>
				<td style="padding:3px 7px 2px 7px;">
					@if($data['conventionPaymentStatus']!='free')
						IDR {{ formatrp($golfrate) }}
					@else
						IDR FREE
					@endif
				</td>
				<?php $golfCount++ ?>
			<?php else: ?>
				<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
			<?php endif; ?>
		</tr>

<?php
	elseif ($data['regtype'] == 'SO'):

	$SOCount ++;
	$SORateCount += $data['regSO'];

?>
		<tr style="border:1px solid #545454;border-top:0;">
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $no ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['salutation'].' '.$data['firstname'].' '.$data['lastname'] ?></td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">
				@if($data['conventionPaymentStatus']!='free')
					USD {{  money_format(" %!n ", $data['regSO'] ) }}
				@else
					USD FREE
				@endif
				
			</td>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['attenddinner'] ?> </td>
			<?php if($data['golf'] == 'Yes'): ?>
				<td style="padding:3px 7px 2px 7px;">
					@if($data['conventionPaymentStatus']!='free')
						IDR {{ formatrp($golfrate) }}
					@else
						IDR FREE
					@endif
				</td>
				<?php $golfCount++ ?>
			<?php else: ?>
				<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
			<?php endif; ?>
		</tr>

<?php
	elseif ($data['regtype'] == 'SD'):

	$SDCount ++;
	$SDRateCount += $data['regSD'];
?>
	<tr style="border:1px solid #545454;border-top:0;">
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $no ?></td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['salutation'].' '.$data['firstname'].' '.$data['lastname'] ?></td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">
			@if($data['conventionPaymentStatus']!='free')
				IDR {{ formatrp($data['regSD']) }}
			@else
				IDR FREE
			@endif
			
		</td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp; </td>
		<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $data['attenddinner'] ?> </td>
		<?php if($data['golf'] == 'Yes'): ?>
			<td style="padding:3px 7px 2px 7px;">
				@if($data['conventionPaymentStatus']!='free')
					IDR {{ formatrp($golfrate) }}
				@else
					IDR FREE
				@endif
			</td>
			<?php $golfCount++ ?>
		<?php else: ?>
			<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
		<?php endif; ?>
	</tr>
<?php 
	endif;
?>

<?php endforeach;
	$golfrate = Config::get('eventreg.golffee');
	/*$totalConvFeePD = $PDCount*$PD_rate;
	$totalConvFeePO = $POCount*$PO_rate;
	$totalConvFeeSD = $SDCount*$SD_rate;
	$totalConvFeeSO = $SOCount*$SO_rate;*/
	$totalConvFeePD = $PDRateCount;
	$totalConvFeePO = $PORateCount;
	$totalConvFeeSD = $SDRateCount;
	$totalConvFeeSO = $SORateCount;
	
	$totalGolfFee = $golfCount*$golfrate;
	
	$rp=formatrp($totalConvFeePD+$totalConvFeeSD);
	$usd=money_format(" %i ", $totalConvFeePO+$totalConvFeeSO);
	
	$totalAllIDR=formatrp($totalGolfFee + $totalConvFeePD+$totalConvFeeSD);
	$totalAllUSD= money_format(" %i ", $totalConvFeePO+$totalConvFeeSO);
?>
<tr style="border:1px solid #545454;border-top:0;">
	<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;text-align:right;" colspan="2">Total</td>
	<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">IDR <?php echo $rp; ?></td>
	<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;"><?php echo $usd; ?></td>
	<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">&nbsp;</td>
	<td style="padding:3px 7px 2px 7px;border:1px solid #545454;margin:0;">IDR <?php echo formatrp($totalGolfFee) ;?> </td>
	
</tr>

</table>
<br />
<p><strong>TOTAL REGISTRATION PAYMENT: IDR <?php echo $totalAllIDR; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totalAllUSD; ?></strong><br/><br/>
<strong>* Fees above exclude VAT 10%</strong></i></p>


<p><i>Convention registration fee includes admission to all Plenary & Technical Sessions, Conference Kits, Opening and Closing Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Entrance to Exhibition Area.<br/><br/>
* The cost of the Golf Tournament includes green fee, caddy & cart fee.</i><br/><br/>

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
