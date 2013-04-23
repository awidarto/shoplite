@layout('master')
@section('content')
{{ HTML::style('css/smart_wizard.css') }}
<div class="tableHeader">
    <h3>{{$title}}</h3>
</div>
<div class="row-fluid">
  <div class="adminview span12">
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
                </ol>
            </div>
            <table id="order-table" class="withborder">
              <tr>
                <th colspan="4">USEFUL CONTACTS</th>
              </tr>
              <tr class="odd">
                <td rowspan="2">1.</td>
                <td rowspan="2">Operational</td>
                <td>Raymond</td>
                <td>raymond@dyandra.com</td>
              </tr>
              <tr class="odd">
                <td>Rain</td>
                <td>rain.januardo@dyandra.com</td>
              </tr>

              <tr class="odd">
                <td rowspan="2">2.</td>
                <td rowspan="2">Hall A</td>
                <td>Rain</td>
                <td>rain.januardo@dyandra.com</td>
              </tr>
              <tr class="odd">
                <td>Tia</td>
                <td>tia.hamidah@dyandra.com</td>
              </tr>

               <tr class="odd">
                <td>3.</td>
                <td>Hall B</td>
                <td>Raymond</td>
                <td>raymond@dyandra.com</td>
              </tr>

              <tr class="odd">
                <td>4.</td>
                <td>Cendrawasih Room</td>
                <td>Trias</td>
                <td>trias.nugrahasanah@dyandra.com</td>
              </tr>
              
              <tr class="odd">
                <td>5.</td>
                <td>Plenary Hall & Convention</td>
                <td>Ati</td>
                <td>luh.ariati@dyandraconvex.com</td>
              </tr>
              <tr class="odd">
                <td>6.</td>
                <td>Main Lobby</td>
                <td>Trisa</td>
                <td>trisa@dyandra.com</td>
              </tr>
              <tr class="odd">
                <td>7.</td>
                <td>Assembly Hall</td>
                <td>Dian</td>
                <td>dian@dyandra.com</td>
              </tr>

              <tr class="odd">
                <td rowspan="2">8.</td>
                <td rowspan="2">PR Department</td>
                <td>Mirna</td>
                <td>mirna@dyandra.com</td>
              </tr>
              <tr class="odd">
                <td>Putri</td>
                <td>diahputri@dyandra.com</td>
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
                    <td class="price-per-pallet">USD <span>89</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="sparkle-num-pallets" name="electric1" value=""></input><span class="hightlightform">{{ $data['electric1'] }}</span></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled="disabled" value=""></input><span class="hightlightform">{{ $data['rowelectric1'] }}</span></td>
                    
                </tr>
                <tr class="even">
                    <td>2</td>
                    <td class="product-title">4A / 1 ph / 880 Watt</td>
                    <td class="price-per-pallet">USD <span>177</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mvp-num-pallets" name="electric2" value="{{ $data['electric2'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="turface-mvp-row-total" disabled="disabled" value="{{ $data['rowelectric2'] }}"></input></td>
                </tr>
                <tr class="odd">
                    <td>3</td>
                    <td class="product-title">6A / 1 ph / 1.320 Watt</td>
                    <td class="price-per-pallet">USD <span>265</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-pro-league-num-pallets" name="electric3" value="{{ $data['electric3'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="turface-pro-league-row-total" disabled="disabled" value="{{ $data['rowelectric3'] }}"></input></td>
                </tr>
               
                <tr class="odd">
                    <td>4</td>
                    <td class="product-title">10A / 1 ph / 2.200 Watt</em></td>
                    <td class="price-per-pallet">USD <span>442</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-quick-dry-num-pallets" name="electric4" value="{{ $data['electric4'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="turface-quick-dry-row-total" disabled="disabled" value="{{ $data['rowelectric4'] }}"></input></td>
                </tr>
                <tr class="even">
                    <td>5</td>
                    <td class="product-title">16A / 1 ph / 3.520 Watt</td>
                    <td class="price-per-pallet">USD <span>706</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="turface-mound-clay-red-num-pallets" name="electric5" value="{{ $data['electric5'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="turface-mound-clay-red-row-total" disabled="disabled" value="{{ $data['rowelectric5'] }}"></input></td>
                </tr>
                <tr class="odd">
                    <td>6</td>
                    <td class="product-title">32A / 1 ph / 7.040 Watt</td>
                    <td class="price-per-pallet">USD <span>1412</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-red-num-pallets" name="electric6" value="{{ $data['electric6'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-red-row-total" disabled="disabled" value="{{ $data['rowelectric6'] }}"></input>
                    </td>
                </tr>
                <tr class="even">
                    <td>7</td>
                    <td class="product-title">16A / 3 ph / 10.560 Watt</td>
                    <td class="price-per-pallet">USD <span>2118</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-drying-agent-num-pallets" name="electric7" value="{{ $data['electric7'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-drying-agent-row-total" disabled="disabled" value="{{ $data['rowelectric7'] }}"></input>
                      <input type="hidden" class="" id="sparkle-row-total" name="rowelectric7" value="{{ $data['rowelectric7'] }}"></input>
                    </td>
                </tr>
                <tr class="odd">
                    <td>8</td>
                    <td class="product-title">32A / 3 ph / 21.120 Watt</em></td>
                    <td class="price-per-pallet">USD <span>4235</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-professional-num-pallets" name="electric8" value="{{ $data['electric8'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-professional-row-total" disabled="disabled" value="{{ $data['rowelectric8'] }}"></input>
                    </td>
                </tr>
                <tr class="even">
                    <td>9</td>
                    <td class="product-title">60A / 3 ph / 39.600 Watt</td>
                    <td class="price-per-pallet">USD <span>7941</span></td>
                    <td class="num-pallets"><input type="text" class="num-pallets-input" id="diamond-pro-top-dressing-num-pallets" name="electric9" value="{{ $data['electric9'] }}"></input></td>
                    <td class="row-total"><input type="text" class="row-total-input" id="diamond-pro-top-dressing-row-total" disabled="disabled" value="{{ $data['rowelectric9'] }}"></input>
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
                    <td class="textcentertable">USD 30</td>
                    <td class="textcentertable">1</td>
                    <td class="textcentertable">USD 30</td>
                </tr>
            </table>

            <table id="total-electric">
              <tr>
                <td class="grayTable alignRight">Total (USD)</td>
                <td class="result">USD <span id="product-subtotal">{{ $data['electricsubtotal'] }}</span></td>
              </tr>
              <tr>
                <td class="grayTable alignRight">Late Order Surcharge 30%</td>
                <td class="result">USD</td>
              </tr>
              <tr>
                <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
                <td class="result">USD</td>
              </tr>
              <tr>
                <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
                <td class="result">USD<span id="product-tax">{{ $data['electrictax'] }}</span></td>
              </tr>
              <tr>
                <td class="grayTable alignRight">Grand Total</td>
                <td class="result">USD<span id="order-total">{{ $data['electricgrandtotal'] }}</span></td>
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
          <h2 class="StepTitle">BOOTH CONTRACTOR (SPECIAL DESIGN ONLY)</h2>   
          <div id="boothcontractor">
            <br/>
            <p>I (as the exhibitor) hereby inform you the details of contractor that will be responsible for my booth construction:</p>
            <label>Company</label>
            <span style="font-weight:bold;">{{ $data['companyContractor'] }}</span>
            
            <div class="clear"></div>
            <label>Person in Charge</label>
            <span style="font-weight:bold;">{{ $data['picContractor'] }}</span>
            
            <div class="clear"></div>
            <label>Address</label>
            <span style="font-weight:bold;">{{ $data['adress'] }}</span>

            <div class="clear"></div>
            <label>Phone</label>
            <span style="font-weight:bold;">{{ $data['phone'] }}</span>
            
            <div class="clear"></div>
            <label>Fax</label>
            <span style="font-weight:bold;">{{ $data['fax'] }}</span>
            
            <div class="clear"></div>
            
            <label>Mobile Phone</label>
            <span style="font-weight:bold;">{{ $data['mobile'] }}</span>
            
            <div class="clear"></div>
            <label>Email</label>
            <span style="font-weight:bold;">{{ $data['email'] }}</span>
            
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

      <div id="step-4">
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
          <strong>{{ $data['fascianame'] }}</strong>
          <br/><br/>
          <div class="clear"></div>
          <span id="text_counter"></span>
          <br/>
          <small>* Please fill-in the details by typing in block letters, the organizer won’t be held responsible for illegible handwriting.</small><br/>
          <small>* Please inform us, if you have special enquiries for your standard shell booth.</small>
          <br/>
          <br/>
        </div>                     
      </div>

      <div id="step-5">
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
                <th style="width:150px;">Booth #</th>
                <th>Names of Exhibitor’s Free Pass Holders</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
          <br/>
          <strong>Terms & Conditions:</strong><br/>
          <small>•  Free ID card are already include lunch and 2x coffee break.</small><br/>
          <br/>
          <br/>
        </div>                     
      </div>

      <div id="step-6">
        <h2 class="StepTitle">ADDITIONAL EXHIBITOR PASS</h2>   
        <div id="boothcontractor">
          <br/>
          <p>Additional Booth Assistant(s) will be admitted only on requested of Additional Booth Assistant's Badge valid for 3 days. There is no limit to the number of Additional Booth Assistants. </p>
          <p>Booth Assistant's Badges are permitted to assist Exhibitor in Exhibition areas only.</p>
          <p>Please list below the names of Additional Booth Assistant you wish to register and return by email to each Hall PIC(s).</p>
          <div class="clear"></div>
          <table id="order-table">
            <thead>
              <tr>
                <th style="width:150px;">Booth #</th>
                <th>Names of Exhibitor’s Free Pass Holders</th>
              </tr>
            </thead>
            <tbody id="listadditionalbooth">
              --@for($i=1;$i<=$data['noaddpass'];$i++)
              <tr>
                <td><?php echo $data['addpassboothno'.$i.'']; ?></td>
                <td><?php echo $data['addpassboothname'.$i.'']; ?></td>
              </tr>
              @endfor-->
            </tbody>
          </table>
          
          <br/>
          <br/>
        </div>                     
      </div>

      <div id="step-7">
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

              @for($i=1;$i<=6;$i++)

              @if(isset($data['programdetail'.$i.'']))
              <tr>
                <td>{{ $i }}</td>
                <td><?php echo $data['programdetail'.$i.'']; ?></td>
                <td><?php echo $data['programdate'.$i.'']; ?></td>
                <td><?php echo $data['programtime'.$i.'']; ?></td>
              </tr>
              @endif
              @endfor

              
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

              @for($i=1;$i<=4;$i++)

              @if(isset($data['programdetail'.$i.'']))
              <tr>
                <td>{{ $i }}</td>
                <td><?php echo $data['cocktaildetail'.$i.'']; ?></td>
                <td><?php echo $data['cocktaildate'.$i.'']; ?></td>
                <td><?php echo $data['cocktailtime'.$i.'']; ?></td>
              </tr>
              @endif
              @endfor
              
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

      <div id="step-8">
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
              <div class="furniturepricecontainer" price="15">
                <strong>{{ $data['furniture1'] }}</strong>
                <span      id="furnitureprice1" class="furnitureprice" >USD 15/Unit</span>
                
              </div>
            </div>

            <div class="furnitureItem">
              <span id="furnituretitle1" class="furnitureTitle">Upright chair red</span>
              <div class="furnituredetailcontainer">
                {{ HTML::image('images/exhibitor/furniture2.png','',array('class'=>'furnitureImage')) }}
              </div>
              <div class="furniturepricecontainer" price="15">
                <strong>{{ $data['furniture2'] }}</strong>
                <span     id="furnitureprice1" class="furnitureprice">USD 15/Unit</span>
                
              </div>
            </div>

            <div class="furnitureItem">
              <span id="furnituretitle1" class="furnitureTitle">Barstool with backrest</span>
              <div class="furnituredetailcontainer">
                {{ HTML::image('images/exhibitor/furniture3.png','',array('class'=>'furnitureImage')) }}
              </div>
              <div class="furniturepricecontainer" price="45">
                <strong>{{ $data['furniture3'] }}</strong>
                <span      id="furnitureprice1" class="furnitureprice">USD 45/Unit</span>
                
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
              <div class="furniturepricecontainer" price="21">
                <strong>{{ $data['furniture4'] }}</strong>
                <span      id="furnitureprice1" class="furnitureprice" >USD 21/Unit</span>
                
              </div>
            </div>

            <div class="furnitureItem">
              <span id="furnituretitle1" class="furnitureTitle">Lockable cupboard</span>
              <div class="furnituredetailcontainer">
                {{ HTML::image('images/exhibitor/furniture5.png','',array('class'=>'furnitureImage')) }}
              </div>
              <div class="furniturepricecontainer" price="15">
                <strong>{{ $data['furniture5'] }}</strong>
                <span      id="furnitureprice1" class="furnitureprice" >USD 15/Unit</span>
                
              </div>
            </div>

            <div class="furnitureItem">
              <span id="furnituretitle1" class="furnitureTitle">Round table with glass top</span>
              <div class="furnituredetailcontainer">
                {{ HTML::image('images/exhibitor/furniture6.png','',array('class'=>'furnitureImage')) }}
              </div>
              <div class="furniturepricecontainer" price="45">
                <strong>{{ $data['furniture6'] }}</strong>
                <span      id="furnitureprice1" class="furnitureprice">USD 45/Unit</span>
                
              </div>
            </div>
          </div>
          <div class="clear"></div>
          <br/>
          <br/>
          <table id="total-furniture" class="total-table">
            <tr>
              <td class="grayTable alignRight">Total (USD)</td>
              <td class="result">USD <span id="subTotalFurniture">{{ $data['furnituresubtotal']}}</span></td>
              
            </tr>
            <tr>
              <td class="grayTable alignRight">Late Order Surcharge 30%</td>
              <td class="result">USD</td>
              
            </tr>
            <tr>
              <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
              <td class="result">USD</td>
              
            </tr>
            <tr>
              <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
              <td class="result">USD<span id="faxTotalFurniture">{{ $data['furnituretax']}}</span></td>
              
            </tr>
            <tr>
              <td class="grayTable alignRight">Grand Total</td>
              <td class="result">USD<span id="grandTotalFurniture">{{ $data['furnituregrandtotal']}}</span></td>
             
            </tr>
          </table>
          <br/>
          <br/>
          <br/>
          <br/>
        </div>                     
      </div>  

      <div id="step-9">
        <h2 class="StepTitle">INTERNET CONNECTION</h2>
        <div id="page-wrap">
            <table id="order-table">
                <tr>
                     <th>INTERNET CONNECTION (CABLE)</th>
                     <th>PRICE /PACKAGE</th> 
                     <th>QUANTITY</th>
                     <th>DAY</th>
                     <th style="padding-right: 30px;">SUB TOTAL (USD)</th> 
                </tr>
                <tr class="odd">
                    <td><strong>Package : 1 Mbps</strong></td>
                    <td class="price-per-pallet">USD <span>200</span></td>
                    <td class="num-pallets">{{ $data['internet1'] }}</td>
                    <td class="num-pallets">{{ $data['internetday1'] }}</td>
                    <td class="row-total">{{ $data['rowinternet2'] }}
                    </td>
                </tr>
                <tr class="even">
                    <td><strong>Package : 2 Mbps</strong></td>
                    <td class="price-per-pallet">USD <span>401</span></td>
                    <td class="num-pallets">{{ $data['internet2'] }}</td>
                    <td class="num-pallets">{{ $data['internetday2'] }}</td>
                    <td class="row-total">{{ $data['rowinternet1'] }}
                      
                    </td>
                </tr>
                <tr class="odd">
                    <td><strong>Instalation Fee</strong></td>
                    <td class="price-per-pallet">USD <span>5</span></td>
                    <td class="num-pallets"></td>
                    <td class="num-pallets"><span class="" id="totalDayInternet">{{$data['internetinstallday']}}</span></td>
                    
                    <td class="row-total">
                      <span>{{$data['internetinstallfee']}}</span>
                      

                    </td>
                </tr>

                
                
            </table>

            
            <span class="left" style="margin-top:20px;margin-left:30px;"><small>Our official internet provider for 37th IPA Convex is <br/><strong>PT. Hypernet.</strong></small></span>
            <table id="total-internet" class="total-table">
              <tr>
                <td class="grayTable alignRight">Total (USD)</td>
                <td class="result">USD <span id="subTotalInternet">{{$data['internetsubtotal']}}</span></td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">Late Order Surcharge 30%</td>
                <td class="result">USD</td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
                <td class="result">USD</td>
                <input name="internetonsite" id="internetonsite" type="hidden" class="" ></input>
              </tr>
              <tr>
                <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
                <td class="result">USD<span id="faxTotalInternet">{{$data['internettax']}}</span></td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">Grand Total</td>
                <td class="result">USD<span id="grandTotalInternet">{{$data['internetgrandtotal']}}</span></td>
                
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

      <div id="step-10">
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
                    <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 1</span><span class="num-pallets-input-kiosk" style="margin:0 auto;margin-bottom:10px;"><strong>{{$data['kiosk1']}}</strong></span></td>
                    <td class="num-pallets" style="text-align:center;margin:0 auto;"><span style="display:block;margin-bottom:8px;">Type 2</span><span class="num-pallets-input-kiosk" style="margin:0 auto;margin-bottom:10px;"><strong>{{$data['kiosk2']}}</strong></span></td>
                    <td class="row-total">
                      <span id="sparkle-row-total" style="margin-left:20px;margin-top:20px;"><strong>{{$data['rowkiosk']}}</strong></span>
                      
                    </td>
                </tr>
                
            </table>
            <br/>
            <br/>
            <table id="total-kiosk" class="total-table">
              <tr>
                <td class="grayTable alignRight">Total (USD)</td>
                <td class="result">USD <span id="subTotalKiosk">{{$data['kiosksubtotal']}}</span></td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">Late Order Surcharge 30%</td>
                <td class="result">USD</td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">On-Site Order Surcharge 50%</td>
                <td class="result">USD</td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">PPn (VAT) Tax 10%</td>
                <td class="result">USD<span id="faxTotalKiosk">{{$data['kiosktax']}}</span></td>
                
              </tr>
              <tr>
                <td class="grayTable alignRight">Grand Total</td>
                <td class="result">USD<span id="grandTotalKiosk">{{$data['kioskgrandtotal']}}</span></td>
                
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

    </div>

  </div>
</div>

  {{ HTML::script('js/jquery.smartWizard-2.0.min.js') }}
  <script type="text/javascript">
    $(document).ready(function() {
          $('#wizard').smartWizard({
            transitionEffect: 'slideleft',
            keyNavigation: false,
            enableAllSteps: true
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
          
    }); 
  </script>
  {{ HTML::script('js/order.js') }}


  <script>
    var index = 3;
    function addfield() {
      index++;
      var appendStr = '<tr>';
      appendStr += '<td><span name="addpassboothno'+index+'"  class="passholderbooth" id=""></span></td>';
      appendStr += '<td><span name="addpassboothno'+index+'"  class="passholderbooth" id="" ></span></td>';
      appendStr +=  '</tr>';
      //var appendStr = '<div class="form-label"><label for="newfield'+index+'">New field no '+index+'</label></div>'
      //appendStr += '<div class="form-field"><span id="newfield'+index+'" name="newfield'+index+'" size="20" class="exit-detect"></div>'
      var stepContainerHeight = $('.stepContainer').height();
      $('#listadditionalbooth').append(appendStr);
      var calculateheight = index*60;
      
      $('.stepContainer').css("height",stepContainerHeight+60);
      //removeStr();
      $('#noaddpass').val(index);
    }

    $(document).ready(function(){
      $('.buttonFinish').hide();
      $('#add-field').live('click', function() {
        addfield();
      });

    });
  </script>

@endsection