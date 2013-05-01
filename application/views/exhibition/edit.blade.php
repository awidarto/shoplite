@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('exhibitor/profile/edit','POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Personal Information</legend>

                <table class="profile-info">
                  <tr>
                    <td class="detail-title">Hall : </td>
                    <td>:&nbsp;</td>
                    <td class="detail-info">{{ $user['hall'] }}</td>
                  </tr>
                  <tr>
                    <td class="detail-title">Booth No. : </td>
                    <td>:&nbsp;</td>
                    <td class="detail-info">{{ $user['booth'] }}</td>
                  </tr>


                  <tr>
                    <td class="detail-title">Salutation : </td>
                    <td>:&nbsp;</td>
                    <td class="detail-info">{{ $user['salutation'] }}</td>
                  </tr>
                  <tr>
                    <td class="detail-title">First Name : </td>
                    <td>:&nbsp;</td>
                    <td class="detail-info">{{ $user['firstname'] }}</td>
                  </tr>
                  <tr>
                    <td class="detail-title">Last Name : </td>
                    <td>:&nbsp;</td>
                    <td class="detail-info">{{ $user['lastname'] }}</td>
                  </tr>
                </table>
                
                {{ $form->text('position','Position / Division.req','',array('class'=>'text','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text','id'=>'company')) }}

                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyphonecountry','','',array('class'=>'text','id'=>'companyPhoneCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyphonearea','','',array('class'=>'text','id'=>'companyPhoneArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyphone','','',array('class'=>'text','id'=>'companyPhone','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyfaxcountry','','',array('class'=>'text','id'=>'companyFaxCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyfaxarea','','',array('class'=>'text','id'=>'companyFaxArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyfax','','',array('class'=>'text','id'=>'companyFax','placeholder'=>'Phone Number')) }}
                  </div>
                </div>


                {{ $form->text('address_1','Address.req','',array('class'=>'text','id'=>'address_1','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text','id'=>'address_2')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('city','','',array('class'=>'text','id'=>'city','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zip','','',array('class'=>'text','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),null,array('class'=>'four'))}}
        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save Changes',array('class'=>'button'))}}&nbsp;&nbsp;
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