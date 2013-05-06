@layout('master')


@section('content')

<h3>User Profile</h3>
<div class="row-fluid">
	<div class="profileContent">
		<!--<div class="three columns">
			{{ getavatar($profile['_id'])}}
			<a href="{{ URL::to('user/picture')}}" class="inlink" ><i class="foundicon-smiley action"></i> Change Picture</a>
			<a href="{{ URL::to('user/pass')}}" class="inlink" ><i class="foundicon-lock action"></i> Change Password</a>
			<a href="{{ URL::to('user/editprofile')}}" class="inlink" ><i class="foundicon-edit action"></i> Edit Profile</a><br />
		</div>-->
		<br/>

		<div class="nine columns">
			<h2>{{ $profile['fullname'] }}</h2>
			<table class="profile-info secondtable">
				<tr>
					<td class="detail-title">Email</td>
					<td class="detail-title">:</td>
					<td class="detail-info">{{ $profile['email'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Roles</td>
					<td class="detail-title">:</td>
					<td class="detail-info">	
						<span>{{roletitle($profile['role'])}}</span>
					</td>
				</tr>
				
				<tr>
					<td><a href="{{ URL::to('user/pass')}}" class="inlink" ><i class="foundicon-lock action"></i> Change Password</a></td>
					<td class="detail-title">&nbsp;</td>
					<td class="detail-title">&nbsp;</td>
					
				</tr>
				

			</table>
		</div>
	</div>
</div>
@endsection