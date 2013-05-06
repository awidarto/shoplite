@layout('publicnoside')
@section('content')
<div class="statusformindividualsubmit">

</div>
<div class="clear"></div>
<div class="tableHeader">
    <h3>{{$title}}</h3>
</div>
{{$form->open('exhibition/operationalform','POST',array('class'=>'addAttendeeForm','id'=>'operationalformexhibitor'))}}
{{ $form->hidden('formstatus','open')}}
<div id="wizard" class="swMain">

  @include('partials.operationalform.headformempty')

  <div id="step-1">
   @include('partials.operationalform.step1')
  </div>

  <div id="step-2">

    <h2 class="StepTitle">ELECTRICITY INSTALLATION</h2>

    @if(isset($data['submitform1']) && $data['submitform1'] == 'true' )
        <div class="alert alert-warning insideform">
          Form #1 already submitted .
        </div>
    @endif

    <div id="page-wrap">
        @if(isset($data['submitform1']) && $data['submitform1'] == 'true')
        <div class="disableforminput">
        @endif
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
          <tr class="hideTable">
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="product-subtotal"></span></td>
            <input type="hidden" id="electricsubtotal" name="electricsubtotal"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriclate" name="electriclate"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" id="electriconsite" name="electriconsite"></input>
          </tr>
          <tr class="hideTable">
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

        @include('partials.operationalform.step2')

        @if(isset($data['submitform1']) && $data['submitform1'] == 'true' )
          </div>
        @endif
        
    </div>
  </div>

  <div id="step-3">
    <h2 class="StepTitle">TELEPHONE INSTALLATION</h2>
    @if(isset($data['submitform2']) && $data['submitform2'] == 'true')
        <div class="alert alert-warning insideform">
          Form #2 already submitted .
        </div>
    @endif
    <div id="page-wrap">

        @if(isset($data['submitform2']) && $data['submitform2'] == 'true')
        <div class="disableforminput">
        @endif
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
                <td class="price-per-pallet">USD <span>225</span></td>
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
                
                <td class="price-per-pallet">USD <span>358</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-phone" id="turface-mvp-num-pallets" name="phone2"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-phone" id="turface-mvp-row-total" disabled="disabled"></input>
                  <input type="hidden" class="row-total-input" id="" name="rowphone2"></input>
                </td>
            </tr>
            
        </table>

        <table class="total-table">
          <tr class="hideTable">
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalPhone"></span></td>
            <input type="hidden" class="" id="phonesubtotal" name="phonesubtotal"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phonelate"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="phoneonsite"></input>
          </tr>
          <tr class="hideTable">
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
        @include('partials.operationalform.step3')

        @if(isset($data['submitform2']) && $data['submitform2'] == 'true')
        </div>
        @endif
        
        
    </div>
  </div>

  <div id="step-4">
      @include('partials.operationalform.step4')
  </div>

  <div id="step-5">
    @include('partials.operationalform.step5')
  </div>

  <div id="step-6">
     @include('partials.operationalform.step6')
  </div>

  <div id="step-7">
    @include('partials.operationalform.step7')                 
  </div>

  <div id="step-8">
      
      @include('partials.operationalform.step8')

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
        <tr class="hideTable">
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalAddbooth"></span></td>
          <input type="hidden" class="" id="addboothsubtotal" name="addboothsubtotal"></input>
        </tr>
        <tr class="hideTable">
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothlate"></input>
        </tr>
        <tr class="hideTable">
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input type="hidden" class="" id="" name="addboothonsite"></input>
        </tr>
        <tr class="hideTable">
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
      @if(!isset($data['submitform7']) || $data['submitform7']!='true')
        <div class="clear"></div>
        <a href="#" id="submitform7" class="buttonSubmitIndividual">Submit Form 7</a>
      @endif

      @if(isset($data['submitform7']) && $data['submitform7'] == 'true')
        </div>
      @endif
  </div>
</div>
  

  <div id="step-9">
    @include('partials.operationalform.step9')
  </div>  

  <div id="step-10">
    
    <h2 class="StepTitle">ADVERTISING</h2>
    @if(isset($data['submitform9']) && $data['submitform9'] == 'true')
        <div class="alert alert-warning insideform">
          Form #9 already submitted .
        </div>
    @endif
    <div id="page-wrap">
        @if(isset($data['submitform9']) && $data['submitform9'] == 'true')
          <div class="disableforminput">
        @endif
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
                <td class="product-title"><strong>Hanging Banner – Above the booth (1 side image)</strong><br/><br/>
                &nbsp;&nbsp;&nbsp;•  Size : 1m x 3m (portrait).<br/>
                </td>
                <td class="price-per-pallet">USD <span>200</span></td>
                <td class="num-pallets"><input type="text" class="num-pallets-input-advert" id="sparkle-num-pallets" name="advert"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-advert" id="sparkle-row-total" disabled="disabled"></input>
                  <input type="hidden" class="row-total-advert" id="" name="rowadvert"></input>
                </td>
            </tr>
            
            
        </table>

        

        <table id="total-electric">
          <tr class="hideTable">
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalAdvert"></span></td>
            <input type="hidden" class="" id="advertsubtotal" name="advertsubtotal"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertlate"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" class="" id="" name="advertonsite"></input>
          </tr>
          <tr class="hideTable">
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
        
        @include('partials.operationalform.step10')
        @if(isset($data['submitform9']) && $data['submitform9'] == 'true')
          </div>
        @endif
        
    </div>
  </div>

  <div id="step-11">
    <h2 class="StepTitle">FURNITURE RENTAL</h2>
    @if(isset($data['submitform10']) && $data['submitform10'] == 'true')
        <div class="alert alert-warning insideform">
          Form #10 already submitted .
        </div>
    @endif
    <div id="boothcontractor">
      @if(isset($data['submitform10']) && $data['submitform10'] == 'true')
        <div class="disableforminput">
      @endif
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
          <div class="furniturepricecontainer" price="30">
            <input name="furniture2"  type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span id="furnitureprice1" class="furnitureprice">USD 30/Unit</span>
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
          <div class="furniturepricecontainer" price="30">
            <input name="furniture4" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 30/Unit</span>
            <input name="rowfurniture4" class="row-total-input-furniture" type="hidden"></input>
          </div>
        </div>

        <div class="furnitureItem">
          <span id="furnituretitle1" class="furnitureTitle">Lockable cupboard</span>
          <div class="furnituredetailcontainer">
            {{ HTML::image('images/exhibitor/furniture5.png','',array('class'=>'furnitureImage')) }}
          </div>
          <div class="furniturepricecontainer" price="40">
            <input name="furniture5" type="text" id="" placeholder="0" class="num-pallets-input-furniture"></input><br/>
            <span      id="furnitureprice1" class="furnitureprice" >USD 40/Unit</span>
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
      <small>* Please inform us if you have special needs.</small>
      <br/>
      <br/>
      <table id="total-furniture" class="total-table">
        <tr class="hideTable">
          <td class="grayTable alignRight">Total (USD)</td>
          <td class="result">USD <span id="subTotalFurniture"></span></td>
          <input name="furnituresubtotal" id="furnituresubtotal" type="hidden"></input>
        </tr>
        <tr class="hideTable">
          <td class="grayTable alignRight">Late Order Surcharge 30%</td>
          <td class="result">USD</td>
          <input name="furniturelate" id="furniturelate" type="hidden"></input>
        </tr>
        <tr class="hideTable">
          <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
          <td class="result">USD</td>
          <input name="furnitureonsite" id="furnitureonsite" type="hidden"></input>
        </tr>
        <tr class="hideTable">
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
      @include('partials.operationalform.step11')  
      <br/>
      @if(isset($data['submitform10']) && $data['submitform10'] == 'true')
        </div>
      @endif
    </div>                     
  </div>

  <div id="step-12">
    <h2 class="StepTitle">INTERNET CONNECTION</h2>
    @if(isset($data['submitform11']) && $data['submitform11'] == 'true')
        <div class="alert alert-warning insideform">
          Form #11 already submitted .
        </div>
    @endif
    <div id="page-wrap">
        @if(isset($data['submitform11']) && $data['submitform11'] == 'true')
          <div class="disableforminput">
        @endif
        <table id="order-table">
            <tr>
                 <th>INTERNET CONNECTION (CABLE)</th>
                 <th>PRICE /PACKAGE</th> 
                 <th>QUANTITY</th>
                 <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
            </tr>
            <tr class="odd">
                <td><strong>Package : 1 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>230</span></td>
                <td class="num-pallets"><input name="internet1"    type="text" class="num-pallets-input-internet" id="sparkle-num-pallets"></input></td>
                <td class="row-total"><input type="text" class="row-total-input-internet" id="sparkle-row-total" disabled="disabled"></input>
                  <input name="rowinternet1" class="row-total-input-internet-hidden" type="hidden" id="rowinternet1"></input>
                </td>
            </tr>
            <tr class="even">
                <td><strong>Package : 2 Mbps</strong></td>
                <td class="price-per-pallet">USD <span>460</span></td>
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

        
        <span class="left" style="margin-top:20px;margin-left:30px;"><small>Our official internet provider for 37th IPA Convex is <br/><strong>PT Hipernet IndoData</strong>(Hypernet)</small></span>
        <table id="total-internet" class="total-table">
          <tr class="hideTable">
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalInternet"></span></td>
            <input name="internetsubtotal" id="internetsubtotal" type="hidden" class="" ></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input name="internetlate" id="internetlate" type="hidden" class="" ></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input name="internetonsite" id="internetonsite" type="hidden" class="" ></input>
          </tr>
          <tr class="hideTable">
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
        @include('partials.operationalform.step12')

        @if(isset($data['submitform11']) && $data['submitform11'] == 'true')
          </div>
        @endif
        
    </div>
  </div>

  <div id="step-13">
    <h2 class="StepTitle">KIOSK RENTAL</h2>
    @if(isset($data['submitform12']) && $data['submitform12'] == 'true')
        <div class="alert alert-warning insideform">
          Form #12 already submitted .
        </div>
    @endif
    <div id="page-wrap">
        @if(isset($data['submitform12']) && $data['submitform12'] == 'true')
          <div class="disableforminput">
        @endif
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
          <tr class="hideTable">
            <td class="grayTable alignRight">Total (USD)</td>
            <td class="result">USD <span id="subTotalKiosk"></span></td>
            <input type="hidden" name="kiosksubtotal" id="kiosksubtotal"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">Late Order Surcharge 30%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kiosklate" id="kiosklate"></input>
          </tr>
          <tr class="hideTable">
            <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
            <td class="result">USD</td>
            <input type="hidden" name="kioskonsite" id="kioskonsite"></input>
          </tr>
          <tr class="hideTable">
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
        @include('partials.operationalform.step13')

        @if(isset($data['submitform12']) && $data['submitform12'] == 'true')
          </div>
        @endif
    </div>
  </div>

  <div id="step-14">
    @include('partials.operationalform.step14')
  </div>
  
</div>
{{$form->close()}}

<script type="text/javascript">
  $(document).ready(function() {
        $('#wizard').smartWizard({
          transitionEffect: 'slideleft',
          keyNavigation: false,
          enableAllSteps: true
        });
        
        var statusformsubmitalert = '<div class="alert alert-warning">Submitting your form, please wait..</div>';

        //submit individual
        $('#submitform1').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform1").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });

        $('#submitform2').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform2").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });

        $('#submitform3').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform3").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform4').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform4").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform5').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform5").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform6').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform6").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform7').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform7").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform8').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform8").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform9').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform9").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform10').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform10").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform11').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform11").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
        });
        $('#submitform12').click(function(e){
            var frm = $('form');
            var input2 = $("<input>").attr("type", "hidden").attr("name", "btnSave").val("true");
            var input = $("<input>").attr("type", "hidden").attr("name", "submitform12").val("true");
            $('#operationalformexhibitor').append($(input));
            $('#operationalformexhibitor').append($(input2));
            frm.submit();
            $('.statusformindividualsubmit').append(statusformsubmitalert);
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