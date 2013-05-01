<h2 class="StepTitle">BOOTH CONTRACTOR (SPECIAL DESIGN ONLY)</h2>
  
  @if(isset($data['submitform3']) && $data['submitform3'] == 'true')
      <div class="alert alert-warning insideform">
        Form #3 already submitted .
      </div>
  @endif   
  <div id="boothcontractor">
    
    <br/>
    
    <p>We, the exhibitor, hereby inform the detail of the contractor that will be accountable and responsible for our booth construction: </p>
    {{ $form->text('companyContractor','Contractor Company','',array('class'=>'text','id'=>'firstname')) }}
    <div class="clear"></div>
    {{ $form->text('picContractor','Person in Charge','',array('class'=>'text')) }}
    <div class="clear"></div>
    {{ $form->text('adress','Address','',array('class'=>'text')) }}
    <div class="clear"></div>
    {{ $form->text('phone','Phone','',array('class'=>'text')) }}
    <div class="clear"></div>
    {{ $form->text('fax','Fax','',array('class'=>'text')) }}
    <div class="clear"></div>
    {{ $form->text('mobile','Mobile Phone','',array('class'=>'text')) }}
    <div class="clear"></div>
    {{ $form->text('email','Email','',array('class'=>'text')) }}
    <div class="clear"></div>
    <br/>
    <div class="containerdownloadWorkerForm">
      <?php  $urlXLS = URL::to_asset('37th-IPA-Worker-Registration-Form.xlsx'); ?>
      {{ HTML::link($urlXLS,'Download Working Pass ID.xls',array('class'=>'downloadWorkerForm registType'))}}
      <small>*please email the names of the working pass ID holder to your PO hall (as in page 1)</small>
    </div>
    <div>
      We (as the exhibitor) assure that:<br/>
      <ol>
        <li>We hereby agree to comply with the Organizing Committee’s terms and conditions. </li>
        <li>We shall be responsible for any damage of the exhibition’s venue caused by our booth construction, displayed products/materials, or casualties/injuries that reflects our negligence on safety and security.</li>
        <li>We agree to pay 50% of the total value stated in the application form (Form A) should our design and construction violate the rule and regulation as intended in the exhibition manual book</li>
      </ol>
    </div>
    <hr/>
    <br/>
    <br/>
    <div class="terms">
       <strong>Terms & Conditions:</strong>
        <ol>
          <li>The exhibitor or booth contractor must submit a copy of complete booth design before  <strong>15 April 2013</strong></li>
          <li>The design must be approved both by the organizer and IPA committee before going to production phase.</li>
          <li>Personal protective equipment (PPE) is obligatory for contractors during Set Up and Dismantling period.</li>
        </ol>
    </div>

    

  </div>