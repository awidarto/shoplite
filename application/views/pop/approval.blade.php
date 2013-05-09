@layout('dialog')

@section('content')

<div class="row fileviewer-container">
	<div class="twelve columns">
		<iframe class="fileviewer" src="{{$href}}" width="100%" height="100%"></iframe>
	</div>
</div>

{{$form->open('','GET',array('class'=>'custom','id'=>'approve'))}}
	<h4>Document Approval</h4>
	<div class="row approval-container">
	  	<div class="three columns">
		    {{ $form->radio('approve','Approve','yes')}} 
		    {{ $form->radio('approve','Not Approve','no')}} 
		</div>   
		<div class="six columns">
		    {{ $form->textarea('note','Note','',array('class'=>'eleven','id'=>'pass', 'rows'=>'4')) }}
		</div>	    
		<div class="three columns">
			{{ $form->text('pass','Password.req','',array('class'=>'text')) }}
			{{ Form::button('OK',array('class'=>'button'))}}&nbsp;&nbsp;
			{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
		</div>
	</div>    
{{$form->close()}}


@endsection

