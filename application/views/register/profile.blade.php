@layout('public')


@section('content')

@if($profile['conventionPaymentStatus'] == 'unpaid')
<div class="row">
	<div>
		<p>You have not made any payment yet. Would you like to :
		{{ HTML::link('payment/convention','Confirm your transfer payment',array('class'=>'paymentButton seven'))}}
		{{ HTML::link('register/checkout','Make payment using Credit Card',array('class'=>'paymentButton seven'))}}		
		</p>
	</div>
</div>

@endif

<h4 class="headIpaSite">My Profile</h4>
<div class="row">
	<div class="profileContent">
		<div class="ten columns">
			<h5 class="headIpaSite">{{ $profile['firstname'].' '.$profile['lastname'] }}</h5>


			<table class="profile-info">
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
				<!--<tr>
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
				</tr>-->

				<tr>
					<td class="detail-title">Status</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						@if($profile['conventionPaymentStatus'] == 'unpaid')
							<span style="color: #BC1C4B;text-transform:uppercase;text-decoration:underline;">{{ HTML::link('payment/convention',$profile['conventionPaymentStatus']) }}</span>
						@elseif($profile['conventionPaymentStatus'] == 'cancel')
							<span style="text-transform:uppercase;">{{ $profile['conventionPaymentStatus'] }}</span>
						@elseif($profile['conventionPaymentStatus'] == 'paid')
							<span style="color: #229835;text-transform:uppercase;">{{ $profile['conventionPaymentStatus'] }}</span>
						@else
							<span style="color: #BC1C4B;text-transform:uppercase;">{{ $profile['conventionPaymentStatus'] }}</span>
						@endif
						
					</td>
				</tr>
				<tr>
					<td class="detail-title">Registration  Type</td>
					<td>:&nbsp;</td>
					@if($profile['regtype'] == 'PO')
						<td class="detail-info">Professional / Delegate Overseas</td>
					@elseif($profile['regtype'] == 'PD')
						<td class="detail-info">Professional / Delegate Domestic</td>
					@elseif($profile['regtype'] == 'SD')
						<td class="detail-info">Student Domestic</td>
					@elseif($profile['regtype'] == 'SO')
						<td class="detail-info">Student Overseas</td>
					@endif					
					
				</tr>
				<tr>
					<td class="detail-title">Industri Dinner RSVP</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						<span>{{ $profile['attenddinner'] }}</span>
					</td>
				</tr>
				<tr>
					<td class="detail-title">Golf Tournament</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						@if($profile['golf'] == 'Yes')
							@if($profile['golfPaymentStatus'] == 'unpaid')
								<span>{{ $profile['golf'] }} - <span style="color: #BC1C4B;text-transform:uppercase;text-decoration:underline;">{{ HTML::link('payment/golf',$profile['golfPaymentStatus']) }}</span></span>
							@elseif ($profile['golfPaymentStatus'] == 'pending')
								<span>{{ $profile['golf'] }} - <span style="text-transform:uppercase;">{{ $profile['golfPaymentStatus'] }}</span></span>
							@elseif ($profile['golfPaymentStatus'] == 'paid')
								<span>{{ $profile['golf'] }} - <span style="color: #229835;text-transform:uppercase;">{{ $profile['golfPaymentStatus'] }}</span></span>
							@else
								<span>{{ $profile['golf'] }} - <span style="color: #BC1C4B;text-transform:uppercase;">{{ $profile['golfPaymentStatus'] }}</span></span>
							@endif
						@else
							<span>{{ $profile['golf'] }}</span>
						@endif
					</td>
				</tr>
				<!--<tr>
					<td class="detail-title">Industrial Dinner RSVP</td>
					<td>: </td>
					<td class="detail-info">{{ $profile['attenddinner'] }}</td>
				</tr>-->

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

				<tr><td colspan="3"><h4>Invoice Address</h4></td></tr>
				<!--Find out if they are from import or not-->
				@if ( isset($profile['cache_obj']) && $profile['cache_obj']== '')
					<tr>
						<td class="detail-title">Company Name</td>
						<td>:&nbsp;</td>
						<td class="detail-info">{{ $profile['companyInvoice'] }}</td>
					</tr>

					<tr>
						<td class="detail-title">Company NPWP</td>
						<td>:&nbsp;</td>
						<td class="detail-info">{{ $profile['npwpInvoice'] }}</td>
					</tr>

					<tr>
						<td class="detail-title">Company Phone</td>
						<td>:&nbsp;</td>
						<td class="detail-info">{{ $profile['companyphoneInvoice'] }}</td>
					</tr>

					<tr>
						<td class="detail-title">Company Fax</td>
						<td>:&nbsp;</td>
						<td class="detail-info">{{ $profile['companyfaxInvoice'] }}</td>
					</tr>

					<tr>
						<td class="detail-title">Company Address</td>
						<td style="vertical-align:top">:&nbsp;</td>
						@if (isset($profile['address']))
							<td class="detail-info">{{ $profile['addressInvoice'].' '.$profile['cityInvoice'].' '.$profile['zipInvoice'] }}</td>
						@else
							<td class="detail-info">{{ $profile['addressInvoice_1'].'</br>'.$profile['addressInvoice_2'].'</br>'.$profile['cityInvoice'].' '.$profile['zipInvoice'] }}</td>
							
						@endif
					</tr>

					<tr>
						<td class="detail-title">Country</td>
						<td>:</td>
						<?php
						
							//$countries = Config::get('country.countries');
						?>
						
						<td class="detail-info">{{ $profile['countryInvoice']  }}</td>
						
						
					</tr>
					@else

						<tr>
							<td class="detail-title">Address</td>
							<td>:</td>
							<td class="detail-info">{{ $profile['invoice_address_conv']  }}</td>

						</tr>

					@endif
				
				
			</table>
			<br/>
			<br/>
			<br/>
			<hr/ style="color:#838383;">
		</div>
	</div>
</div>
@endsection