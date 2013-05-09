@section('row')

		var extra = aData['extra'];
		var rowDinner = '';
		
		if(extra.attenddinner == 'Yes'){
			rowDinner = '<td class="icon- fontGreen align-center"><small>&#xe20c;</small></td>';
		}else{
			rowDinner = '<td class="icon- fontRed align-center"><small>&#xe03b;</small></td>';
		}

		if(extra.golf == 'Yes'){
			rowGolf = '<td class="icon- fontGreen align-center"><small>&#xe20c;</small></td>';
		}else{
			rowGolf = '<td class="icon- fontRed align-center"><small>&#xe03b;</small></td>';
		}
		
		sOut += '<tr class="irc_pc"></tr>';
		sOut += '<tr><td colspan="3" style="margin-right:15px;"><h4>Company Information</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td colspan="3"><h4>Invoice Address</h4></td></tr>';
	    sOut += '<tr><td>Company Name </td><td>:</td><td> '+ extra.company+'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Company Name </td><td>:</td><td> '+ extra.company+'</td></tr>';
	    if(extra.addressInvoice_1 != ''){
	    	sOut += '<tr><td>Company Address </td><td>:</td><td> '+ extra.address_1 + '<br/>' + extra.address_2 + '<br/>' + extra.city + '<br/>' + extra.zip + '<br/>' + extra.country +'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Company Address</td><td>:</td><td> '+ extra.addressInvoice_1 + '<br/>' + extra.addressInvoice_2 + '<br/>' + extra.cityInvoice + '<br/>' + extra.countryInvoice +'</td></tr>';
	    	sOut += '<tr><td>Company Phone </td><td>:</td><td> '+ extra.companyphone+'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Company Phone </td><td>:</td><td> '+ extra.companyphoneInvoice+'</td></tr>';
	    	sOut += '<tr><td>Company Fax </td><td>:</td><td> '+ extra.companyfax+'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Company Fax </td><td>:</td><td> '+ extra.companyfaxInvoice+'</td></tr>';
	    	sOut += '<tr><td>Industrial Dinner</td><td>:</td>'+rowDinner+' <td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Golf Tournament</td><td>:</td>'+rowGolf+'</tr>';
		}else{
			sOut += '<tr><td>Company Address </td><td>:</td><td> '+ extra.address_1 + '<br/>' + extra.address_2 + '<br/>' + extra.city + '<br/>' + extra.zip + '<br/>' + extra.country +'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Company Address</td><td>:</td><td> '+ extra.invoice_address_conv +'</td></tr>';
	    	sOut += '<tr><td>Company Phone </td><td>:</td><td> '+ extra.companyphone+'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>Golf Tournament</td><td>:</td>'+rowGolf+'</tr>';
	    	sOut += '<tr><td>Company Fax </td><td>:</td><td> '+ extra.companyfax+'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr>';
	    	sOut += '<tr><td>Industrial Dinner</td><td>:</td>'+rowDinner+' <td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr>';
		}
	    
	    
	    <!--sOut += '<tr><td>Industrial Dinner</td><td class="fontGreen">'+extra.attenddinner+'</td> <td>Golf Tournament</td><td class="icon- fontGreen align-center">'+ if(extra.attenddinner == 'Yes'){ +'&nbsp;&nbsp;&nbsp;&nbsp;<small>&#xe20c;</small>'+}else{+'&nbsp;&nbsp;&nbsp;&nbsp;<small>&#xe20c;</small>'+}+'</td></tr>';-->
	    
@endsection