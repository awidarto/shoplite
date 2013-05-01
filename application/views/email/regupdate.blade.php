
<?php

setlocale(LC_MONETARY, "en_US");

//check date first

$golfrate = Config::get('eventreg.golffee');

//define first regtype



$totalIDRtax = 0.10*$data['totalIDR'];
$totalIDR = $data['totalIDR']+$totalIDRtax;

$totalUSDtax = 0.10*$data['totalUSD'];
$totalUSD = $data['totalUSD']+$totalUSDtax;

?>

<p><?php
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
Your profile has been updated successfully. Please find below summary of your profile:</p>

<p><strong><u>CONVENTION REGISTRATION</u></strong></p>

<table>

	@if($data['regtype'] == 'PO')
		<tr>
			<td style="padding:10px;"><strong>Professional / Delegate Overseas</strong></td>
			<td style="padding:10px;"><strong>USD {{ money_format(" %!n ", $data['regPO']) }}</strong></td>
			<td style="padding:10px;"><strong>IDR - </strong></td>
		</tr>
	@elseif($data['regtype'] == 'PD')
		<tr>
			<td style="padding:10px;"><strong>Professional / Delegate Domestic</strong></td>
			<td style="padding:10px;"><strong>USD - </strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($data['regPD']) }}</strong></td>
		</tr>
	@elseif($data['regtype'] == 'SD')
		<tr>
			<td style="padding:10px;"><strong>Student Domestic</strong></td>
			<td style="padding:10px;"><strong>USD - </strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($data['regSD']) }}</strong></td>
		</tr>
	@elseif($data['regtype'] == 'SO')
		<tr>
			<td style="padding:10px;"><strong>Student Overseas</strong></td>
			<td style="padding:10px;"><strong>USD {{ money_format(" %!n ", $data['regSO']) }}</strong></td>
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

	<tr>
		<td style="padding:10px;border-bottom:1px solid #000;"><strong>VAT</strong></td>
		<td style="padding:10px;border-bottom:1px solid #000;"><strong>10% </strong></td>
		<td style="padding:10px;border-bottom:1px solid #000;"><strong>&nbsp;</strong></td>
	</tr>
	
	@if($data['regtype'] == 'PO' && $data['golf'] == 'Yes')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD {{ money_format(" %!n ", $totalUSD) }}</strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($totalIDR) }} </strong></td>
		</tr>
	@elseif($data['regtype'] == 'PD' && $data['golf'] == 'Yes')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD - </strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($totalIDR) }}</strong></td>
		</tr>
	@elseif($data['regtype'] == 'PO' && $data['golf'] == 'No')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD {{ money_format(" %!n ", $totalUSD) }}</strong></td>
			<td style="padding:10px;"><strong>IDR - </strong></td>
		</tr>
	@elseif($data['regtype'] == 'PD' && $data['golf'] == 'No')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD - </strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($totalIDR) }}</strong></td>
		</tr>
	@elseif($data['regtype'] == 'SD')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD - </strong></td>
			<td style="padding:10px;"><strong>IDR {{ formatrp($totalIDR) }}</strong></td>
		</tr>
	@elseif($data['regtype'] == 'SO')
		<tr>
			<td style="padding:10px;"><strong>Grand Total</strong></td>
			<td style="padding:10px;"><strong>USD {{ money_format(" %!n ", $totalUSD) }}</strong></td>
			<td style="padding:10px;"><strong>IDR - </strong></td>
		</tr>
	@endif
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><strong>Payment should be made in FULL AMOUNT.</strong></i></td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="padding:10px;">Attend on Industrial Dinner (16 May 2013)</strong></td>
			<td style="padding:10px;">{{ $data['attenddinner'] }}</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td colspan="2"><strong>Company Information</strong></td>
		</tr>
		<tr>
			<td style="padding:10px;">Company Name</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['company'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Company NPWP</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['npwp'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Company Phone Number</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['companyphonecountry'] }} - {{ $data['companyphonearea'] }} - {{ $data['companyphone'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Company Fax Number</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['companyfaxcountry'] }} - {{ $data['companyfaxarea'] }} - {{ $data['companyfax'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Address:</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['address_1'] }}<br/>{{ $data['address_2'] }} <br/> {{ $data['city'] }} {{ $data['zip'] }} <br/> {{ $data['country'] }}</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td colspan="2"><strong>Invoice Address</strong></td>
		</tr>
		@if ( isset($data['cache_obj']) && $data['cache_obj']!= '')
			<tr>
				<td style="padding:10px;" colspan="3">{{ $data['invoice_address_conv'] }}</strong></td>
			</tr>
		@else
			<tr>
				<td style="padding:10px;">Company Name</td>
				<td style="padding:10px;">:</td>
				<td style="padding:10px;">{{ $data['companyInvoice'] }}</td>
			</tr>

			<tr>
				<td style="padding:10px;">Company NPWP</td>
				<td style="padding:10px;">:</td>
				<td style="padding:10px;">{{ $data['npwpInvoice'] }}</td>
			</tr>

			<tr>
				<td style="padding:10px;">Company Phone Number</td>
				<td style="padding:10px;">:</td>
				<td style="padding:10px;">{{ $data['companyphoneInvoiceCountry'] }} - {{ $data['companyphoneInvoiceArea'] }} - {{ $data['companyphoneInvoice'] }}</td>
			</tr>

			<tr>
				<td style="padding:10px;">Company Fax Number</td>
				<td style="padding:10px;">:</td>
				<td style="padding:10px;">{{ $data['companyfaxInvoiceCountry'] }} - {{ $data['companyfaxInvoiceArea'] }} - {{ $data['companyfaxInvoice'] }}</td>
			</tr>

			<tr>
				<td style="padding:10px;">Address:</td>
				<td style="padding:10px;">:</td>
				<td style="padding:10px;">{{ $data['addressInvoice_1'] }}<br/>{{ $data['addressInvoice_2'] }} <br/> {{ $data['cityInvoice'] }} {{ $data['zipInvoice'] }} <br/> {{ $data['countryInvoice'] }}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		@endif 
		

</table>
</p>


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
