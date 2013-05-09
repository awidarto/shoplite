@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open_for_files('employee/picture/'.$id,'POST',array('class'=>'custom'))}}
<div class="row">
  <div class="six columns left">

  	{{ getphoto($doc['_id']) }}

    {{ $form->hidden('id',$doc['_id'])}}
    {{ $form->file('picupload','Upload Picture')}}
    
  </div>
</div>
<hr />
<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2();

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection