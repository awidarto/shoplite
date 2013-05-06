@layout('master')

@section('content')

<div class="metro span12">
	<div class="metro-sections">

	   <div id="section1" class="metro-section tile-span-4">
	      <h2>IPA Convex Statistics</h2>
	      <h5>Convention Registration</h5>
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">1660</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Professional</div>
	            <div class="text">Overseas</div>
	            <div class="text">Convention Participant</div>
	         </div>   
	      </a>
	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">203</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Professional</div>
	            <div class="text">Domestic</div>
	            <div class="text">Convention Participant</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">101</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Student</div>
	            <div class="text">Domestic</div>
	            <div class="text">Convention Participant</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">2</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Student</div>
	            <div class="text">Overseas</div>
	            <div class="text">Convention Participant</div>
	         </div>
	      </a>
	      <a class="tile fullwidth wide imagetext greenDark statistic" href="./scaffolding.html">
	         <div class="image-wrapper">
	            <div class="text-biggest">1973</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total Convention</div>
	            <div class="text">Registration</div>
	         </div>
	         <span class="app-label">(not including FOC)</span>
	      </a>
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">721</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Exhibition</div>
	            <div class="text">Registration</div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">44</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Judge</div>
	            <div class="text">Participants</div>
	         </div>
	      </a>
	   </div>

	   <div id="section2" class="metro-section tile-span-4">
	      <h2>Quick Access</h2>
	      <a class="tile wide imagetext bg-color-greenDark" href="master-data.html">
	         <div class="image-wrapper">
	         	{{ HTML::image('content/img/My Apps.png') }}
	         </div>
	         <div class="column-text">
	            <div class="text">Master</div>
	            <div class="text">Data</div>
	         </div>
	      </a>
	      <a class="tile app bg-color-empty" href="#"></a>
	      <a class="tile app bg-color-empty" href="#"></a>
	      <a class="tile imagetext bg-color-orange" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">5</div>
	         </div>
	         <div class="column-text">
	            <div class="text-small">Confirmation Payment</div>
	            <div class="text-small">Request to Process</div>
	         </div>
	         
	      </a>
	      <a class="tile app bg-color-blueDark" href="./icons.html">
	         <div class="image-wrapper">
	            <span class="icon icon-user-2"></span>
	         </div>
	         <span class="app-label">Register new attendee</span>
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