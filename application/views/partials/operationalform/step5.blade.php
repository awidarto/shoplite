<h2 class="StepTitle">FASCIA NAME (STANDARD BOOTH ONLY)</h2>

@if(isset($data['submitform4']) && $data['submitform4'] == 'true')
  <div class="alert alert-warning insideform">
    Form #4 already submitted .
  </div>
  <div class="disableforminput">
@endif

<div id="boothcontractor">
  <br/>
  <p>If your company wishes to order standard booth construction (standard shell scheme), the package will include:</p>
  {{ HTML::image('images/exhibitor/stdBooth.png','',array('class'=>'booothImage')) }}
  <ol class="left boothDetail">
    <li>Wall partition (1mL x 2.49mH) for in-line / <br/>standard (non-corner) booth </li>
    <li>Aluminum system fascia board (0.35mH)  </li>
    <li>2 (two) units standard folded chairs. </li>
    <li>1 MCB 2A/Single/Phase and 1 single electrical power outlet </li>
    <li>1 (one) aluminum system reception desk <br/>(1.030mL x 0.50mW x 0.75mH)  </li>
    <li>Standard light illumination.  </li>
    <li>1 (one) waste paper basket </li>
    <li>Standard carpet </li>
    <li>1 (one) Standing Brochure Rack A4 </li>
    
  </ol>
  <div class="clear"></div>
  <p>*the final design for the standard booth shell will be informed later.</p>
  
  Please write down the company’s name you wish to appear on the fascia name (maximum 26 characters).<br/><br/>
  {{ $form->text('fascianame','','',array('id'=>'fascianame','class'=>'blockDisplay')) }}
  <div class="clear"></div>
  <span id="text_counter"></span>
  <br/>
  <small>* Please inform us if you have special enquiries for your standard shell scheme. Additional / custom requirements will be charged separately</small>
  <br/>
  <br/>
  @if(!isset($data['submitform4']) || $data['submitform4']!='true')
    <div class="clear"></div>
    <a href="#" id="submitform4" class="buttonSubmitIndividual">Submit Form 4</a>
  @endif
</div> 

@if(isset($data['submitform4'])&& $data['submitform4'] == 'true')
  </div>
@endif