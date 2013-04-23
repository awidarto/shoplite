@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('visitor/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Ms','Ms')}} 
                    </div>
                    <div class="span6"></div>
                </div>

                
                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}
                
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text span8','id'=>'mobile')) }}

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'company')) }}

                {{$form->select('role','Visitor Type',Config::get('eventreg.visitors'),null)}}

                {{$form->select('country','Country of Origin',Config::get('country.countries'),null)}}

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
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