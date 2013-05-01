@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('myprofile/edit','POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('salutation','Mr','Mr')}} 
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
                {{ $form->text('position','Position / Division.req','',array('class'=>'text','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text','id'=>'company')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text','id'=>'company')) }}

                {{ $form->text('companyphone','Phone Number.req','',array('class'=>'text','id'=>'companyphone')) }}
                {{ $form->text('companyfax','Fax Number.req','',array('class'=>'text','id'=>'companyfax')) }}

                {{ $form->text('address','Address.req','',array('class'=>'text','id'=>'address','placeholder'=>'Company Address')) }}

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

        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text invAdress','id'=>'companyNPWPInv')) }}

                {{ $form->text('companyphoneInvoice','Phone Number.req','',array('class'=>'text invAdress','id'=>'companyPhoneInv')) }}
                {{ $form->text('companyfaxInvoice','Fax Number.req','',array('class'=>'text invAdress','id'=>'companyFaxInv')) }}

                {{ $form->text('addressInvoice','Address.req','',array('class'=>'text invAdress','id'=>'addressInv','placeholder'=>'Company Address')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('cityInvoice','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zipInvoice','','',array('class'=>'text invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}

                


        </fieldset>

        <fieldset>
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
        </fieldset>

              <h4>The registration fee includes:</h4>
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>
              

                {{ Form::label('attenddinner','I will attend the Industrial Dinner on 16 May 2012') }}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('attenddinner','Yes','Yes') }} 
                    </div>   
                    <div class="two columns">
                      {{ $form->radio('attenddinner','No','No') }} 
                    </div>   
                    <div class="eight columns"></div>
                </div>

              <hr/>
              <h4>PAYMENT METHOD</h4>
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
              </div>
              <hr/>
              <h4>IMPORTANT NOTES</h4>
              <ol>
                <li>Early Bird rates only valid for both registration and payment received until 15 March 2013 at the latest. Normal rate will be applied for the registration with payment settlement after 15 March 2013.
                  <li>Registration Forms received without registration fees will not be processed.</li>
                  <li>No refund will be granted for cancellation after 14 April 2013. All cancellations must be made in writing to the Secretariat and the
                        refund will be made after the conference.</li>
              </ol>





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