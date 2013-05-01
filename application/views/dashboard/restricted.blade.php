@layout('master')

@section('content')

<div class="metro span12">
	<div class="metro-sections">

	   <div id="section1" class="metro-section tile-span-4">
	      <h2>IPA Convex Statistics</h2>
	     <!-- <h5>Convention Registration</h5> -->
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['PO']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Professional</div>
	            <div class="text">Overseas</div>
	            <div class="text">Participants</div>
	         </div>   
	      </a>
	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['PD']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Professional</div>
	            <div class="text">Domestic</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['SO']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Student</div>
	            <div class="text">Overseas</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['SD']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Student</div>
	            <div class="text">Domestic</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	      <a class="tile wide imagetext greenDark statistic" href="#">
	         <div class="image-wrapper">
	            <div class="text-biggest">{{ $stat['Attendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total Convention</div>
	            <div class="text">Registration</div>
	         </div>
	         <span class="app-label">(not including FOC)</span>
	      </a>

	      <a class="tile imagetext bg-color-greenDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['Golf']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Golf</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['paymentconf']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Payment</div>
	            <div class="text">Confirmation</div>
	            <div class="text">to Process</div>
	         </div>
	      </a>
	      
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['paidAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Paid</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>

	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['unpaidAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Unpaid</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['cancelledAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Canceled</div>
	            <div class="text">Registration</div>
	         </div>
	      </a>

	      <a class="tile imagetext bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['focAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">FOC</div>
	            <div class="text">Registration</div>
	         </div>
	      </a>

	     <!--inside-->
	     <h2 class="inside">Exhibition Statistics</h2>
	     <!-- <h5>Convention Registration</h5> -->
	     <a class="tile wide imagetext greenDark statistic" href="#">
	         <div class="image-wrapper">
	            <div class="text-biggest">{{ $stat['ExhibitorTotal']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total Exhibitor</div>
	            <div class="text">Registration</div>
	         </div>
	         <span class="app-label">&nbsp;</span>
	      </a>

	      <a class="tile wide imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper">
	            <div class="text-biggest">{{ $stat['formSumitted']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total Form</div>
	            <div class="text">Submitted</div>
	         </div>
	         <span class="app-label">&nbsp;</span>
	      </a>
	      
	      
	      <div class="clear"></div>
	      <h2 class="inside">Total Exhibitor Perhall</h2>
	      <a class="tile imagetext  bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['cendrawasih']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Cendrawasih</div>
	            <div class="text">Hall</div>
	            <div class="text">&nbsp;</div>
	         </div>   
	      </a>

	      <a class="tile imagetext  bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['assembly']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Assembly</div>
	            <div class="text">Hall</div>
	            <div class="text">&nbsp;</div>
	            
	         </div>   
	      </a>
	      

	      <a class="tile imagetext  bg-color-greenDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['halla']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Hall A</div>
	            <div class="text">&nbsp;</div>
	            <div class="text">&nbsp;</div>
	         </div>   
	      </a>

	      <a class="tile imagetext  bg-color-blueDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['mainlobby']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Main</div>
	            <div class="text">Lobby</div>
	            <div class="text">&nbsp;</div>
	            
	         </div>   
	      </a>
	      

	      <!--new-->
	      <div class="clear"></div>
	      <h2 class="inside">Total Form Submitted Perhall</h2>
	      <a class="tile imagetext  bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['form_cendrawasih']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Cendrawasih</div>
	            <div class="text">Hall</div>
	            <div class="text">&nbsp;</div>
	         </div>   
	      </a>

	      <a class="tile imagetext  bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['form_assembly']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Assembly</div>
	            <div class="text">Hall</div>
	            <div class="text">&nbsp;</div>
	            
	         </div>   
	      </a>
	      

	      <a class="tile imagetext  bg-color-greenDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['form_halla']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Hall A</div>
	            <div class="text">&nbsp;</div>
	            <div class="text">&nbsp;</div>
	         </div>   
	      </a>

	      <a class="tile imagetext  bg-color-blueDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['form_mainlobby']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Main</div>
	            <div class="text">Lobby</div>
	            <div class="text">&nbsp;</div>
	            
	         </div>   
	      </a>
	      


	   </div>

	   <div id="section2" class="metro-section tile-span-4">
	      <h2>Quick Access</h2>
	      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('attendee')}}">
	         <div class="image-wrapper">
	         	{{ HTML::image('content/img/My Apps.png') }}
	         </div>
	         <div class="column-text">
	            <div class="text">Attendees</div>
	         </div>
	      </a>

	      <a class="tile app bg-color-blueDark" href="{{ URL::to('attendee/add') }}">
	         <div class="image-wrapper">
	            <span class="icon icon-user-2"></span>
	         </div>
	         <span class="app-label">Register New Attendee</span>
	      </a>

	      <a class="tile app bg-color-empty" href="#"></a>
	      <a class="tile app bg-color-empty" href="#"></a>

	      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('visitor')}}">
	         <div class="image-wrapper">
	         	{{ HTML::image('content/img/My Apps.png') }}
	         </div>
	         <div class="column-text">
	            <div class="text">Visitors</div>
	         </div>
	      </a>

	      <a class="tile app bg-color-blueDark" href="{{ URL::to('visitor/add') }}">
	         <div class="image-wrapper">
	            <span class="icon icon-user-2"></span>
	         </div>
	         <span class="app-label">Register New Visitor</span>
	      </a>


	      <a class="tile app bg-color-empty" href="#"></a>
	      <a class="tile app bg-color-empty" href="#"></a>

	      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('official')}}">
	         <div class="image-wrapper">
	         	{{ HTML::image('content/img/My Apps.png') }}
	         </div>
	         <div class="column-text">
	            <div class="text">Officials</div>
	         </div>
	      </a>

	      <a class="tile app bg-color-blueDark" href="{{ URL::to('official/add') }}">
	         <div class="image-wrapper">
	            <span class="icon icon-user-2"></span>
	         </div>
	         <span class="app-label">Register New Official</span>
	      </a>
	      
	   </div>
	</div>
</div>

<!--<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<div class="row">
	<div class="twelve columns">
		<p>
			No document shared to you, or you have no permission for this section.
		</p>
	</div>
</div>-->

@endsection