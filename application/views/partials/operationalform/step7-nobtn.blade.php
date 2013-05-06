<h2 class="StepTitle">ADDITIONAL EXHIBITOR PASS (FREE)</h2>

@if(isset($data['submitform6']) && $data['submitform6'] == 'true')
  <div class="alert alert-warning insideform">
    Form #6 already submitted .
  </div>
  
@endif

<div id="boothcontractor">
  <br/>
  <h4>Terms & Conditions:</h4>
  <ol>
    <li>Addional Exhibitor Pass is intended for additional booth assistant</li>
    <li>Additional Exhibitor Pass shall be granted free of charge for a maximum of 10 persons (including coffee break but excluding lunch).</li>
    <li>Additional Exhibitor Pass holders is <u>not entitled to participate on the Plenary Session nor the  TPC.</u></li>
    <li>If your party is exceeding 10 persons, the 11th and etc will be charged US $ 35 per pass (including coffee break but excluding lunch). Please fill in FORM 7 for payable Additional Exhibitor Pass.  </li>
    
  </ol>
  <p><strong>Please list below the names of the FREE ADDITIONAL EXHIBITOR PASS HOLDERS you wish to register:</p>
  <div class="clear"></div>      
  <table id="order-table">
    <thead>
      <tr>
        <th>No.</th>            
        <th>Names of Booth Assistant Pass Holders</th>
      </tr>
    </thead>
    <tbody id="listadditionalbooth">
      <?php for($i=1;$i<=10;$i++): ?>
      <tr>
        <td>{{$i}}. </td>
        <td>{{ $form->text('boothassistant'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Type name here')) }}</td>
      </tr>
      <?php endfor; ?>
      <input name="noaddpass" id="noaddpass" type="hidden" value="10"></input>
    </tbody>
  </table>
  <br/>
  <br/>

</div> 
