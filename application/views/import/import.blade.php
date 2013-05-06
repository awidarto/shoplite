@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open_for_files('import/preview','POST',array('class'=>'custom'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
<fieldset>
            <legend>Person In Charge Information</legend>

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


                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}

                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('position','Position / Division.req','',array('class'=>'text span8','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text span8','id'=>'mobile')) }}

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'company')) }}

                {{ $form->text('address_1','Address.req','',array('class'=>'text span9','id'=>'address','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text span9','id'=>'address','placeholder'=>'')) }}


                <div class="row-fluid inputInline">

                        {{ $form->text('city','','',array('class'=>'text span12','id'=>'city','placeholder'=>'City')) }}

                        {{ $form->text('zip','','',array('class'=>'text span3','id'=>'zip','placeholder'=>'ZIP Code')) }}

                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'span12'))}}

        </fieldset>

        <fieldset>
            <legend>Excel File to Upload</legend>

            {{ $form->file('docupload','Excel File')}}

        </fieldset>

        <fieldset>
            <legend>Registran Group Set</legend>
            {{ $form->hidden('groupId','',array('id'=>'groupid'))}}
            {{ $form->text('groupName','Group Name ( autocomplete, use PIC name or company to search )','',array('id'=>'groupname','class'=>'auto_group span8'))}}
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
  $("#s2id_field_country").select2("val", "Indonesia");
</script>

@endsection