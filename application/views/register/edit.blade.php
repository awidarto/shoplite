@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('myprofile/edit','POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}
    {{ $form->hidden('attenddinner',$user['attenddinner'])}}
    {{ $form->hidden('regtype',$user['regtype'])}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Personal Information</legend>

                <table class="profile-info">
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
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text','id'=>'company')) }}

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

                <!--{{ Form::label('invoiceaddress','Invoice address same with Company Address ?') }}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','Yes','Yes') }} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','No','No') }} 
                    </div>   
                    <div class="eight columns"></div>
                </div>-->


        </fieldset>
        @if ( isset($user['cache_obj']) && $user['cache_obj']== '')
        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text invAdress','id'=>'companyNPWPInv')) }}

                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyphoneInvoiceCountry','','',array('class'=>'text','id'=>'companyPhoneInvCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyphoneInvoiceArea','','',array('class'=>'text','id'=>'companyPhoneInvArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyphoneInvoice','','',array('class'=>'text invAdress','id'=>'companyPhoneInv','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyfaxInvoiceCountry','','',array('class'=>'text','id'=>'companyFaxInvCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyfaxInvoiceArea','','',array('class'=>'text','id'=>'companyFaxInvArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyfaxInvoice','','',array('class'=>'text','id'=>'companyFaxInv','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ $form->text('addressInvoice_1','Address.req','',array('class'=>'text invAdress','id'=>'addressInv_1','placeholder'=>'Company Address')) }}
                {{ $form->text('addressInvoice_2','','',array('class'=>'text invAdress','id'=>'addressInv_2')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('cityInvoice','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zipInvoice','','',array('class'=>'text invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>
                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),null,array('class'=>'four'))}}
        </fieldset>
        @else
        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->textarea('invoice_address_conv','','',array('class'=>'text invAdress','id'=>'companyNameInv')) }}
        </fieldset>
        @endif

        <!--<fieldset>
            <legend>Registration Type</legend>
                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Domestic
                    </div>   
                    <div class="four columns">
                      {{ $form->radio('regtype','IDR 4.500.000','PD') }} 
                    </div>   
                    <div class="four columns"></div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Overseas
                    </div>   
                    <div class="four columns">
                      {{ $form->radio('regtype','USD 500','PO') }} 
                    </div>   
                    <div class="four columns"></div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Student Domestic
                    </div>   
                    <div class="four columns">
                      {{ $form->radio('regtype','IDR 400.000','SD') }} 
                    </div>   
                    <div class="four columns"></div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Student Overseas
                    </div>   
                    <div class="four columns">
                      {{ $form->radio('regtype','USD 120','SO') }} 
                    </div>   
                    <div class="four columns"></div>
                </div>
        </fieldset>-->

              <!--<h4>The registration fee includes:</h4>
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>
              

                <!--{{ Form::label('attenddinner','I will attend the Industrial Dinner on 16 May 2012') }}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('attenddinner','Yes','Yes') }} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('attenddinner','No','No') }} 
                    </div>   
                    <div class="eight columns"></div>
                </div>

              <hr/>-->
              <!--<h4>PAYMENT METHOD</h4>
              <span><strong>Bank Transfer</strong></span>
              <div class="row">
                <div class="six columns mobile-six">
                  <p><strong>IDR Account:</strong><br/>
                  BCA - Mangga Dua Branch<br/>
                  Acc. No. : 335.302.7677<br/>
                  Acc. Name : PT Dyandra Promosindo<br/>
                  </p>
                </div>

                <div class="six columns mobile-six">
                  <p><strong>USD Account:</strong><br/>
                  BCA - Wisma Nusantara Branch<br/>
                  Acc. No. : 734.038.5700<br/>
                  Acc. Name : PT Dyandra Promosindo<br/>
                  Swiftcode : CENAIDJA
                  </p>
                </div>
              </div>-->
              
              





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