<p style="font-family:Calibri,Helvetica,Arial,Serif;"><?php
	echo 'Jakarta, '.date('l jS F Y');
?>
</p>

<p style="font-family:Calibri,Helvetica,Arial,Serif;">Attention to: <br/>
<strong>{{ $data['firstname'].' '.$data['lastname'] }}</strong><br/>
<strong>{{ $data['position'] }}</strong><br/>
<strong>{{ $data['company'] }}</strong><br/>
<strong>{{ $data['address_1'] }}</strong><br/>
{{ ($data['address_2'] == '')?'':'<strong>'.$data['address_2'].'</strong><br/>' }}
<strong>{{ $data['city'].' '.$data['zip'] }}</strong><br/>
<strong>Registration Number : {{ $data['registrationnumber'] }}</strong></p>

<p style="font-family:Calibri,Helvetica,Arial,Serif;">Dear Sir/Madam,<br />
Thank you for registering to The 37th IPA Convention & Exhibition 2013 Secretariat. Please find below summary of your registration:</p>
</p>

@if($passwordRandom == 'nochange')

@elseif($fromadmin == 'yes')
<p style="font-family:Calibri,Helvetica,Arial,Serif;"><strong><u>LOGIN INFO</u></strong></p>
<table style="font-family:Calibri,Helvetica,Arial,Serif;">
	<tr>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">Email</td>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">:</td>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">{{ $data['email'] }}</td>
	</tr>
	<tr>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">Password</td>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">:</td>
		<td style="font-family:Calibri,Helvetica,Arial,Serif;">{{ $passwordRandom }}</td>
	</tr>
</table>
<p style="font-family:Calibri,Helvetica,Arial,Serif;">Please login to exhibitor profile in <a href="#">www.ipaconvex.com</a> and submit your requirement form </p> 
@endif


<p style="font-family:Calibri,Helvetica,Arial,Serif;">If you need further information regarding the convention, please feel free to contact us.
Thank you very much for your participation and we look forward to see you on The 37th IPA Convention & Exhibition 2013.
</p>

<p style="font-family:Calibri,Helvetica,Arial,Serif;">Regards,<br/>
<strong>The 37th IPA Convention & Exhibition 2013 Secretariat</strong><br/>
PT Dyandra Promosindo<br/>
The City Tower, 7th Floor | Jl. M.H. Thamrin No. 81 | Jakarta 10310 - Indonesia<br/>
T. +62-21-31996077, 31997174 (direct) | F. +62-21-31997176<br/>
E. conventionipa2013@dyandra.com | W. www.ipaconvex.com</p>

<p style="font-family:Calibri,Helvetica,Arial,Serif;">*Kindly contact your hall coordinator for further enquires, requirements and operational form submission.</p>
<style type="text/css">
#order-table td {

}

table.withborder tr td {

}
</style>
<table id="order-table" class="withborder cptable" style="font-family:Calibri,Helvetica,Arial,Serif;">
<tr class="even" style="background-color: #bdbdbd;">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">No.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Hall</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">PIC</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Phone</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Ext.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Mobile Phone</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Email</td>
</tr>
<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">1.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">Main Lobby</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Trisa</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">332</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 813 1847 1957</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">trisa@dyandra.com</td>
</tr>
<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Rachel</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">119</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 812 9850 9799</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">rachel.pardede@dyandra.com</td>
</tr>

<tr class="even">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">2.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">Assembly</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Dina</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">523</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 856 9364 0498</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">kusuma.ardina@dyandra.com</td>
</tr>
<tr class="even">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Talitha</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">358</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 878 2276 5155</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">talitha.sabrina@dyandra.com</td>
</tr>


<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">3.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">Cendrawasih</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Dian</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">271</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 811 143 004</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">dian@dyandra.com</td>
</tr>
<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Anita</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">326</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 812 1011 094</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">anita.afriani@dyandra.com</td>
</tr>

<tr class="even">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">4.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">Hall A</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Tia</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">323</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 812 8723 9036</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">tia.hamidah@dyandra.com</td>
</tr>
<tr class="even">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Wulan</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">528</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 856 7578 738</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">wulan.septiani@dyandra.com</td>
</tr>


<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">5.</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;" rowspan="2">Hall B</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Raymond</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">356</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 852 1067 1046</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">raymond@dyandra.com</td>
</tr>
<tr class="odd">
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">Rain</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">(+6221) 3199 6077</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">329</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">+62 813 8057 3636</td>
  <td style="padding: 5px;border: 1px solid #d6d6d6;font-family:Calibri,Helvetica,Arial,Serif;">rain.januardo@dyandra.com</td>
</tr>



</table>

