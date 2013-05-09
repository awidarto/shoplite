@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('user/pass/'.$doc['_id'],'POST',array('class'=>'custom'))}}
<div class="row">
  <div class="five columns left">
    {{ $form->hidden('id',$doc['_id'])}}

    {{ $form->password('pass','New Password','',array('class'=>'text')) }}
    {{ $form->password('repass','Repeat Password','',array('class'=>'text')) }}

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