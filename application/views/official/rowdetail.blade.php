@section('row')
		var extra = aData['extra'];
	    sOut += '<tr><td>Company Address :</td><td>'+ extra.address + ',' + extra.city + ',' + extra.country +'</td></tr>';
	    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
	    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
@endsection