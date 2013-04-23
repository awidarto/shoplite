<style type="text/css">
body{
	margin: 0;
	padding:0;
}

table td{
	padding:5px;
}
</style>
<?php

setlocale(LC_MONETARY, "en_US");
$totalIDRtax = 0.10*$data['totalIDR'];
$totalIDR = $data['totalIDR']+$totalIDRtax;

$totalUSDtax = 0.10*$data['totalUSD'];
$totalUSD = $data['totalUSD']+$totalUSDtax;
?>

<div style="width:100%;position:relative;display:block;font-family:Helvetica,Arial,Sans-serif;font-size:9px;margin:0;">
	<div style="width:100%;position:relative;display:block;margin:0;float:left;">

		<div style="position:relative;display:inline-block;float:left;margin:0 10px 10px 0;">{{ HTML::image('images/ipa-logo.jpg','badge_bg',array('class'=>'cardtemplate','style'=>'width:70px;')) }}</div>
		<div style="width:80%;position:relative;display:inline-block;float:left;">
			<h2 style="display:inline-block;margin:15px 0 0 7px;">RECEIPT</h2><br/>
			<h3 style="display:inline-block;margin:0 0 0 4px;">THE 37TH IPA CONVENTION AND EXHIBITION 2013</h3><br/>
			<h5 style="display:inline-block;margin:0 0 0 4px;">JAKARTA CONVENTION CENTER, 15-17 MAY 2013</h5>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block;float:left;font-size:9px;">
		
		
		<div style="width:100%;position:relative;display:inline-block;float:left;">
			<table style="font-size:9px;margin-top:6px;">
			<tr style="vertical-align: top;margin:5px 0;">
				<td>No. Registration</td>
				<td>:</td>
				<td>{{ $data['registrationnumber'] }}</td>
			</tr>
			<tr style="vertical-align: top;">
				<td>
				Received From
				</td>
				<td>:</td>
				<td><?php echo $data['salutation'];?>. <?php echo $data['firstname'].' '.$data['lastname'] ;?><br/>
					
					<?php echo $data['company'];?><br/>
					<?php
					if($data['address_1']!='-'){
						echo $data['address_1'];
						echo ',<br/>';
					}
					?>
					<?php 
					if($data['address_2']!='-'){
						echo $data['address_2'];
						echo '<br/>';
					}
					?>
					<?php
					if($data['city']!='-'){
						echo $data['city'].' - '.$data['zip'];
						echo '<br/>';
					}?>
					<?php 
					if($data['country']!='none'){
						echo $data['country'];
					}?>
					<br/>
				</td>
				
			</tr>

			<tr style="vertical-align: top;margin:5px 0;">
				<td>In Payment Of:</td>
				<td>:</td>
				<td>Registration Fees ( {{
					@if($data['reg'])
				}} )</td>
			</tr>

			

			</table>
		</div>

		
	</div>

	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000; margin-top:7px;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:17px;padding:10px;">
				<strong>REGISTRATION FEES</strong><br/>
				<?php if($data['regtype'] == 'PD' || $data['regtype'] == 'SD'):?>
					<span>Participant - Domestic</span>
				<?php else:?>
					<span>Participant - International</span>
				<?php endif;?>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:17px;padding:10px;">
				<?php if($data['regtype'] == 'PD'):?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo formatrp ($data['regPD']) ;?></span>
				<?php elseif($data['regtype'] == 'SD'):?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo formatrp ($data['regSD']) ;?></span>					
				<?php else:?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				<?php endif;?>
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:17px;padding:10px;">
				<?php if($data['regtype'] == 'PO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo  money_format(" %!n ", $data['regPO']) ;?></span>
				<?php elseif($data['regtype'] == 'SO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"> <?php echo money_format(" %!n ", $data['regSO']) ;?></span>
				<?php else:?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				<?php endif;?>
			</div>
		</div>
	</div>

	<?php if($data['regtype'] == 'SD' || $data['regtype'] == 'PD'):?>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:10px;padding:10px;text-align:left;">
				VAT 10%<br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:10px;padding:10px;">
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo formatrp($totalIDRtax) ;?></span>
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:10px;padding:10px;">

				<?php if($data['regtype'] == 'PO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo money_format(" %!n ", $data['regPO']) ;?></span>
				<?php elseif($data['regtype'] == 'SO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo money_format(" %!n ", $data['regSO']) ;?></span>
				<?php else:?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				<?php endif;?>

				
			</div>
		</div>
	</div>
	<?php endif;?>
	<div style="width:100%;position:relative;display:block; float:left;border:1px solid #000;border-top:none;">
		<div style="width:100%;position:relative;display:block;float:left;">
			<div style="width:50%;position:relative;display:inline-block;float:left;border-right:1px solid #000;height:10px;padding:10px;text-align:right;">
				<strong>TOTAL PAYMENT</strong><br/>
			</div>
			<div style="width:20%;position:relative;display:block;float:left;border-right:1px solid #000;height:10px;padding:10px;">
				
				<?php if($data['regtype'] == 'PD'):?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo formatrp($totalIDR) ;?></span>
				<?php elseif($data['regtype'] == 'SD'):?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo formatrp($totalIDR) ;?></span>
				<?php else:?>
					<span style="width:50%;position:relative;display:block;float:left;">IDR</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				<?php endif;?>


				
			</div>

			<div style="width:20%;position:relative;display:block;float:left;height:10px;padding:10px;">

				<?php if($data['regtype'] == 'PO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo money_format(" %!n ", $data['regPO']) ;?></span>
				<?php elseif($data['regtype'] == 'SO'):?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;"><?php echo money_format(" %!n ", $data['regSO']) ;?></span>
				<?php else:?>
					<span style="width:50%;position:relative;display:block;float:left;">USD</span>
					<span style="width:50%;position:relative;display:block;float:left;text-align:right;">&nbsp;</span>
				<?php endif;?>

				
			</div>
		</div>
	</div>

	<div style="clear:both;"></div>
	<div style="width:100%;position:relative;display:block; float:left;margin:7px 0 0px 0;font-size:8px;">
		<ul style="display: block; list-style-type: disc; margin: 0 0 0 0;-webkit-padding-start: 20px;">
			<li style="padding:2px 0 0 0;">PLEASE REGARD THIS SLIP AS AN OFFICIAL RECEIPT</li>
			<li style="padding:2px 0 0 0;">PLEASE TAKE THIS SLIP TO THE REGISTRATION DESK TO OBTAIN YOUR ID BADGE & CONVENTION KITS</li>
			<!--<li style="padding:2px 0 0 0;">REGISTRATION WILL START AT <strong>10:00 - 15:00 HOURS ON 13-14 MAY 2013 AND AT 08:00 - 15:00 HOURS ON 15-17 MAY 2013 (AT JCC REGISTRATION COUNTER)</strong></li>-->
			<li style="padding:2px 0 0 0;">PLEASE CHECK YOUR NAME ON THIS RECEIPT AS THIS WILL BE USED FOR YOUR ID BADGE</li>
		</ul>
		
	</div>

	<div style="clear:both;"></div>
	<div style="width:20%;position:relative;display:block; float:right;margin:-15px 0 0 0;font-size:9px;">
		<p>Jakarta, <?php echo date('l jS F Y');?></p>
		<br/>
		<br/>
		<br/>
		<p style="margin-bottom:0;"><span style="border-bottom:1px solid #000;width:80%;display:block;">KANIA ANISIA</span><span>Manager Finance Dept.</span></p>
		
		
	</div>

</div>

