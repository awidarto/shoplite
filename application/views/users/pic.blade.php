@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom'))}}
<div class="row-fluid">
  <div class="span1">
    {{ getavatar($doc['_id'],$doc['fullname'],'span12') }}
  </div>
  <div class="span11">

    {{ $form->hidden('id',$doc['_id'])}}
    {{ $form->file('picupload','Select New Picture')}}
    
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

  $(":file").filestyle({
    classButton: 'uploader',
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection