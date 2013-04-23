@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<!--{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}-->
<p>Group/bulk registration method is provided for a company who would like to register more than 1 of their employees simultaneously.
<br/>Please complete Person In Charge (PIC) Details Sheet and Participants' Details Sheet
</p>

<h4 style="font-size:14px;">GUIDELINES</h4>
<p><strong>Step 1:</strong><br/>
On this document there are fields that need to be filled out, one person per row. Follow the example we provided and fill out the fields accordingly. Please refrain from making any new formatting of the Microsoft Excel document. Do not change or remove the first row of the template, as it contains column names needed for the system to recognize the appropriate fields. 
For each name you are registering for please provide a valid and unique e-mail address. PIC cannot register multiple individuals using singular e-mail address.</p>

<p><strong>Step 2:</strong><br/>
After filling out all the necessary fields, save the document and e-mail back to us at conventionipa2013@dyandra.com</p>

<p><strong>Step 3:</strong><br/>
After we input the document to the system, each individual on the Microsot Excel sheet will receive as notification letter via e-mail. The PIC will also receive a notification letter via e-mail with a summary of all the individuals that he/she registered.</p>

<p><strong>Step 4:</strong><br/>
Should the PIC need to make changes to the registration details for one or more individuals, PIC will need to resubmit the Microsoft Excel document containing the person’s full name, e-mail address and the new information on the appropriate fields.</p>

<br/>
<strong>Format:</strong>
<table id="groupFormatInstruction">
	<tbody>
	<tr>
		<td>Column Name</td>
		<td>Description</td>
		<td>Content / Format</td>
	</tr>
	<tr>
		<td><strong><i>registertype</i></strong></td>
		<td><strong><i>Registration Type</i></strong></td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td><strong><i>&nbsp;</i></strong></td>
		<td><strong class="fontDarkRed">Professional Domestic</strong></td>
		<td><strong class="fontDarkRed">PD</strong></td>
	</tr>
	<tr>
		<td><strong><i>&nbsp;</i></strong></td>
		<td><strong class="fontDarkRed">Professional Overseas</strong></td>
		<td><strong class="fontDarkRed">PO</strong></td>
	</tr>
	<tr>
		<td><strong><i>&nbsp;</i></strong></td>
		<td><strong class="fontDarkRed">Student Domestic</strong></td>
		<td><strong class="fontDarkRed">SD</strong></td>
	</tr>
	<tr>
		<td><strong><i>&nbsp;</i></strong></td>
		<td><strong class="fontDarkRed">Student Overseas</strong></td>
		<td><strong class="fontDarkRed">SO</strong></td>
	</tr>
	</tbody>
</table>
<a href="http://www.ipaconvex.com/download/37th IPA Convex - Group Registration Form.xlsx" class="downloadGroupForm registType">Download Group Registration Form in Excel Format</a>



@endsection