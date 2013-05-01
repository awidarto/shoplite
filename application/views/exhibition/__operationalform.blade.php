@layout('publicnoside')
@section('content')
<div class="tableHeader">
    <h3>{{$title}}</h3>
</div>
{{$form->open('exhibition/operationalform','POST',array('class'=>'addAttendeeForm'))}}
<div id="wizard" class="swMain">
  <ul>
    <li><a href="#step-1">
          <small>step</small>
          <label class="stepNumber">1</label>
      </a></li>
    <li><a href="#step-2">
          <small>step</small>
          <label class="stepNumber">2</label>
      </a></li>
    <li><a href="#step-3">
          <small>step</small>
          <label class="stepNumber">3</label>
       </a></li>
    <li><a href="#step-4">
          <small>step</small>
          <label class="stepNumber">4</label>
      </a>
    </li>
    <li>
      <a href="#step-5">
          <small>step</small>
          <label class="stepNumber">5</label>
      </a>
    </li>
    <li>
      <a href="#step-6">
          <small>step</small>
          <label class="stepNumber">6</label>
      </a>
    </li>
    <li>
      <a href="#step-7">
          <small>step</small>
          <label class="stepNumber">7</label>
      </a>
    </li>
    <li>
      <a href="#step-8">
          <small>step</small>
          <label class="stepNumber">8</label>
      </a>
    </li>
    <li>
      <a href="#step-9">
          <small>step</small>
          <label class="stepNumber">9</label>
      </a>
    </li>
    <li>
      <a href="#step-10">
          <small>step</small>
          <label class="stepNumber">10</label>
      </a>
    </li>
    <li>
      <a href="#step-11">
          <small>step</small>
          <label class="stepNumber">11</label>
      </a>
    </li>
    <li>
      <a href="#step-12">
          <small>step</small>
          <label class="stepNumber">12</label>
      </a>
    </li>
    <li>
      <a href="#step-13">
          <small>step</small>
          <label class="stepNumber">13</label>
      </a>
    </li>
    <li>
      <a href="#step-14">
          <small>step</small>
          <label class="stepNumber">14</label>
      </a>
    </li>

  </ul>

  <div id="step-1">
   <h2 class="StepTitle"></h2>
    <div id="page-wrap">
      <div id="boothcontractor">
          <h4>Terms & Conditions:</h4>
          <ol>
            <li>Please check your booth requirements  to your booth contractor or organizer.</li>
            <li>Only filled the required forms.</li>
            <li>Remember only to submit if your requirements are final. <strong>The forms cannot be modified if already submitted.</strong></li>
            <li>The organizer will issue an invoice of the total amount of the additional facilities request based on filled forms after the exhibitors finalize it.</li>
            <li><strong>On-site orders will be subject to 10% surcharge and must be paid in cash.</strong></li>
          </ol>
      </div>
      <table id="order-table" class="withborder">
        <tr>
          <th colspan="4">USEFUL CONTACTS</th>
        </tr>
        <tr class="odd">
          <td rowspan="2">1.</td>
          <td rowspan="2">Main Lobby</td>
          <td>Trisa</td>
          <td>trisa@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Rachel</td>
          <td>rachel.pardede@dyandra.com</td>
        </tr>

        <tr class="odd">
          <td rowspan="2">2.</td>
          <td rowspan="2">Assembly Hall</td>
          <td>Trias </td>
          <td>trias.nugrahasanah@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Talitha</td>
          <td>talitha.sabrina@dyandra.com</td>
        </tr>

         <tr class="odd">
          <td rowspan="2">3.</td>
          <td rowspan="2">Cendrawasih Room</td>
          <td>Dian</td>
          <td>dian@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Anita</td>
          <td>anita.afriani@dyandra.com</td>
        </tr>
         

        <tr class="odd">
          <td>4.</td>
          <td>Hall A</td>
          <td>Tia</td>
          <td>tia.hamidah@dyandra.com</td>
        </tr>
        
        <tr class="odd">
          <td rowspan="2">5.</td>
          <td rowspan="2">Hall B / Operasional</td>
          <td>Raymond</td>
          <td>raymond@dyandra.com</td>
        </tr>
        <tr class="odd">
          <td>Rain</td>
          <td>rain.januardo@dyandra.com</td>
        </tr>
        
      </table>
      <br/>
      <br/>
      <br/>
    </div>
  </div>

  <div id="step-2">

    <h2 class="StepTitle">ELECTRICITY INSTALLATION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>ELECTRICITY</th> 
                 <th>PRICE (USD)</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title">2A / 1 ph / 440 Watt</td>
                <td class="price-per-pallet">USD <span>79</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="sparkle-num-pallets" name="electric1"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric1"></input>
                </td>
                
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title">4A / 1 ph / 880 Watt</td>
                <td class="price-per-pallet">USD <span>158</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mvp-num-pallets" name="electric2"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mvp-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric2"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>3</td>
                <td class="product-title">6A / 1 ph / 1.320 Watt</td>
                <td class="price-per-pallet">USD <span>236</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-pro-league-num-pallets" name="electric3"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-pro-league-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric3"></input>
                </td>
            </tr>
           
            <tr class="odd">
                <td>4</td>
                <td class="product-title">10A / 1 ph / 2.200 Watt</em></td>
                <td class="price-per-pallet">USD <span>393</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-quick-dry-num-pallets" name="electric4"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-quick-dry-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric4"></input>
                </td>
            </tr>
            <tr class="even">
                <td>5</td>
                <td class="product-title">16A / 1 ph / 3.520 Watt</td>
                <td class="price-per-pallet">USD <span>629</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mound-clay-red-num-pallets" name="electric5"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="turface-mound-clay-red-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric5"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>6</td>
                <td class="product-title">32A / 1 ph / 7.040 Watt</td>
                <td class="price-per-pallet">USD <span>1257</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-red-num-pallets" name="electric6"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-red-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric6"></input>
                </td>
            </tr>
            <tr class="even">
                <td>7</td>
                <td class="product-title">16A / 3 ph / 10.560 Watt</td>
                <td class="price-per-pallet">USD <span>1886</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-drying-agent-num-pallets" name="electric7"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-drying-agent-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric7"></input>
                </td>
            </tr>
            <tr class="odd">
                <td>8</td>
                <td class="product-title">32A / 3 ph / 21.120 Watt</em></td>
                <td class="price-per-pallet">USD <span>3772</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-professional-num-pallets" name="electric8"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-professional-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric8"></input>
                </td>
            </tr>
            <tr class="even">
                <td>9</td>
                <td class="product-title">60A / 3 ph / 39.600 Watt</td>
                <td class="price-per-pallet">USD <span>7072</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-top-dressing-num-pallets" name="electric9"></input></td>
                <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-top-dressing-row-total" disabled="disabled"></input>
                  <input type="hidden" class="" id="sparkle-row-total" name="rowelectric9"></input>

                </td>
            </tr>
            <!--<tr>
                <td colspan="5" style="text-align: right;">
                    Product SUBTOTAL: <input type="text" class="total-box" value="$0" id="product-subtotal" disabled="disabled"></input>
                </td>
            </tr>-->
        </table>

        <table id="operationalfee" class="orderform">
            <tr>
                 <th class="instalationfee" colspan"2">INSTALLATION FEE*</th> 
                 <th class="priceinstall">PRICE (USD)</th>
                 <th class="qinstall">QUANTITY</th>
                 <th class="subinstall" style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td class="instalationfee" colspan"2" style="padding-left:30px;">Installation fee</td>
                <td class="textcentertable">USD 23</td>
                <td class="textcentertable">1</td>
                <td class="textcentertable">USD 23</td>
                <input type="hidden" id="operationalfeeelectric" value="23" name="electricinstallfee"></input>
            </tr>
        </table>

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="product-subtotal"></span></td>
            <input type="hidden" id="electricsubtotal" name="electricsubtotal"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriclate" name="electriclate"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriconsite" name="electriconsite"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="product-tax"></span></td>
            <input type="hidden" id="electrictax" name="electrictax"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="order-total"></span></td>
            <input type="hidden" id="electricgrandtotal" name="electricgrandtotal"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Every order of the electricity power will be charged with Installation fee. </li>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm.</li>
              <li>Every on-site order request for electricity installation must be paid in cash.</li>
              <li>24 hours electrical requirement will be charged double.</li>
              <li>Orders without payment will not be executed.</li>
              <li>As stocks are limited, late orders will be subjected to a 30% surcharge after 14 April 2013 and 50% surcharge for onsite orders.</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-3">
    <h2 class="StepTitle">TELEPHONE INSTALLATION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>TELEPHONE TYPE</th> 
                 <th>PRICE/UNIT</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title"><strong>Dial 9</strong><br/>
                • Service coverage: local call only (within Jakarta).<br/>
                • Price includes call credit & installation.
                </td>
                <td class="price-per-pallet">USD <span>250</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="sparkle-num-pallets" name="phone1"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-phone" id="sparkle-row-total" disabled="disabled"></input>
                  <input type="hidden" class="row-total-input" id="" name="rowphone1"></input>
                </td>
            </tr>
            <tr class="even">
                <td>2</td>
                <td class="product-title"><Strong>Hotline</strong><br/>
                • Service coverage: local, national, mobile phone, credit or debit card authorization.<br/>
                • Commonly used for EDC / credit card purchasing.<br/>
                • Price includes call credit & installation.<br/>
                • Call back is not applicable.<br/></td>
                
                <td class="price-per-pallet">USD <span>400</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="turface-mvp-num-pallets" name="phone2"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-phone" id="turface-mvp-row-total" disabled="disabled"></input>
                  <input type="hidden" class="row-total-input" id="" name="rowphone2"></input>
                </td>
            </tr>
            
        </table>

        <table class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalPhone"></span></td>
            <input type="hidden" class="" id="phonesubtotal" name="phonesubtotal"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phonelate"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phoneonsite"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalPhone"></span></td>
            <input type="hidden" class="" id="phonetax" name="phonetax"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalPhone"></span></td>
            <input type="hidden" class="" id="phonegrandtotal" name="phonegrandtotal"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm. </li>
              <li>Please submit a drawing which indicates specific location for the telephone.</li>
              <li>Telephone handset must be returned after the exhibition ends</li>
              <li>On-site order for telephone cannot be granted</li>
              <li>Orders without payment will not be executed</li>
              <li>As stocks are limited, late orders will be subject to a 30% surcharge after 14 April 2013</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-4">
      <h2 class="StepTitle">BOOTH CONTRACTOR (SPECIAL DESIGN ONLY)</h2>   
      <div id="boothcontractor">
        <br/>
        <p>I (as the exhibitor) hereby inform you the details of contractor that will be responsible for my booth construction:</p>
        {{ $form->text('companyContractor','Company','',array('class'=>'text','id'=>'firstname')) }}
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
        <div>
          We (as the exhibitor) assure that:<br/>
          <ol>
            <li>We hereby agree to comply with the Organizing Committee Terms and Conditions regarding Personnel Protective  Equipment</li>
            <li>We shall be responsible for any damages of the exhibition venue caused by our booth construction, displayed products/materials, or casualties/injuries that reflects our negligence on safety and security.</li>
            <li>We shall pay 50% from the total value on the application form (Form A) if our design and construction breaks the rule and regulation written on the exhibition manual book.</li>
          </ol>
        </div>
        <hr/>
        <br/>
        <br/>
        <div class="terms">
           <strong>Terms & Conditions:</strong>
            <ol>
              <li>Exhibitor or booth contractor must submit a copy of complete booth design before <strong>14 April 2013</strong></li>
              <li>The design must be approved both by the organizer and IPA committee before going to production phase.</li>
              <li>Contractors are obliged to wear contractor’s own uniform during Set Up and Dismantling period.</li>
            </ol>
        </div>

      </div>
  </div>

  <div id="step-5">
    <h2 class="StepTitle">FASCIA NAME (STANDARD BOOTH ONLY)</h2>   
    <div id="boothcontractor">
      <br/>
      <p>If your company will be using standard booth (standard shell scheme) as illustrated below:</p>
      {{ HTML::image('images/exhibitor/stdBooth.png','',array('class'=>'booothImage')) }}
      <ol class="left boothDetail">
        <li>Wall partition (1mL x 2.49mH) for in-line / <br/>standard (non-corner) booth </li>
        <li>Aluminum system fascia board (0.35mH)  </li>
        <li>2 (two) units standard folded chairs. </li>
        <li>1 MCB 2A/Single/Phase and 1 single electrical power outlet </li>
        <li>1 (one) aluminum system reception desk <br/>(1.030mL x 0.50mW x 0.75mH)  </li>
        <li>Standard light illumination.  </li>
        <li>1 (one) waste paper basket </li>
        <li>Needle punch carpet (grey colors) </li>
        <li>1 (one) Standing Brochure Rack A4 </li>
        <li>Additional / costum requirements will be charged separately</li>
      </ol>
      <div class="clear"></div>
      Please write the company name to appear on fascia name (maximum 26 characters).<br/><br/>
      {{ $form->text('fascianame','','',array('id'=>'fascianame','class'=>'blockDisplay')) }}
      <div class="clear"></div>
      <span id="text_counter"></span>
      <br/>
      <small>* Please fill-in the details by typing in block letters, the organizer won’t be held responsible for illegible handwriting.</small><br/>
      <small>* Please inform us, if you have special enquiries for your standard shell booth.</small>
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-6">
    <h2 class="StepTitle">FREE EXHIBITOR PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <p>Exhibitors have an entitlement for a certain number of free “Barcode ID CARD” as indicated here-below:</p>
      <table class="regularTable exhibitorpass">
        <tr>
          <td style="width:30px;">9</td>
          <td style="width:150px;">Sqm booth space for</td>
          <td style="width:20px;">:</td>
          <td style="width:30px;">2</td>
          <td >people</td>
        </tr>
        <tr>
          <td>18</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>4</td>
          <td>people</td>
        </tr>
        <tr>
          <td>27</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>6</td>
          <td>people</td>
        </tr>
        <tr>
          <td>36</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>8</td>
          <td>people</td>
        </tr>
        <tr>
          <td>45</td>
          <td>Sqm booth space for</td>
          <td>:</td>
          <td>10</td>
          <td>people</td>
        </tr>
      </table>
      <div class="clear"></div>
      <p>Please list below the names of EXHIBITOR’S FREE PASS HOLDERS you wish to register and send by email to the hall PIC(s)</p>
      <table id="order-table">
        <thead>
          <tr>
            <th>No.</th>            
            <th>Names of Exhibitor’s Free Pass Holders</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1. </td>
            <td><input name="freepassname1" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>2. </td>
            <td><input name="freepassname2" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>3. </td>
            <td><input name="freepassname3" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>4. </td>
            <td><input name="freepassname4" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>5. </td>
            <td><input name="freepassname5" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>6. </td>
            <td><input name="freepassname6" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>7. </td>
            <td><input name="freepassname7" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>8. </td>
            <td><input name="freepassname8" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>9. </td>
            <td><input name="freepassname9" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>10. </td>
            <td><input name="freepassname10" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
        </tbody>
      </table>
      <br/>
      <strong>Terms & Conditions:</strong><br/>
      <ol>
        <li>Exhibitor Pass entitled lunch and coffee break during 3 days of exhibition</li>
        <li>Exhibitor pass (ID Card) does not include free entry to the <strong>Conference‘s Plenary Session, but can attend the TPC</strong></li>
      </ol>
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-7">
    <h2 class="StepTitle">BOOTH ASSISTANT PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <h4>Terms & Conditions:</h4>
      <ol>
        <li>Booth Assistant's Pass is valid for 3 days. </li>
        <li>Booth Assistant's Pass are permitted to assist Exhibitor in Exhibition areas only, and is <strong>not entitled to participate on the Conference‘s Plenary Session nor the  TPC.</strong></li>
        <li>Booth assistants Pass are free of charge (include coffee break, exclude lunch) at the maximum of 10 persons.</li>
        <li>More than 10 will be charged USD 35 per pass (include coffee break, exclude lunch)</li>
        <li>There is no limit to the purchase of the number of Additional Booth Assistant(s).</li>
      </ol>
      <p><strong>Please list below the names of BOOTH ASSISTANT PASS HOLDERS you wish to register and send by email to the hall PIC(s)</strong></p>
      <div class="clear"></div>      
      <table id="order-table">
        <thead>
          <tr>
            <th>No.</th>            
            <th>Names of Booth Assistant Pass Holders</th>
          </tr>
        </thead>
        <tbody id="listadditionalbooth">
          <tr>
            <td>1. </td>
            <td><input name="boothassistant1" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>2. </td>
            <td><input name="boothassistant2" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>3. </td>
            <td><input name="boothassistant3" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>4. </td>
            <td><input name="boothassistant4" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>5. </td>
            <td><input name="boothassistant5" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>6. </td>
            <td><input name="boothassistant6" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>7. </td>
            <td><input name="boothassistant7" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>8. </td>
            <td><input name="boothassistant8" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>9. </td>
            <td><input name="boothassistant9" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <tr>
            <td>10. </td>
            <td><input name="boothassistant10" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>
          </tr>
          <input name="noaddpass" id="noaddpass" type="hidden" value="10"></input>
        </tbody>
      </table>
      <a href="javascript:void(0);" id="add-field" class="buttonBrown">Add field</a>
      
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-8">
    <h2 class="StepTitle">ADDITIONAL EXHIBITOR PASS</h2>   
    <div id="boothcontractor">
      <br/>
      <h4>Terms & Conditions:</h4>
      <ol>
        <li>Additional Booth Assistant(s) pass is charged USD 35 per pass (include coffee break, exclude lunch)</li>
        <li>Additional Booth Assistant(s) is valid for 3 days. </li>
        <li>Additional Booth Assistant(s)  Pass are permitted to assist Exhibitor in Exhibition areas only, and is <strong>not entitled to participate on the Conference‘s Plenary Session nor the TPC.</strong></li>
        <li>Booth assistants are free of charge (include coffee break, exclude lunch) at the maximum of 10 persons.</li>
      </ol>

      <table id="order-table">
          <tr>
               <th>Price/UNIT</th>
               <th>QUANTITY</th>
               <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
          </tr>
          <tr class="odd">
              
              <td class="price-per-pallet">USD <span>35</span></td>
              <td class="num-pallets"><input type="text" class="num-pallets-input-phone" name="totaladdbooth" id="totaladdboothinput"></input></td>
              <td class="row-total" style="text-align:right;float:right;"><input type="text" class="row-total-input-addBooth" id="sparkle-row-total" disabled="disabled"></input>
                <input type="hidden" class="row-total-input" id="" name="rowaddbooth"></input>
              </td>
          </tr>
          
          
      </table>

      

      <table id="total-addbooth" class="total-table">
        <tr>
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalAddbooth"></span></td>
          <input type="hidden" class="" id="addboothsubtotal" name="addboothsubtotal"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothlate"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothonsite"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
          <td class="result">USD<span id="faxTotalAddbooth"></span></td>
          <input type="hidden" class="" id="addboothtax" name="addboothtax"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Grand Total</td>
          <td class="result">USD<span id="grandTotalAddbooth"></span></td>
          <input type="hidden" class="" id="addboothgrandtotal" name="addboothgrandtotal"></input>
        </tr>
      </table>
      <div class="clear"></div>
      <br/>
      <br/>
      <p><strong>Please list below the names of Additional Booth Assistant you wish to register and return by email to each Hall PIC(s).</strong></p>
      <div class="clear"></div>
      <table id="order-table">
        <thead>
          <tr>
            <th style="width:150px;">No.</th>
            <th>Names of Additional Booth Assistant Pass Holders</th>
          </tr>
        </thead>
        <tbody id="listaddbooth">
          
          
        </tbody>
      </table>
      
      <br/>
      <br/>
    </div>                     
  </div>

  <div id="step-9">
    <h2 class="StepTitle">BOOTH PROGRAM SCHEDULE</h2>   
    <div id="boothcontractor">
      <br/>
      <p>In order to ensure the best possible environment for exhibitors and attendees, please indicate here-below the activities that you intend to hold during the exhibition</p>
      <div class="clear"></div>
      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Booth Program</th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td><input name="programdetail1" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate1"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime1"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>2.</td>
            <td><input name="programdetail2" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate2"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime2"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>3.</td>
            <td><input name="programdetail3" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate3"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime3"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>4.</td>
            <td><input name="programdetail4" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate4"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime4"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>5.</td>
            <td><input name="programdetail5" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate5"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime5"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>6.</td>
            <td><input name="programdetail6" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="programdate6"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="programtime6"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
        </tbody>
      </table>


      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Cocktail Party Program</th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td><input name="cocktaildetail1" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="cocktaildate1"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="cocktailtime1"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>2.</td>
            <td><input name="cocktaildetail2" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="cocktaildate2"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="cocktailtime2"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>3.</td>
            <td><input name="cocktaildetail3" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="cocktaildate3"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="cocktailtime3"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          <tr>
            <td>4.</td>
            <td><input name="cocktaildetail4" type="text" class="passholderbooth" id="" placeholder="Details here"></input></td>
            <td><input name="cocktaildate4"   type="text" class="passholderbooth date" id="" placeholder="dd-mm-yyyy"></input></td>
            <td><input name="cocktailtime4"   type="text" class="passholderbooth" id="" placeholder="2:00 PM"></input></td>
          </tr>
          
        </tbody>
      </table>
      <br/>
      <br/>
      <div class="terms">
        <strong>Terms & Conditions:</strong>
        <ol>
          <li><u>This form is only applied after Program Technical Meeting for each hall.</u></li>
          <li><u>Live Performance may only start <u>after 4 PM</u> on the first day during cocktail hour.</u></li>
          <li>Every on-site order request for electricity installation must be paid in cash.</li>
          <li><u>NO LIVE PERFORMANCE</u> is allowed on the 2nd and 3rd day.</li>
          <li>Compliance with this requirement will become an element in the best booth judgment.</li>
        </ol>
        <br/>
        <strong>Regulation for noise level:</strong>
        <ol>
          <li>There will be 3 (three) times warning if exhibitor produces sound volume more than the maximum limit.(maximum 80 db)</li>
          <li>If exhibitor still ignores the warning, then the Organizer has the right to cut off the exhibitor’s electrical power.</li>
        </ol>
        <span>Please sign below indicating that you have read and understood the regulation above.</span>
      </div>      
      <br/>
      <br/>
    </div>                     
  </div>  

  <div id="step-10">
    <h2 class="StepTitle">ADVERTISING</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>No.</th>
                 <th>TYPE</th> 
                 <th>PRICE/UNIT</th>
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td>1</td>
                <td class="product-title"><strong>Hanging Banner – Above the booth</strong><br/><br/>
                &nbsp;&nbsp;&nbsp;• Size : 1,05m x 4m (portrait).<br/>
                </td>
                <td class="price-per-pallet">USD <span>200</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-advert" id="sparkle-num-pallets" name="advert"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-advert" id="sparkle-row-total" disabled="disabled"></input>
                  <input type="hidden" class="row-total-advert" id="" name="rowadvert"></input>
                </td>
            </tr>
            
            
        </table>

        

        <table id="total-electric">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalAdvert"></span></td>
            <input type="hidden" class="" id="advertsubtotal" name="advertsubtotal"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertlate"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertonsite"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalAdvert"></span></td>
            <input type="hidden" class="" id="adverttax" name="adverttax"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalAdvert"></span></td>
            <input type="hidden" class="" id="advertgrandtotal" name="advertgrandtotal"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Exhibitors must provide their own promotional material.</li>
              <li>First come first serve basis is applied.</li>
              <li>Payment must be in cash on setup days or the showdays.</li>
              <li>The placement of hanging banner above the exhibitor’s booth depends on the availability of the roof hanger point, makes reservation before order.</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-11">
    <h2 class="StepTitle">FURNITURE RENTAL</h2>   
    <div id="boothcontractor">
      <br/>
      <p>Please fill in the box with the quantity of your order:</p>
      <div class="clear"></div>

      <div class="furniturelistcontainer">
        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Folding chair white</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture1.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            <input name="furniture1" type="text" id="furnitureinput1" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 20/Unit</span>
            <input name="rowfurniture1" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Upright chair red</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture2.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            <input name="furniture2"  type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span     id="furnitureprice1" class="furnitureprice">USD 20/Unit</span>
            <input name="rowfurniture2" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Barstool with backrest</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture3.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="55">
            <input name="furniture3" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice">USD 55/Unit</span>
            <input name="rowfurniture3" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>
      </div>

      <div class="clear"></div>

      <div class="furniturelistcontainer">
        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Reception desk</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture4.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="25">
            <input name="furniture4" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 25/Unit</span>
            <input name="rowfurniture4" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Lockable cupboard</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture5.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="20">
            <input name="furniture5" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 20/Unit</span>
            <input name="rowfurniture5" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Round table with glass top</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture6.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="55">
            <input name="furniture6" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice">USD 55/Unit</span>
            <input name="rowfurniture6" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <br/>
      <br/>
      <table id="total-furniture" class="total-table">
        <tr>
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalFurniture"></span></td>
          <input name="furnituresubtotal" id="furnituresubtotal" type="hidden"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input name="furniturelate" id="furniturelate" type="hidden"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input name="furnitureonsite" id="furnitureonsite" type="hidden"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
          <td class="result">USD<span id="faxTotalFurniture"></span></td>
          <input name="furnituretax" id="furnituretax" type="hidden"></input>
        </tr>
        <tr>
          <td class="grayTable alignRight">Grand Total</td>
          <td class="result">USD<span id="grandTotalFurniture"></span></td>
          <input name="furnituregrandtotal" id="furnituregrandtotal" type="hidden"></input>
        </tr>
      </table>
      <br/>
      <br/>
      <br/>
      <br/>
    </div>                     
  </div>  

  <div id="step-12">
    <h2 class="StepTitle">INTERNET CONNECTION</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>INTERNET CONNECTION (CABLE)</th>
                 <th>PRICE /PACKAGE</th> 
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td><strong>Package : 1 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>380</span></td>
                <td class="num-pallets"><input name="internet1"    type="text" class="num-pallets-input-internet" id="sparkle-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-internet" id="sparkle-row-total" disabled="disabled"></input>
                  <input name="rowinternet1" class="row-total-input-internet-hidden" type="hidden" id="rowinternet1"></input>
                </td>
            </tr>
            <tr class="even">
                <td><strong>Package : 2 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>760</span></td>
                <td class="num-pallets"><input name="internet2"    type="text" class="num-pallets-input-internet" id="sparkle-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-internet" id="sparkle-row-total" disabled="disabled"></input>
                  <input name="rowinternet2" class="row-total-input-internet-hidden" type="hidden" id="rowinternet2"></input>
                </td>
            </tr>
            <tr class="odd">
                <td><strong>Instalation Fee</strong></td>
                <td class="price-per-pallet">USD <span id="internetinstallfeeperqty">50</span></td>
                <td class="num-pallets"><input type="text" class="internetinstallqty" disabled="disabled"></input></td>
                <input name="internetinstallqty" type="hidden" class="internetinstallqty"></input>
                <td class="row-total">
                  <input type="text" class="row-total-input-internetfee" id="totalFeeInstallInternet" disabled="disabled"></input>
                  <input name="internetinstallfee" type="hidden" id="internetinstallfee" class="row-total-input-internetfee" ></input>

                </td>
            </tr>

            
            
        </table>

        
        <span class="left" style="margin-top:20px;margin-left:30px;"><small>Our official internet provider for 37th IPA Convex is <br/><strong>PT. Hypernet.</strong></small></span>
        <table id="total-internet" class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalInternet"></span></td>
            <input name="internetsubtotal" id="internetsubtotal" type="hidden" class="" ></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input name="internetlate" id="internetlate" type="hidden" class="" ></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input name="internetonsite" id="internetonsite" type="hidden" class="" ></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalInternet"></span></td>
            <input name="internettax" id="internettax" type="hidden" class="" ></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalInternet"></span></td>
            <input name="internetgrandtotal" id="internetgrandtotal" type="hidden" class="" ></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Rental price during the exhibition starts at 9.00 am until 9.00 pm.</li>
              <li>Orders without payment will not be executed.</li>
              <li>Networking, computers, switches and Ethernet card/interface are to be provided by client</li>
              <li>On-site order for internt cannot be granted</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-13">
    <h2 class="StepTitle">KIOSK RENTAL</h2>
    <div id="page-wrap">
        <table id="order-table">
            <tr>
                 <th>KIOSK RENTAL</th>
                 <th>TYPE</th> 
            </tr>
            <tr>
                <td style="font-size:13px;">Details<br/><br/>
                  • Monitor LCD 17”<br/>
                  • Touchscreen<br/>
                  • CPU Intel Atom, 1GB am, <br/>
                  • 160 GB HDD<br/>
                </td>
                <td class="price-per-pallet">
                  <div class="kiosklist left" style="width:50%;">
                    <span style="display:block;margin-bottom:7px;">Type 1 : Infostar </span>
                    {{ HTML::image('images/exhibitor/kiosk1.png','',array('class'=>'')) }}
                  </div>
                  <div class="kiosklist left">
                    <span style="display:block;margin-bottom:7px;">Type 2 : Elegance </span>
                    {{ HTML::image('images/exhibitor/kiosk2.png','',array('class'=>'')) }}
                  </div>
                </td>
            </tr>
        </table>
        
        <table id="order-table">
            <tr>
                 <th style="width:357px;">PRICE / UNIT</th>
                 <th colspan="2">QUANTITY</th> 
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            
            <tr class="even">
                <td class="price-per-pallet"><strong style="font-size:12.5px;margin-left:20px;">USD <span>480</span>,-</strong></td>
                <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 1</span><input name="kiosk1" type="text" id="numpalletskiosk1" class="num-pallets-input-kiosk" id="" style="margin:0 auto;margin-bottom:10px;"></input></td>
                <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 2</span><input name="kiosk2" type="text" id="numpalletskiosk2" class="num-pallets-input-kiosk" id="" style="margin:0 auto;margin-bottom:10px;"></input></td>
                <td class="row-total">
                  <input type="text" class="row-total-input-kiosk" id="" disabled="disabled" style="margin-left:20px;margin-top:20px;"></input>
                  <input type="hidden" class="row-total-input-kiosk-hidden" name="rowkiosk"></input>
                </td>
            </tr>
            
        </table>
        <br/>
        <br/>
        <table id="total-kiosk" class="total-table">
          <tr>
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalKiosk"></span></td>
            <input type="hidden" name="kiosksubtotal" id="kiosksubtotal"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kiosklate" id="kiosklate"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kioskonsite" id="kioskonsite"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
            <td class="result">USD<span id="faxTotalKiosk"></span></td>
            <input type="hidden" name="kiosktax" id="kiosktax"></input>
          </tr>
          <tr>
            <td class="grayTable alignRight">Grand Total</td>
            <td class="result">USD<span id="grandTotalKiosk"></span></td>
            <input type="hidden" name="kioskgrandtotal" id="kioskgrandtotal"></input>
          </tr>
        </table>
        
        <div class="clear"></div>

        <div>
            <h4>Terms & Conditions:</h4>
            <ol>
              <li>Software for contents is not included.</li>
              <li>Price is already include PPN</li>
              <li>Limited stock, only 10 pieces  are available (first come first serve)</li>
            </ol>
        </div>
        
    </div>
  </div>

  <div id="step-14">
    <h2 class="StepTitle">REMINDER</h2>
    <div id="page-wrap">
        
        <div id="boothcontractor" style="font-size:13px;">
          <br/>
          <br/>
          <p>Please do re-check before you finalize filling the operational forms.Any changes will takes time to processed.<br/>
          There’s additional charges for changes made after the deadline :<br/>
          Late Order fee 30%<br/>
          On-Site Order 50%</p>

          <p>I, as the PIC, representing my company, have read and shall comply with the provision set forth related to terms and condition explained.</p>

        </div>
        
    </div>
  </div>  
  
</div>
{{$form->close()}}
<script type="text/javascript">
  $(document).ready(function() {
        $('#wizard').smartWizard({
          transitionEffect: 'slideleft',
          keyNavigation: false
          //enableAllSteps: true
        });
        

        $('.buttonNext').click(function () {
          gotoTop();
        });

        $('.buttonPrevious').click(function () {
          gotoTop();
        });

        function gotoTop(){
          $('body,html').animate({
            scrollTop: 400
          }, 0);
        }
        //character left
        var left = 26
        $('#text_counter').text('Characters left: ' + left);
     
            $('#fascianame').keyup(function () {
     
            left = 26 - $(this).val().length;
     
            if(left < 0){
                $('#text_counter').addClass("overlimit");
            }
            if(left >= 0){
                $('#text_counter').removeClass("overlimit");
            }
     
            $('#text_counter').text('Characters left: ' + left);
        });
  }); 
</script>
{{ HTML::script('js/order.js') }}


<script>
  var index = 10;
  function addfield() {
    index++;
    var appendStr = '<tr>';
    appendStr += '<td>'+index+'. </td>';
    appendStr += '<td><input name="boothassistant'+index+'" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>';
    appendStr +=  '</tr>';
    //var appendStr = '<div class="form-label"><label for="newfield'+index+'">New field no '+index+'</label></div>'
    //appendStr += '<div class="form-field"><input id="newfield'+index+'" name="newfield'+index+'" size="20" class="exit-detect"></div>'
    var stepContainerHeight = $('.stepContainer').height();
    $('#listadditionalbooth').append(appendStr);
    var calculateheight = index*60;
    
    $('.stepContainer').css("height",stepContainerHeight+60);
    //removeStr();
    $('#noaddpass').val(index);
  }

  $(document).ready(function(){

    $('#add-field').live('click', function() {
      addfield();
    });

  });
</script>
@endsection