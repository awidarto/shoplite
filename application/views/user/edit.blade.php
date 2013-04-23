@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('user/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}
<div class="row-fluid">
  <div class="span6 left">
    <h4>User Info</h4>
    {{ $form->text('email','Email.req','',array('class'=>'text span8')) }}
    {{ $form->text('fullname','Full Name.req','',array('class'=>'text span8')) }}

    <h4>Access Control</h4>
    <div class="row-fluid">
      <div class="span12">
        <h5>Role</h5>
        {{ $form->select('role','',Config::get('acl.roles'),null,array('class'=>'span6'))}}
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
<hr />
<div class="row-fluid right">
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