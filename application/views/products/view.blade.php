@layout('master')

@section('content')

<table>
@foreach($obj as $key=>$val)
	<tr>
		<td>{{$key}}</td>
		@if(!is_array($val))
			@if( $val instanceof MongoDate)
				<td><?php print date( 'd-m-Y H:i:s',$val->sec ); ?></td>
			@else
				<td><?php print $val; ?></td>
			@endif
		@else
			<td>Array</td>
		@endif
	</tr>	
@endforeach
</table>

@endsection
