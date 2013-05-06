@layout('dialog')

@section('content')

<h4>Document Detail : {{ $profile['title'] }}</h4>
<div class="row">
	<div class="profileContent">
		<div class="one columns">
			{{ getavatar($profile['creatorId'])}}
		</div>
		<div class="eleven columns">
			<h5>{{ $profile['title'] }}</h5>
			<table class="profile-info">
				<tr>
					<td class="detail-title">Department of Origin</td>
					<td class="detail-info">{{ (isset($profile['docDepartment']))? depttitle($profile['docDepartment']):''; }}</td>
				</tr>

				<tr>
					<td class="detail-title">Related Project</td>
					<td class="detail-info">{{ $profile['docProject'] }}{{ isset($profile['docProjectTitle'])?' - '.$profile['docProjectTitle']:'' }}</td>
				</tr>

				<tr>
					<td class="detail-title">Created</td>
					<td class="detail-info">{{ date('d-m-Y h:i:s',$profile['createdDate']->sec) }}</td>
				</tr>
				<tr>
					<td class="detail-title">Format</td>
					<td class="detail-info">	
						<span>{{$profile['docFormat']}}</span>
					</td>
				</tr>
				<tr>
					<td class="detail-title">Creator</td>
					<td class="detail-info">{{ $profile['creatorName'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Attachment</td>
					<td class="detail-info">{{ (isset($profile['docFiledata']['uploadTime']))?date('d-m-Y h:i:s',$profile['docFiledata']['uploadTime']->sec):'' }} <strong>{{$profile['docFiledata']['name']}}</strong></td>
				</tr>
				<tr>
					<td class="detail-title">Attachment History</td>
					<td class="detail-info">
						@if(isset($profile['docFileList']))
					      <ol>
					        @foreach($profile['docFileList'] as $f)
					        <li>
					          {{ (isset($f['uploadTime']))?date('d-m-Y h:i:s',$f['uploadTime']->sec):'' }} <strong>{{$f['name']}}</strong>
					        </li>
					        @endforeach
					      </ol>
					    @endif
					</td>
				</tr>

			</table>
		</div>
	</div>
</div>
@endsection

