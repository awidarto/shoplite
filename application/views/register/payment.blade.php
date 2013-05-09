@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<?php
  $disable = false;
  if($type == 'convention'){
    $typeInverse = 'Golf';
  }else{
    $typeInverse = 'Convention';
  }
?>
@if($user[$type.'PaymentStatus'] == 'pending' || $user[$type.'PaymentStatus'] == 'paid')
  <div class="alert alert-error">
       You already confirmed your {{ $type }} payment
  </div>
  <?php
    $disable = true;
  ?>
@endif


@if( ($golfcount > Config::get('eventreg.golfquota') ) && ($type > Config::get('eventreg.golfquota')) )
<div class="alert alert-error">
     Golf are full
</div>
@endif


{{$form->open_for_files('payment/'.$type,'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('type',$type)}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Attendee Information</legend>

                <div class="row">
                  <span class="labelInline">Salutation</span>
                  <span class="">: {{ $user['salutation'] }}</span>
                </div>
                <div class="row">
                  <span class="labelInline">First Name</span>
                  <span class="">: {{ $user['firstname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Last Name</span>
                  <span class="">: {{ $user['lastname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Position / Division</span>
                  <span class="">: {{ $user['position'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Email</span>
                  <span class="">: {{ $user['email'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Mobile Phone Number</span>
                  <span class="">: {{ $user['mobile'] }}</span>
                </div>
                <br/>
                <br/>

        </fieldset>

        <!--<fieldset>
            <legend>Payment Settlement</legend>

                <div class="row">
                  <span class="labelInline">Salutation</span>
                  <span class="">: {{ $user['salutation'] }}</span>
                </div>
                <div class="row">
                  <span class="labelInline">First Name</span>
                  <span class="">: {{ $user['firstname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Last Name</span>
                  <span class="">: {{ $user['lastname'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Position / Division</span>
                  <span class="">: {{ $user['position'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Email</span>
                  <span class="">: {{ $user['email'] }}</span>
                </div>

                <div class="row">
                  <span class="labelInline">Mobile Phone Number</span>
                  <span class="">: {{ $user['mobile'] }}</span>
                </div>
                <br/>
                <br/>

        </fieldset>-->

        <fieldset>
            @if ($type == 'golf')
              <legend>Golf Payment Information</legend>
            @else
              <legend>Convention Payment Information</legend>
            @endif
                @if($disable == true)
                  {{ $form->text($type.'transferdate','Date Transferred.req','',array('class'=>'text date','id'=>'transferdate','placeholder'=>'yyyy/mm/dd','disabled')) }}
                @else
                  {{ $form->text($type.'transferdate','Date Transferred.req','',array('class'=>'text date','id'=>'transferdate','placeholder'=>'yyyy/mm/dd')) }}
                @endif

                @if($disable == true)
                  {{ $form->text($type.'totalpayment','Total Payment.req','',array('class'=>'text','id'=>'totalpayment','disabled')) }}
                @else
                  {{ $form->text($type.'totalpayment','Total Payment.req','',array('class'=>'text','id'=>'totalpayment')) }}
                @endif



                <h4>Transfer To</h4>
                <span><strong>Bank Transfer</strong></span>
                <div class="row">
                  <div class="six columns mobile-six">
                    <p>
                    @if($disable == true)
                      {{ $form->radio($type.'transferto','IDR Account','BCA - Mangga Dua Branch (IDR Account)',true,array('disabled')) }}<br /><br />
                    @else
                      {{ $form->radio($type.'transferto','IDR Account','BCA - Mangga Dua Branch (IDR Account)',true) }}<br /><br />
                    @endif


                    BCA - Mangga Dua Branch<br/>
                    Acc. No. : 335.302.7677<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    </p>

                    <p>
                    @if($disable == true)
                      {{ $form->radio($type.'transferto','IDR Account','BCA - Mangga Dua Branch (IDR Account)',true,array('disabled')) }}<br /><br />
                    @else
                      {{ $form->radio($type.'transferto','IDR Account','Mandiri - Wisma Nusantara Branch (IDR Account)',false) }}<br /><br />
                    @endif


                    Mandiri - Wisma Nusantara Branch<br/>
                    Acc. No. : 103.000.1065180<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    </p>
                  </div>

                  <div class="six columns mobile-six">
                    <p>
                    @if($disable == true)
                      {{ $form->radio($type.'transferto','USD Account','BCA - Wisma Nusantara Branch (USD Account)',false,array('disabled')) }}<br /><br />
                    @else
                      {{ $form->radio($type.'transferto','USD Account','BCA - Wisma Nusantara Branch (USD Account)') }}<br /><br />
                    @endif


                    BCA - Wisma Nusantara Branch<br/>
                    Acc. No. : 734.038.5700<br/>
                    Acc. Name : PT Dyandra Promosindo<br/>
                    Swiftcode : CENAIDJA
                    </p>
                  </div>
                </div>

                @if($disable == true)
                  {{ $form->text($type.'fromaccountname','Account Name.req','',array('class'=>'text','id'=>'companyphone','disabled')) }}
                @else
                  {{ $form->text($type.'fromaccountname','Account Name.req','',array('class'=>'text','id'=>'companyphone')) }}
                @endif


                <div class="row">
                    <div class="three columns">
                      @if($disable == true)
                        {{ $form->text($type.'fromaccnumber','','',array('class'=>'text','id'=>'zip','placeholder'=>'Account number','disabled')) }}
                      @else
                        {{ $form->text($type.'fromaccnumber','','',array('class'=>'text','id'=>'zip','placeholder'=>'Account number')) }}
                      @endif
                    </div>
                    <div class="seven columns right">
                      @if($disable == true)
                        {{ $form->text($type.'frombank','','',array('class'=>'text','id'=>'city','placeholder'=>'Bank Name','disabled')) }}
                      @else
                        {{ $form->text($type.'frombank','','',array('class'=>'text','id'=>'city','placeholder'=>'Bank Name')) }}
                      @endif
                    </div>
                </div>
        </fieldset>

        <fieldset>
            <legend>Upload Transfer Receipt</legend>

            <div class="row">
              <div class="twelve columns">
                @if($disable == true)
                  {{ $form->file('docupload','Transfer Receipt ( .jpg, .png, .pdf )',array('disabled'=>'disabled'))}}
                @else
                  {{ $form->file('docupload','Transfer Receipt ( .jpg, .png, .pdf )')}}
                @endif
                <br />
              </div>
            </div>

        </fieldset>

        @if( ($user['golfPaymentStatus']=='unpaid' && $user['conventionPaymentStatus']=='unpaid') )
        <fieldset>
            @if($disable == true)
              <label for="checkbox2"><input type="checkbox" style="display: none;" disabled="disabled"><span class="custom checkbox disabled" id="invoiceSame" ></span> Also Confirm {{ $typeInverse }} Payment</label><br/>    
            @else
              <label for="checkbox2"><input type="checkbox" style="display: none;" name="confirmbooth" value="yes"><span class="custom checkbox" id="invoiceSame" ></span> Also Confirm {{ $typeInverse }} Payment</label><br/>
            @endif

        </fieldset>
        @endif
        <!--<fieldset>
            <legend>Important Notes</legend>

              <h4>The registration fee includes:</h4>
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>

              <ol>
                <li>Early Bird rates only valid for both registration and payment received until 15 March 2013 at the latest. Normal rate will be applied for the registration with payment settlement after 15 March 2013.
                  <li>Registration Forms received without registration fees will not be processed.</li>
                  <li>No refund will be granted for cancellation after 14 April 2013. All cancellations must be made in writing to the Secretariat and the
                        refund will be made after the conference.</li>
              </ol>

        </fieldset>-->

    </div>
</div>

<hr />

<div class="row right">
@if( (($user['conventionPaymentStatus'] == 'pending' || $user['conventionPaymentStatus'] == 'paid') && ($type == 'convention')) || (($user['golfPaymentStatus'] == 'pending' || $user['golfPaymentStatus'] == 'paid' || $golfcount > Config::get('eventreg.golfquota')) && ($type == 'golf')) )
  {{ Form::submit('Submit',array('class'=>'button','disabled'))}}&nbsp;&nbsp;
  {{ Form::reset('Reset',array('class'=>'button','disabled'))}}
@else
  {{ Form::submit('Submit',array('class'=>'button'))}}&nbsp;&nbsp;
  {{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
@endif


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