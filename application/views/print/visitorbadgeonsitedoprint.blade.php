@layout('blank')

@section('content')

{{ HTML::style('css/fontcard.css')}}
<style type="text/css">
body{
	margin: 0;
	padding:0;
}

.card-template-area{
	position: relative;
	width:315px;
	margin-left: 2px;
	/*height:196px;*/
	/*margin-left:7px;
	margin-top:2px;*/
	
}
.cardtemplate{
	width:315px;
	/*height:196px;*/
}
.headarea{
	position: absolute;
	top: 70px;
	left: 19px;
	width: 220px;
	height: 75px;
	display: table;
}
.barcodearea{
	position: absolute;
	top: 23px;
	right: 5px;
	
	text-align: center;
}
.card-template-area .fullname{
	font-size: 18px;
	font-family: "RobotoCondensed";
	position: relative;
	line-height: 17px;
	margin-bottom: 15px;
	font-weight: normal;
	display: table-cell; 
  	vertical-align: middle; 
  	text-align: left; 
	
	
}
.card-template-area .companyname{
font-size: 15px;
font-family: "RobotoLight";
font-weight: normal;
line-height: 15px;
letter-spacing: 0px;
display: block;
margin-top: 4px;
}
.barcodetext{
display: block;
margin: 0 auto;
text-align: center;
margin-top: 5px;
font-size: 7px;
font-family: Helvetica,Arial,Serif;
position: absolute;
bottom: -1px;
left: 46px;
background: #fff;
padding:0 5px;

}
#preview-card{
	
	display: block;
}

.barcodeimage{
	width:167px;
}
.fullname,.companyname{
	text-transform:uppercase; 
}
</style>
<div id="preview-card">
	<div class="card-template-area">
		@if($profile['role']=='VIP' || $profile['role']=='VVIP')
			{{ HTML::image('images/idcard-template-vip.jpg','badge_bg',array('class'=>'cardtemplate')) }}
		@else
			{{ HTML::image('images/idcard-template-visitor2.jpg','badge_bg',array('class'=>'cardtemplate')) }}
		@endif
		<div class="headarea">
			<p class="fullname"><?php echo $profile['firstname'].' '.$profile['lastname'];?>
			<small class="companyname"><?php echo $profile['company'];?></p>
		</div>
		<div class="barcodearea">
			<?php
			//$barcode = new Code39();
			$onlyconsonants = str_replace("-", "", $profile['registrationnumber']);
			//echo $barcode->draw($onlyconsonants);?>
			<img class="barcodeimage" src="{{URL::to('barcode/'.$onlyconsonants.'?'.time() )}}" />
			<span class="barcodetext">{{ $profile['registrationnumber'] }}</span>
		</div>
	</div>
</div>


<?php
$urlonsite = URL::to('onsite');
?>
<script type="text/javascript">


window.print();	
setTimeout("location.href = '<?php echo $urlonsite;?>';",1500);
	



</script>



@endsection