@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('payment/confirm','POST',array('class'=>'custom'))}}
<div class="row">
  <div class="six columns left">
    <!--<h4>Employee Info</h4>-->

    {{ Form::label('salutation','Salutation')}}

      <div class="row">
          <div class="two columns">
            {{ $form->radio('salutation','Mr','Mr',true)}} 
          </div>   
          <div class="two columns">
            {{ $form->radio('salutation','Mrs','Mrs')}} 
          </div>   
          <div class="two columns">
            {{ $form->radio('salutation','Ms','Ms')}} 
          </div>
          <div class="six columns"></div>
      </div>


    {{ $form->text('firstname','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
    {{ $form->text('lastname','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}
    {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'lastname')) }}


    {{ $form->text('fullname','Full Name.req','',array('class'=>'auto_userdata text','id'=>'emp_fullname')) }}
    {{ $form->text('email','Email.req','',array('class'=>'auto_userdatabyemail text','id'=>'emp_email')) }}

    {{ $form->text('userId','System User ID','',array('class'=>'auto_idbyemail text','id'=>'emp_user_id')) }}

    <h4>Employment Info</h4>
    {{ $form->text('employee_jobtitle','Job Title','',array('class'=>'text','id'=>'emp_jobtitle')) }}
    {{ Form::label('Department','department')}}
    {{$form->select('department','',Config::get('kickstart.department'),null,array('class'=>'four','id'=>'emp_department'))}}

  </div>

  <!--<div class="six columns left">
    <h4>Employee Info</h4>
    {{ $form->text('fullname','Full Name.req','',array('class'=>'auto_userdata text','id'=>'emp_fullname')) }}
    {{ $form->text('email','Email.req','',array('class'=>'auto_userdatabyemail text','id'=>'emp_email')) }}

    {{ $form->text('userId','System User ID','',array('class'=>'auto_idbyemail text','id'=>'emp_user_id')) }}

    <h4>Employment Info</h4>
    {{ $form->text('employee_jobtitle','Job Title','',array('class'=>'text','id'=>'emp_jobtitle')) }}
    {{ Form::label('Department','department')}}
    {{$form->select('department','',Config::get('kickstart.department'),null,array('class'=>'four','id'=>'emp_department'))}}

  </div>
  <div class="five columns right">
    <h4>Contact Info</h4>
    {{ $form->text('mobile','Mobile Number','',array('class'=>'text','id'=>'emp_mobile')) }}
    {{ $form->text('home','Home Number','',array('class'=>'text','id'=>'emp_phone')) }}
    {{ $form->textarea('street','Street','',array('class'=>'text','id'=>'emp_street')) }}
    {{ $form->text('city','City','',array('class'=>'text','id'=>'emp_city')) }}
    {{ $form->text('zip','ZIP','',array('class'=>'text','id'=>'emp_zip')) }}

    {{ $form->text('country','Country of Origin','',array('class'=>'text','id'=>'emp_city')) }}

  </div>-->

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