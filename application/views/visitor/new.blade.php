@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('visitor/add','POST',array('class'=>'custom'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr',true)}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('salutation','Ms','Ms')}} 
                    </div>
                    <div class="span6"></div>
                </div>

                {{ $form->text('formnumber','Form No','',array('class'=>'text span8','id'=>'mobile')) }}

                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}
                
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('email','Email','',array('class'=>'text span8','id'=>'email')) }}

                

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'company')) }}

                {{$form->select('role','Visitor Type',Config::get('eventreg.visitors'),array('class'=>'span12'))}}

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'span12'))}}

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
  $("#s2id_field_country").select2("val", "-");

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection