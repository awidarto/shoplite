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

<?php




$freepasscount = 0;
$boothassistantcount = 0;
$addboothassistantcount = 0;

$pass = $booth['freepassslot'];

if(isset($exhibitor['overridefreepassname'])){
	$pass = $exhibitor['overridefreepassname'];
}else{
	$pass = $pass;
}


if(isset($exhibitor['overridefreepassname'])){
	$pass = $exhibitor['overridefreepassname'];
}else{
	$pass = $pass;
}

for($i=1;$i<$pass+1;$i++){
	if(isset($profile['freepassname'.$i.''])){
  		$freepasscount++;
	}
}

for($i=1;$i<11;$i++){
    if(isset($profile['boothassistant'.$i.''])){
      $boothassistantcount++;
    }
}

for($i=1;$i<=$user_form['totaladdbooth'];$i++){
  	if(isset($profile['addboothname'.$i.''])){
      $addboothassistantcount++;
    }
}




?>
<div class="freepasslist">
@for($i=1;$i<=$freepasscount;$i++)
	<div id="preview-card">
		<div class="card-template-area">
			{{ HTML::image('images/idcard-template-exhibitor1.jpg','badge_bg',array('class'=>'cardtemplate')) }}
			<div class="headarea">
				<p class="fullname"><?php echo $profile['freepassname'.$i.''];?>
				<small class="companyname"><?php echo $exhibitor['company'];?></p>
			</div>
			<div class="barcodearea">
				<?php
				//$barcode = new Code39();
				$onlyconsonants = str_replace("-", "", $profile['freepassname'.$i.'regnumber']);
				//echo $barcode->draw($onlyconsonants);?>
				<img class="barcodeimage" src="{{URL::to('barcode/'.$onlyconsonants.'?'.time() )}}" />
				<span class="barcodetext">{{ $profile['freepassname'.$i.'regnumber'] }}</span>
			</div>
		</div>
	</div>
@endfor
</div>

<div class="addboothfreelist">
@for($i=1;$i<=$boothassistantcount;$i++)
	<div id="preview-card">
		<div class="card-template-area">
			{{ HTML::image('images/idcard-template-exhibitor2.jpg','badge_bg',array('class'=>'cardtemplate')) }}
			<div class="headarea">
				<p class="fullname"><?php echo $profile['boothassistant'.$i.''];?>
				<small class="companyname"><?php echo $exhibitor['company'];?></p>
			</div>
			<div class="barcodearea">
				<?php
				//$barcode = new Code39();
				$onlyconsonants = str_replace("-", "", $profile['boothassistant'.$i.'regnumber']);
				//echo $barcode->draw($onlyconsonants);?>
				<img class="barcodeimage" src="{{URL::to('barcode/'.$onlyconsonants.'?'.time() )}}" />
				<span class="barcodetext">{{ $profile['boothassistant'.$i.'regnumber'] }}</span>
			</div>
		</div>
	</div>
@endfor
</div>


<div class="addboothpaylist">
@for($i=1;$i<=$addboothassistantcount;$i++)
	<div id="preview-card">
		<div class="card-template-area">
			{{ HTML::image('images/idcard-template-exhibitor2.jpg','badge_bg',array('class'=>'cardtemplate')) }}
			<div class="headarea">
				<p class="fullname"><?php echo $profile['addboothname'.$i.''];?>
				<small class="companyname"><?php echo $exhibitor['company'];?></p>
			</div>
			<div class="barcodearea">
				<?php
				//$barcode = new Code39();
				$onlyconsonants = str_replace("-", "", $profile['addboothname'.$i.'regnumber']);
				//echo $barcode->draw($onlyconsonants);?>
				<img class="barcodeimage" src="{{URL::to('barcode/'.$onlyconsonants.'?'.time() )}}" />
				<span class="barcodetext">{{ $profile['addboothname'.$i.'regnumber'] }}</span>
			</div>
		</div>
	</div>
@endfor
</div>


<script type="text/javascript">
<?php
$redirect = URL::to('exhibitor/importbothassistant/'.$exhibitorid);
?>
setTimeout(window.print(),1500);

setTimeout("location.href = '<?php echo $redirect;?>';",2500);
	



</script>

@endsection