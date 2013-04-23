@layout('master')

@section('content')
<div class="metro span12">
	<div class="metro-sections-noeffect">

	   <div id="section1" class="metro-section tile-span-8">
	   		<div class="blockseparate marginbottom">
		      <h2>Visitor</h2>
		     <!-- <h5>Convention Registration</h5> -->
		     <a class="tile wide imagetext greenDark statistic" href="{{ URL::to('export/report/?type=all') }}">
		         <div class="image-wrapper">
		            <div class="text-biggest">{{ $stat['Visitor']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Visitor</div>
		         </div>
		         <span class="app-label"></span>
		      </a>
		      <a class="tile imagetext bg-color-blue statistic" href="{{ URL::to('export/report/?type=PO') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['VS']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Walk</div>
		            <div class="text">In</div>
		            <div class="text">Visitor</div>
		         </div>   
		      </a>
		      <a class="tile imagetext bg-color-purple statistic" href="{{ URL::to('export/report/?type=PD') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['VIP']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text"></div>
		            <div class="text">VIP</div>
		            <div class="text">Visitor</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-red statistic" href="{{ URL::to('export/report/?type=SO') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['VVIP']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text"></div>
		            <div class="text">VVIP</div>
		            <div class="text">Visitor</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-orange statistic" href="{{ URL::to('export/report/?type=SD') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['OC']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Other</div>
		            <div class="text">Complimentary</div>
		            <div class="text">Visitor</div>
		         </div>
		      </a>
		      
		      <a class="tile app bg-color-empty" href="#"></a>
	  		</div>
	      <div class="clear"></div>

	      
	   </div>

		
	</div>
</div>


@endsection