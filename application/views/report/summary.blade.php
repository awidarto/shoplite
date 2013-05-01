@layout('master')

@section('content')
<div class="metro span12">
	<div class="metro-sections-noeffect">

	   <div id="section1" class="metro-section tile-span-8">
	   		<div class="blockseparate marginbottom">
		      <h2>Convention Registration</h2>
		     <!-- <h5>Convention Registration</h5> -->
		      <a class="tile imagetext bg-color-blue statistic" href="{{ URL::to('export/report/?type=PO') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['PO']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Professional</div>
		            <div class="text">Overseas</div>
		            <div class="text">Participants</div>
		         </div>   
		      </a>
		      <a class="tile imagetext bg-color-purple statistic" href="{{ URL::to('export/report/?type=PD') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['PD']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Professional</div>
		            <div class="text">Domestic</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-red statistic" href="{{ URL::to('export/report/?type=SO') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['SO']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Student</div>
		            <div class="text">Overseas</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-orange statistic" href="{{ URL::to('export/report/?type=SD') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['SD']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Student</div>
		            <div class="text">Domestic</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile wide imagetext greenDark statistic" href="{{ URL::to('export/report/?type=all') }}">
		         <div class="image-wrapper">
		            <div class="text-biggest">{{ $stat['Attendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total Convention</div>
		            <div class="text">Registration</div>
		         </div>
		         <span class="app-label">(not including FOC)</span>
		      </a>
		      <a class="tile app bg-color-empty" href="#"></a>
	  		</div>
	      <div class="clear"></div>

	      <div class="separateMetro">
		      <h2>Paid & Unpaid </h2>
		      <a class="tile imagetext bg-color-greenDark statistic" href="{{ URL::to('export/report/?payment=paid') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['paidAttendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Paid</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-red statistic" href="{{ URL::to('export/report/?payment=unpaid') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['unpaidAttendee']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Unpaid</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
	      </div>

	      <div class="separateMetro">
		      <h2>Golf & Galla Dinner</h2>

		      <!--<a class="tile wide imagetext bg-color-purple statistic" href="#">
		         <div class="image-wrapper">
		            <div class="text-biggest">{{ $stat['Golf']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total Golf</div>
		            <div class="text">Participants</div>
		         </div>
		         <span class="app-label">(not including FOC)</span>
		      </a>-->

		      <a class="tile imagetext bg-color-blue statistic" href="{{ URL::to('export/report/?golf=yes') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['Golf']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Golf</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
		      <a class="tile imagetext bg-color-purple statistic" href="{{ URL::to('export/report/?dinner=yes') }}">
		         <div class="image-wrapper text-big">
		            <div class="text-big">{{ $stat['Dinner']}}</div>
		         </div>
		         <div class="column-text">
		            <div class="text">Total</div>
		            <div class="text">Dinner</div>
		            <div class="text">Participants</div>
		         </div>
		      </a>
	      </div>
	      <div class="separateMetro marginbottom">
	      <h2>Registration by Country</h2>
	      <table class="report">
	      	<?php foreach ($country as $key =>$value ) {
	      		if($coutryValue[$value] > 0){?>
		      	<tr>
		      		<td>{{$value}}</td>
		      		<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
		      		<td class="countresult"><a href="{{ URL::to('export/report/?country='.$value) }}">{{$coutryValue[$value]}}</a></td>
		      	</tr>
	      	<?php 
	      		}

	      	}
	      	?>
	      </table>
	  	  </div>

	      <div class="clear"></div>

	      
	      <?php
			$last = array_pop($getdate);
			$lastCount = array_pop($getCount);	
			?>
	      	<script type="text/javascript">
			$(function () {
			    var chart;
			    $(document).ready(function() {
			        chart = new Highcharts.Chart({
			            chart: {
			                renderTo: 'charts',
			                type: 'bar',
			                marginRight: 130,
			                marginBottom: 25
			            },
			            title: {
			                text: '',
			                x: -20 //center
			            },
			            
			            xAxis: {
                            
			                categories: [<?php foreach ($getdate as $date) { echo "'".$date."',";} echo "'".$last."'";?>]

			            },
			            yAxis: {
			                title: {
			                    text: ''
			                },
			                plotLines: [{
			                    value: 0,
			                    width: 1,
			                    color: '#808080'
			                }]
			            },
			            tooltip: {
			                formatter: function() {
			                        return '<b>'+ this.x +'</b><br/>'+
			                        this.y +' Registration';
			                }
			            },
			            legend: {
			                layout: 'vertical',
			                align: 'right',
			                verticalAlign: 'top',
			                x: -10,
			                y: 100,
			                borderWidth: 0
			            },
			            series: [
			            {
			                name: 'Attendee',
			                data: [<?php foreach ($getCount as $att) { echo $att.",";} echo $lastCount;?>]
			            }
			            ]
			        });
			    });
			    
			});
			</script>
            {{ HTML::script('js/highcharts.js') }}
            {{ HTML::script('js/highcharts-exporting.js') }}
            <h2 style="margin-top: 5px;margin-bottom: 5px;">Daily Registration</h2>
	    	<div id="charts" style="min-width: 400px; height: 500px; margin: 0 auto">

            </div>
            <div class="clear"></div>
            <br/>
            <div class="separateMetro marginbottom companylist clearfix">
	      	<h2>Registration by Company</h2>
	      	<a class="icon-" href="{{ URL::to('export/reportbycompany') }}"><i></i><span class="pay" id="">Export as .csv</span></a>
	      	<table class="report">

	      	<?php
	      	$countdata = 0;
	      	foreach ($companies as $key =>$value ) {
	      		$countdata++;
	      		if($companyValue[$value] > 0){?>
			      	<tr>
			      		<td>{{$value}}</td>
			      		<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			      		<td class="countresult">{{$companyValue[$value]}}</td>
	      	<?php 
	      		}
	      	}
	      	?>
	      	</table>
	  	  	</div>
	  	  	<div class="clear"></div>
	   </div>

		
	</div>
</div>


@endsection