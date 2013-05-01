<p><?php
	echo 'Jakarta, '.date('l jS F Y');
?>
</p>

<p>Attention to: <br/>
<strong>{{ $userdata['firstname'].' '.$userdata['lastname'] }}</strong><br/>
<strong>{{ $userdata['position'] }}</strong><br/>
<strong>{{ $userdata['company'] }}</strong><br/>
<strong>{{ $userdata['address'].' '.$userdata['city'].' '.$userdata['zip'] }}</strong><br/>
<strong>Registration Number : {{ $userdata['registrationnumber'] }}</strong></p>

<p>Dear Sir/Madam,
The password for your 37th IPA Convention & Exhibition account was recently change. 
<br/>Please find below your new login info:</p>

<p><strong><u>LOGIN INFO</u></strong></p>

<p>
<table>
<tr><td>Email</td><td>:</td><td><strong>{{ $userdata['email'] }}</strong></td></tr>
<tr><td>Password</td><td>:</td><td><strong>{{ $newpass }}</strong></td></tr>
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
E. ipaconvention@dyandra.com | W. www.ipaconvex.com</p>
