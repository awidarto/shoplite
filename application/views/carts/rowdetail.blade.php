@section('row')

		var extra = aData['extra'];

        var items = extra.items;

        var prices = extra.prices;

        var it = '<table>';
        for(key in items){
            it += '<tr>';
            it += '<td><img src="{{ URL::to('storage/products/') }}' + key + '/sm_pic01.jpg" /></td>';
            it += '<td>';
                var sub = items[key];

                console.log(sub);

                it += '<ul>';
                for( k in sub)
                {
                    var n = k.split('_');

                    it += '<li class="itemlist" >Size : <strong>' + n[0] + '</strong> Color : <span class="color-chip" style="background-color:' + n[1] + '">&nbsp;&nbsp;&nbsp;</span> Price : ' + prices[key][k]['unit_price_fmt'] + ' Qty : ' + sub[k]['actual'] + '</li>';
                }
                it += '</ul>';
            it += '</td>';
            it += '</tr>';
        }

        it += '</table>';


		sOut += '<tr class="irc_pc"></tr>';
		sOut += '<tr><td colspan="3" style="margin-right:15px;"><h4>Buyer Information</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Items</h4></td></tr>';

	    sOut += '<tr><td>Name </td><td>:</td><td> '+ extra.buyerDetail.firstname + ' ' + extra.buyerDetail.lastname +'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td rowspan="5">' + it +'</td></tr>';

        sOut += '<tr><td>Address </td><td>:</td><td> '+ extra.buyerDetail.address_1 + '<br />' + extra.buyerDetail.address_2 +'</td><td>&nbsp;&nbsp;&nbsp;</td></tr>';

        sOut += '<tr><td>Shipping Phone </td><td>:</td><td> '+ extra.buyerDetail.shippingphone +'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr>';

        sOut += '<tr><td>Email </td><td>:</td><td> '+ extra.buyerDetail.email +'</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr>';

	    <!--sOut += '<tr><td>Industrial Dinner</td><td class="fontGreen">'+extra.attenddinner+'</td> <td>Golf Tournament</td><td class="icon- fontGreen align-center">'+ if(extra.attenddinner == 'Yes'){ +'&nbsp;&nbsp;&nbsp;&nbsp;<small>&#xe20c;</small>'+}else{+'&nbsp;&nbsp;&nbsp;&nbsp;<small>&#xe20c;</small>'+}+'</td></tr>';-->

@endsection