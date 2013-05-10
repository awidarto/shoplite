@layout('master')

@section('content')

<div class="metro span12">
	<div class="metro-sections">

	   <div id="section1" class="metro-section tile-span-4">
	      <h2>Shop Overview</h2>
	     <!-- <h5>Convention Registration</h5> -->
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['PO']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Cat 1</div>
	            <div class="text"></div>
	         </div>   
	      </a>
	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['PD']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Cat 2</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['SO']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Cat 3</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['SD']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total</div>
	            <div class="text">Cat 4</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      <a class="tile wide imagetext greenDark statistic" href="#">
	         <div class="image-wrapper">
	            <div class="text-biggest">{{ $stat['Attendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Total Sold</div>
	            <div class="text"></div>
	         </div>
	         <span class="app-label"></span>
	      </a>

	      <a class="tile imagetext bg-color-greenDark statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['Golf']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">1</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['paymentconf']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">2</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      
	      <a class="tile imagetext bg-color-blue statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['paidAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">3</div>
	            <div class="text"></div>
	         </div>
	      </a>

	      <a class="tile imagetext bg-color-purple statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['unpaidAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">4</div>
	            <div class="text"></div>
	         </div>
	      </a>
	      <a class="tile imagetext bg-color-red statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['cancelledAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">5</div>
	            <div class="text"></div>
	         </div>
	      </a>

	      <a class="tile imagetext bg-color-orange statistic" href="#">
	         <div class="image-wrapper text-big">
	            <div class="text-big">{{ $stat['focAttendee']}}</div>
	         </div>
	         <div class="column-text">
	            <div class="text">Stat</div>
	            <div class="text">6</div>
	            <div class="text"></div>
	         </div>
	      </a>

	   </div>

	   <div id="section2" class="metro-section tile-span-4">
	      <h2>Quick Access</h2>
	      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('products')}}">
	         <div class="image-wrapper">
	         	{{ HTML::image('content/img/My Apps.png') }}
	         </div>
	         <div class="column-text">
	            <div class="text">Products</div>
	         </div>
	      </a>

	      <a class="tile app bg-color-blueDark" href="{{ URL::to('products/add') }}">
	         <div class="image-wrapper">
	            <span class="icon icon-user-2"></span>
	         </div>
	         <span class="app-label">Add Product</span>
	      </a>

	      <a class="tile app bg-color-empty" href="#"></a>
	      <a class="tile app bg-color-empty" href="#"></a>

	      
	      
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