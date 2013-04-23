@layout('public')


@section('content')

<h4 class="headIpaSite">My Profile</h4>
<div class="row">
	<div class="profileContent">
		<div class="ten columns">
			<h5 class="headIpaSite">{{ $profile['firstname'].' '.$profile['lastname'] }}</h5>
			<table class="profile-info">
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
					<td class="detail-title">Registration Type</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						
						@if($profile['regtype'] == 'PO')
							Professional / Delegate Overseas
						@elseif($profile['regtype'] == 'PD')
							Professional / Delegate Domestic
						@elseif($profile['regtype'] == 'SD')
							Student Domestic
						@elseif($profile['regtype'] == 'SO')
							Student Overseas
						@endif
						
					</td>
				</tr>

				<tr>
					<td class="detail-title">Status</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						<span style="color: #BC1C4B;">{{ $profile['paymentStatus'] }}</span>
					</td>
				</tr>
				<tr>
					<td class="detail-title">Industrial Dinner RSPV</td>
					<td>: </td>
					<td class="detail-info">{{ $profile['attenddinner'] }}</td>
				</tr>

				<tr><td colspan="3"><h4>Company Information</h4></td></tr>

				<tr>
					<td class="detail-title">Company Name</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['company'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Company NPWP</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['npwp'] }}</td>
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
					<td class="detail-info">{{ $profile['address'].' '.$profile['city'].' '.$profile['zip'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Country</td>
					<td>:</td>
					<td class="detail-info">{{ $profile['country'] }}</td>
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