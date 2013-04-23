@layout('public')


@section('content')

<h4 class="headIpaSite">My Profile</h4>
<div class="row">
	<div class="profileContent">
		<div class="ten columns">
			<h5 class="headIpaSite">{{ $profile['firstname'].' '.$profile['lastname'] }}</h5>
			<table class="profile-info">
				<tr>
					<td class="detail-title">Hall</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['hall'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Booth No.</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['booth'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Registration Number</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['registrationnumber'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Email</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['email'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Position</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['position'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Mobile Phone Number</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['mobile'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Operational Form Status</td>
					<td>:</td>
					<?php
					
						//$countries = Config::get('country.countries');
					?>
					
					<td class="detail-info" style="text-transform:uppercase;color:#A70405;">{{ $profile['formstatus']  }}</td>
					
				</tr>

				

				<tr><td colspan="3"><h4>Company Information</h4></td></tr>

				<tr>
					<td class="detail-title">Company Name</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['company'] }}</td>
				</tr>

				

				<tr>
					<td class="detail-title">Company Phone</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['companyphone'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Company Fax</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['companyfax'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Company Address</td>
					<td style="vertical-align:top">:&nbsp;</td>
					@if (isset($profile['address']))
					<td class="detail-info">{{ $profile['address'].' '.$profile['city'].' '.$profile['zip'] }}</td>
					@else
					<td class="detail-info">{{ $profile['address_1'].'</br>'.$profile['address_2'].'</br> '.$profile['city'].' '.$profile['zip'] }}</td>
					@endif
				</tr>

				<tr>
					<td class="detail-title">Country</td>
					<td>:</td>
					<?php
					
						//$countries = Config::get('country.countries');
					?>
					
					<td class="detail-info">{{ $profile['country']  }}</td>
					
				</tr>


				

				
				
				
			</table>
			<br/>
			<br/>
			<br/>
			<hr/ style="color:#838383;">
		</div>
	</div>
</div>
@endsection