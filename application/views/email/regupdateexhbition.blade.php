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

<p><strong><u>EXHIBITION REGISTRATION</u></strong></p>

<table>
		<tr>
			<td colspan="2"><strong>Booth Information</strong></td>
		</tr>
		<tr>
			<td style="padding:10px;">Hall</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['hall'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Booth No.</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['booth'] }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
		<tr>
			<td colspan="2"><strong>Personal Information</strong></td>
		</tr>
		<tr>
			<td style="padding:10px;">Full Name</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['salutation'] }} {{ $data['firstname'] }} {{ $data['lastname'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Position</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['position'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Email</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['email'] }}</td>
		</tr>

		<tr>
			<td style="padding:10px;">Mobile</td>
			<td style="padding:10px;">:</td>
			<td style="padding:10px;">{{ $data['mobile'] }}</td>
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
		

</table>
</p>



<p>If you need further information regarding the convention, please feel free to contact us.
Thank you very much for your participation and we look forward to see you on 37th IPA Convex.
</p>

<p>Regards,<br/>
<strong>37th IPA Convex Secretariat</strong><br/>
PT Dyandra Promosindo<br/>
The City Tower, 7th Floor | Jl. M.H. Thamrin No. 81 | Jakarta 10310 - Indonesia<br/>
T. +62-21-31996077, 31997174 (direct) | F. +62-21-31997176<br/>
E. conventionipa2013@dyandra.com | W. www.ipaconvex.com</p>
