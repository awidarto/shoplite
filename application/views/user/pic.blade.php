@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open_for_files('user/picture/'.$id,'POST',array('class'=>'custom'))}}
<div class="row">
  <div class="six columns left">

  	{{ getavatar($doc['_id']) }}

    {{ $form->hidden('id',$doc['_id'])}}
    {{ $form->file('picupload','Upload Picture')}}
    
  </div>
</div>
<hr />
<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
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