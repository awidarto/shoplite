@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('user/add','POST',array('class'=>'custom'))}}
<div class="row-fluid">
  <div class="span6 left">
    <h4>User Info</h4>
    {{ $form->text('email','Email.req','',array('class'=>'text span8')) }}
    {{ $form->text('fullname','Full Name.req','',array('class'=>'text span8')) }}
    {{ $form->password('pass','Password','',array('class'=>'text span8')) }}
    {{ $form->password('repass','Repeat Password','',array('class'=>'text span8')) }}

    <h4>Access Control</h4>
    <div class="row-fluid">
      <div class="span12">
        <h5>Role</h5>
        {{$form->select('role','',Config::get('acl.roles'),null)}}
      </div>
    </div>

  </div>
  <div class="span5 right">
    <h4>Contact Info</h4>
    {{ $form->text('mobile','Mobile Number','',array('class'=>'text span8')) }}
    {{ $form->text('home','Home Number','',array('class'=>'text span8')) }}
    {{ $form->textarea('street','Street','',array('class'=>'text span8')) }}

    <div class="row-fluid inputInline">
            {{ $form->text('city','','',array('class'=>'text span12','id'=>'city','placeholder'=>'City')) }}
            {{ $form->text('zip','','',array('class'=>'text span3','id'=>'zip','placeholder'=>'ZIP Code')) }}
    </div>


  </div>
</div>
<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2({
    width : 'resolve'
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection