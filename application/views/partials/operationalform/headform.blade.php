<ul>
        <li><a class="termscondition" href="#step-1">
              <small class="termscondition">Terms & Condition</small>
              
          </a></li>
        <li><a 
          <?php
          if($data['electricsubtotal']!=0 && $data['electricsubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-2">
              <small>Form</small>
              <label class="stepNumber">1</label>
          </a></li>
        <li><a 
          <?php
          if($data['phonesubtotal']!=0 && $data['phonesubtotal']!=''){
            echo 'class="filledyes"';
          }?>

          href="#step-3">
              <small>Form</small>
              <label class="stepNumber">2</label>
           </a></li>
        <li><a
          <?php
          if($data['companyContractor']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-4">
              <small>Form</small>
              <label class="stepNumber">3</label>
          </a>
        </li>
        <li>
          <a
          <?php
          if($data['fascianame']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-5">
              <small>Form</small>
              <label class="stepNumber">4</label>
          </a>
        </li>
        <li>
          <a
          <?php
          if($data['freepassname1']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-6">
              <small>Form</small>
              <label class="stepNumber">5</label>
          </a>
        </li>
        <li>
          <a
          <?php
          if($data['boothassistant1']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-7">
              <small>Form</small>
              <label class="stepNumber">6</label>
          </a>
        </li>
        <li>
          <a
          <?php
          if($data['addboothsubtotal']!=0 && $data['addboothsubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-8">
              <small>Form</small>
              <label class="stepNumber">7</label>
          </a>
        </li>
        <li>
          <a
          <?php
          if($data['programdetail1']!=0 || $data['programdetail1']!='' || $data['cocktaildetail1']!=0 || $data['cocktaildetail1']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-9">
              <small>Form</small>
              <label class="stepNumber">8</label>
          </a>
        </li>
        <li>
          <a 
          <?php
          if($data['advertsubtotal']!=0 && $data['advertsubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-10">
              <small>Form</small>
              <label class="stepNumber">9</label>
          </a>
        </li>
        <li>
          <a 
          <?php
          if($data['furnituresubtotal']!=0 && $data['furnituresubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-11">
              <small>Form</small>
              <label class="stepNumber">10</label>
          </a>
        </li>
        <li>
          <a 
          <?php
          if($data['internetsubtotal']!=0 && $data['internetsubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-12">
              <small>Form</small>
              <label class="stepNumber">11</label>
          </a>
        </li>
        <li>
          <a 
          <?php
          if($data['kiosksubtotal']!=0 && $data['kiosksubtotal']!=''){
            echo 'class="filledyes"';
          }?>
          href="#step-13">
              <small>Form</small>
              <label class="stepNumber">12</label>
          </a>
        </li>
        <li>
          <a class="termsreminder" href="#step-14">
              <small>Terms & Condition Reminder</small>
          </a>
        </li>

      </ul>