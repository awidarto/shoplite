<h2 class="StepTitle">BOOTH PROGRAM SCHEDULE</h2>

    @if(isset($data['submitform8']) && $data['submitform8'] == 'true')
      <div class="alert alert-warning insideform">
        Form #8 already submitted .
      </div>
      
    @endif
    <div id="boothcontractor">
      <br/>
      <p>In order to ensure the best possible environment for exhibitors and attendees, please indicate here-below the activities that you intend to hold during the exhibition</p>
      <div class="clear"></div>
      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Booth Programs per Hall </th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=1;$i<=6;$i++): ?>
            <tr>
              <td>{{$i}}. </td>
              <td>{{ $form->text('programdetail'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Details here')) }}</td>
              <td>{{ $form->text('programdate'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'dd-mm-yyyy')) }}</td>
              <td>{{ $form->text('programtime'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'2:00 PM')) }}</td>
            </tr>
            <?php endfor; ?>
        </tbody>
      </table>


      <table id="order-table">
        <thead>
          <tr>
            <th style="width:50px;">No.</th>
            <th>Exhibition Cocktail Program </th>
            <th style="width:130px;">Date</th>
            <th style="width:130px;">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=1;$i<=6;$i++): ?>
          <tr>
            <td>{{$i}}. </td>
            <td>{{ $form->text('cocktaildetail'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'Details here')) }}</td>
            <td>{{ $form->text('cocktaildate'.$i,'','',array('id'=>'','class'=>'passholderbooth date','placeholder'=>'dd-mm-yyyy')) }}</td>
            <td>{{ $form->text('cocktailtime'.$i,'','',array('id'=>'','class'=>'passholderbooth','placeholder'=>'2:00 PM')) }}</td>
          </tr>
          <?php endfor; ?>
          
        </tbody>
      </table>
      <br/>
      <br/>
      <div class="terms">
        <strong>Terms & Conditions:</strong>
        <ol>
          <li>The Booth Programs will be arranged on <strong>first-come first-serve basis.</strong></li>
          <li>Live Performance may only start after 16.00 on the first day during cocktail hour. </li>
          <li>If you have special live / music performances please refer to the manual book.</li>
          <li><strong><i>Compliance With This Requirement Will Become An Element In The Best Booth Judgment.</i></strong></li>
          <li><strong><i>Filling this form does not means automatically approve the schedules, This form require a manual approval from your PO hall.</i></strong></li>
        </ol>
        <br/>
        <strong>Regulation for noise level:</strong>
        <ol>
          <li>There will be 3 (three) times warning if exhibitor produces sound volume more than the maximum limit (maximum 80 db).</li>
          <li>In extreme cases if exhibitor remains ignorant despite the warning, the Co-Organizer has the right to cut-off the exhibitor’s electrical power.</li>
        </ol>
        
      </div>      
      <br/>
      <br/>
    
    </div>
    