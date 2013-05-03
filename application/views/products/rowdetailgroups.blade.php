
@section('row')
	
	sOut += '<thead>';
	sOut += '<tr>';
	sOut += '<td>#</td>';
	sOut += '<td>&nbsp;</td>';
	sOut += '<td>REG.NUMBER</td>';
	sOut += '<td>REG.DATE</td>';
	sOut += '<td>EMAIL</td>';
	sOut += '<td>FIRST NAME</td>';
	sOut += '<td>LAST NAME</td>';
	sOut += '<td>COMPANY</td>';
	sOut += '<td>REG.TYPE</td>';
	sOut += '<td>COUNTRY</td>';
	sOut += '<td>CONV.STATUS</td>';
	sOut += '<td>GOLF.STATUS</td>';
	sOut += '</tr>';
	sOut += '</thead>';
	var myArray = aData['extra'];
	var no = 0;
	$.each(myArray, function() {
		
		var select = '<label class="checkbox"><input class="selector_'+this.cache_id+'" style="display:none" type="checkbox" name="" value=""><span class="metro-checkbox"></span></label>';
		no ++;
		sOut += '<tr>';
		sOut += '<td>'+no+'</td>';
		sOut += '<td>'+select+'</td>';
		sOut += '<td>'+this.registrationnumber+'</td>';
		sOut += '<td>2013-02-16</td>';
		sOut += '<td>'+this.email+'</td>';
		sOut += '<td>'+this.firstname+'</td>';
		sOut += '<td>'+this.lastname+'</td>';
		sOut += '<td>'+this.company+'</td>';
		sOut += '<td>'+this.regtype+'</td>';
		sOut += '<td>'+this.country+'</td>';
		sOut += '<td>'+this.conventionPaymentStatus+'</td>';
		sOut += '<td>'+this.golfPaymentStatus+'</td>';
		sOut += '</tr>';
	});
	    
@endsection