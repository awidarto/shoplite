@layout('master')
@section('content')

{{ HTML::link('exhibitor', '', array('class' => 'win-backbutton')) }}
<?php
       
  $sizebooth = $booth['size'];
  $freepasscount = 0;
  $freepassnameregistered = 0;
  $boothassistantcount = 0;

  $boothassistantdata_id  = isset($boothassistantdata['_id'])?$boothassistantdata['_id']:'';


  /*if($sizebooth >= 9 && $sizebooth <= 18){
    $pass = 2;
  }else if($sizebooth >= 18 && $sizebooth < 27){
    $pass = 4;
  }else if($sizebooth >= 27 && $sizebooth < 36){
    $pass = 6;
  }else if($sizebooth >= 36 && $sizebooth < 45){
    $pass = 8;
  }else if($sizebooth >= 45){
    $pass = 10;
  }else{
    $pass = 10;
  }*/
  $pass = $booth['freepassslot'];
  
  for($i=1;$i<$pass+1;$i++){
    //if(isset($data['freepassname'.$i.''])){
      $freepasscount++;
    //}
    if($data['freepassname'.$i.'']!=''){
      $freepassnameregistered++;
    }
  }

  for($i=1;$i<11;$i++){
    //if(isset($data['boothassistant'.$i.''])){
      $boothassistantcount++;
    //}
    
  }


  
?>
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>
<div class="row-fluid" id="importboothassis">
  <div class="span12">
      <hr/>
      <div class="buttonlistimportboothassis" style="width:70%;display:inline-block;float:left;">
       
        <a class="btn btn-info" id="printall" href="{{URL::to('exhibitor/printbadgeall')}}/{{$boothassistantdata_id}}/{{$userdata['_id']}}"><span class="icon-">&#xe14c;</span>&nbsp;Print All Data</a>
        <a class="btn btn-success" id="" href="{{URL::to('export/boothassistant')}}/{{$boothassistantdata_id}}/{{$userdata['_id']}}"><span class="icon-">&#xe1dd;</span>&nbsp;Download data as .csv</a>
        
          <btn class="btn btn-info" id="importallexhibitor" ><span class="icon-" style="width:40px;">&#x0056;&#x0054;</span>&nbsp;Import All Data</btn>
        
        
      </div>
      <div style="display:inline-block;width:30%;float:left;">
        {{$form->open_for_files('import/previewimportexhbitorpass/'.$userdata['_id'],'POST',array('class'=>'custom'))}}
        <label>Import excel file</label>
        <input style="width:10%;display:inline-block;float:left;" id="field_docupload" type="file" name="docupload">
        
        {{ $form->hidden('email',$userdata['email'])}}

        {{ $form->hidden('firstname',$userdata['firstname'])}}
        {{ $form->hidden('firstname',$userdata['lastname'])}}
        
        {{ Form::submit('Submit excel',array('class'=>'button','style'=>'display:inline-block;float:left;'))}}&nbsp;&nbsp;
        {{$form->close()}}
      </div>
      <div class="clear"></div>
      <br/>
      <br/>
      <br/>
      <legend>EXHIBITOR’S PASS HOLDERS (FREE)<small>{{ $freepassnameregistered.' name registered from '.$pass.' slot available'}}</small></legend>
      <table id="order-table">
        <thead>
          <tr>
            <th class="span1">No.</th>            
            <th class="span8">Names of Exhibitor’s Pass Holders</th>
            <th class="align-center">Status</th>
            <th class="align-center">Action</th>
          </tr>
        </thead>
        <tbody>
          
          @for($i=1;$i<=$freepasscount;$i++)
            
            <tr>
              <td>{{ $i }}. </td>
              @if(isset($boothassistantdata['freepassname'.$i.'']))
                <td class="passname"><div class="boothasstName alreadyimport" id="freepassname{{ $i }}" rel="{{$boothassistantdata['freepassname'.$i.'regnumber']}}" type="freepassname">{{ $boothassistantdata['freepassname'.$i.''] }}</div></td>
              @elseif($data['freepassname'.$i.'']=='')
                <td class="passname"><div class="boothasstNameaddOnly" id="freepassname{{ $i }}" rel="" type="freepass"><span class="fontRed">Double click to add..</div></div></td>
              @else
                <td class="passname"><div class="notimport" id="freepassname{{ $i }}" >{{ $data['freepassname'.$i.''] }}</div></td>
              @endif
              @if(isset($boothassistantdata['freepassname'.$i.'']))
                  <td class="aligncenter action" ><span class="icon- fontGreen existtrue">&#xe20c;</span>&nbsp;Imported on {{ date('d-m-Y',  $boothassistantdata['freepassname'.$i.'timestamp']->sec) }}</td>
                  <td id="status_freepassname{{ $i }}" class="align-center status"><a class="icon- printbadge" id="freepassname{{ $i }}" type="freepassname" typeid="{{ $i }}"><i>&#xe14c;</i><span class="formstatus" id="freepassname{{ $i }}" > Print this data</span></a></td>
                  <td id="iframefreepassname{{ $i }}"><iframe src="{{ URL::to('exhibitor/printbadgeonsite/') }}{{$boothassistantdata['freepassname'.$i.'regnumber']}}/{{$boothassistantdata['freepassname'.$i.'']}}/{{ $userdata['company'] }}/ba1/" id="printbadgefreepassname{{ $i }}"  style="display:none;" class="span12"></iframe></td>
              @else
              <td id="status_freepassname{{ $i }}" class="align-center status"></td>
              <td class="align-center action"><a class="icon- importidividual" id="freepassname{{ $i }}" type="freepassname" typeid="{{ $i }}"><i>&#xe20b;</i><span class="formstatus" id="" > Import this data</span></a></td>
              <td id="iframefreepassname{{ $i }}"></td>
              @endif

              
            </tr>
          @endfor
          
        </tbody>
      </table>
      <br/>
      <br/>
      <legend>FREE ADDITIONAL EXHIBITOR PASS HOLDERS<small>{{ $boothassistantcount.' name registered from 10 slot available'}}</small></legend>
      <table id="order-table">
        <thead>
          <tr>
            <th class="span1" >No.</th>            
            <th class="span8" >Names of Exhibitor’s Pass Holders</th>
            <th class="align-center">Status</th>
            <th class="align-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @for($i=1;$i<=$boothassistantcount;$i++)

            <tr>
              <td>{{ $i }}. </td>
              @if(isset($boothassistantdata['boothassistant'.$i.'']))
                <td class="passname"><div class="boothasstName alreadyimport" id="boothassistant{{ $i }}" rel="{{$boothassistantdata['boothassistant'.$i.'regnumber']}}" type="boothassistant">{{ $boothassistantdata['boothassistant'.$i.''] }}</div></td>
              @elseif($data['boothassistant'.$i.'']=='')
                <td class="passname"><div class="boothasstNameaddOnly" id="boothassistant{{ $i }}" rel="" type="boothassistant"><span class="fontRed">Double click to add..</div></div></td>
              @else
                <td class="passname"><div class="notimport" id="boothassistant{{ $i }}" >{{ $data['boothassistant'.$i.''] }}</div></td>
              @endif

              @if(isset($boothassistantdata['boothassistant'.$i.'']))
                  <td class="aligncenter action" ><span class="icon- fontGreen existtrue">&#xe20c;</span>&nbsp;Imported on {{ date('d-m-Y',  $boothassistantdata['boothassistant'.$i.'timestamp']->sec) }}</td>
                  <td id="status_boothassistant{{ $i }}" class="align-center status"><a class="icon- printbadge" id="boothassistant{{ $i }}" type="boothassistant" typeid="{{ $i }}"><i>&#xe14c;</i><span class="formstatus" id="boothassistant{{ $i }}" > Print this data</span></a></td>
                  <td id="iframeboothassistant{{ $i }}"><iframe src="{{ URL::to('exhibitor/printbadgeonsite/') }}{{$boothassistantdata['boothassistant'.$i.'regnumber']}}/{{$boothassistantdata['boothassistant'.$i.'']}}/{{ $userdata['company'] }}/ba2/" id="printbadgeboothassistant{{ $i }}"  style="display:none;" class="span12"></iframe></td>
              @else
              <td id="status_boothassistant{{ $i }}" class="align-center status"></td>
              <td class="align-center action"><a class="icon- importidividual" id="boothassistant{{ $i }}" type="boothassistant" typeid="{{ $i }}"><i>&#xe20b;</i><span class="formstatus" id="" > Import this data</span></a></td>
              <td id="iframeboothassistant{{ $i }}"></td>
              @endif

              
            </tr>

            

          @endfor
          
        </tbody>
      </table>

      <br/>
      <br/>
      <legend>ADDITIONAL EXHIBITOR PASS (PAYABLE)<small>{{ $data['totaladdbooth'].' name registered'}}</small></legend>
      <table id="order-table">
        <thead>
          <tr>
            <th class="span1">No.</th>            
            <th class="span8">Names of Exhibitor’s Pass Holders</th>
            <th class="align-center">Status</th>
            <th class="align-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @for($i=1;$i<=$data['totaladdbooth'];$i++)

            <tr>

              <td>{{ $i }}. </td>

              @if(isset($boothassistantdata['addboothname'.$i.'']))
                <td class="passname"><div class="boothasstName alreadyimport" id="addboothname{{ $i }}" rel="{{$boothassistantdata['addboothname'.$i.'regnumber']}}" type="addboothname">{{ $boothassistantdata['addboothname'.$i.''] }}</div></td>
              @elseif($data['addboothname'.$i.'']=='')
                <td class="passname"><div class="boothasstNameaddOnly" id="addboothname{{ $i }}" rel="" type="addbooth"><span class="fontRed">Double click to add..</div></div></td>
              @else
                <td class="passname"><div class="notimport" id="addboothname{{ $i }}" >{{ $data['addboothname'.$i.''] }}</div></td>
              @endif
              @if(isset($boothassistantdata['addboothname'.$i.'']))
                  <td class="aligncenter action" ><span class="icon- fontGreen existtrue">&#xe20c;</span>&nbsp;Imported on {{ date('d-m-Y',  $boothassistantdata['addboothname'.$i.'timestamp']->sec) }}</td>
                  <td id="status_addboothname{{ $i }}" class="align-center status"><a class="icon- printbadge" id="addboothname{{ $i }}" type="addboothname" typeid="{{ $i }}"><i>&#xe14c;</i><span class="formstatus" id="addboothname{{ $i }}" > Print this data</span></a></td>
                  <td id="iframeaddboothname{{ $i }}"><iframe src="{{ URL::to('exhibitor/printbadgeonsite/') }}{{$boothassistantdata['addboothname'.$i.'regnumber']}}/{{$boothassistantdata['addboothname'.$i.'']}}/{{ $userdata['company'] }}/ba2/" id="printbadgeaddboothname{{ $i }}"  style="display:none;" class="span12"></iframe></td>
              @else
              <td id="status_addboothname{{ $i }}" class="align-center status"></td>
              <td class="align-center action"><a class="icon- importidividual" id="addboothname{{ $i }}" type="addboothname" typeid="{{ $i }}"><i>&#xe20b;</i><span class="formstatus" id="" > Import this data</span></a></td>
              <td id="iframeaddboothname{{ $i }}"></td>
              @endif

              
              
            </tr>
            
          @endfor
          
        </tbody>
      </table>

  </div>
</div>

<div id="processingstat" class="processing_stat" style="display:none;">Processing...</div>
<div class="modal-backdrop fade in" style="opacity:0.5;display:none;"></div>
<script>
  
  <?php
    $boothassistantdata_id  = isset($boothassistantdata['_id'])?$boothassistantdata['_id']:'';
  ?>

  var current_type = '';
  var current_type_id = 0;
  var current_id='';
  <?php $exhibitorid = $userdata['_id']->__toString();?>
  var exhibitorid     = '<?php echo $exhibitorid;?>';
  var companyname     = '<?php echo $userdata['company'];?>';
  var companypic      = '<?php echo $userdata['firstname'].' '.$userdata['lastname'];?>';
  var companypicemail = '<?php echo $userdata['email'];?>';
  var hallname        = '<?php echo $userdata['hall'];?>';
  var boothname       = '<?php echo $userdata['booth'];?>';
  
  $('.importidividual').click(function(){
    var thisitem = $(this);
    current_id = $(this).parent().parent().find('td.status').attr('id');
    current_type = $(this).attr('type');
    current_type_id = $(this).attr('typeid');
    var current_pass_name = $(this).parent().parent().find('td.passname').text();
    var boothassistantdataid = '{{$boothassistantdata_id}}';

    
    <?php

      $ajaxImportBoothAssistant = (isset($ajaxImportBoothAssistant))?$ajaxImportBoothAssistant:'/';

    ?>
    $.post('{{ URL::to($ajaxImportBoothAssistant) }}',{'exhibitorid':exhibitorid,'companyname':companyname,'companypic':companypic,'companypicemail':companypicemail,'hallname':hallname,'boothname':boothname,'type':current_type,'typeid':current_type_id,'passname':current_pass_name}, function(data) {
      
      $('#'+current_id).html('Processing');
      thisitem.html('');
      

      if(data.status == 'OK'){
        if(boothassistantdataid == ''){
          //append to printbadgeall
          $('#printall').attr('href','{{URL::to("exhibitor/printbadgeall")}}/'+data.boothid+'/{{$userdata["_id"]}}')
        }
        thisitem.html('<i>&#xe14c;</i><span id="'+current_type+current_type_id+'">Print this data</span>');
        thisitem.removeClass('importidividual');
        thisitem.addClass('printbadge');
        //thisitem.remove();
        $('#'+current_id).html(data.message);
        thisitem.parent().parent().find('td.passname div').addClass('boothasstName');
        thisitem.parent().parent().find('td.passname div').removeClass('notimport');
        
        $('<iframe />', {
              name: 'myFrame'+current_type+current_type_id,
              id:   'printbadge'+current_type+current_type_id,
              style: 'display:none;',
              src: '{{ URL::to("exhibitor/newprintbadgeonsite") }}/'+data.regnumber+'/'+current_pass_name+'/'+companyname+'/'+current_type
          }).appendTo('#iframe'+current_type+current_type_id);

      }
    },'json');
  });


$('body').on('click', '.boothasstName', function(){
  $('.boothasstName').editable('{{ URL::to("exhibitor/editboothassname") }}', { 
      indicator : 'Saving...',
      name   : 'new_value',
      id : 'elementid',
      //data   : '{"unpaid":"Unpaid","paid":"Paid","free":"Free"}',
      type   : 'textarea',
      style   : 'display: inline',
      submit : 'OK',
      event  : "dblclick",

      callback : function(value, settings) {
        
        var regnumber = $(this).attr('rel');
        var idelement = $(this).attr('id');
        var type = $(this).attr('type');

        

        
        //remove iframe first
        var ifIDS = document.getElementById('printbadge'+idelement);
        console.log(ifIDS);
        if(ifIDS!=null){
          ifIDS.remove();

          $('<iframe />', {
              name: 'myFrame'+idelement,
              id:   'printbadge'+idelement,
              style: 'display:none;',
              src: '{{ URL::to("exhibitor/newprintbadgeonsite") }}/'+regnumber+'/'+value+'/{{ $userdata["company"] }}/'+type
          }).appendTo('#iframe'+idelement);

        }
    },
    <?php
      $boothassistantdata_id  = isset($boothassistantdata['_id'])?$boothassistantdata['_id']:'';
    ?>

    submitdata : {bootdataid: '<?php echo $boothassistantdata_id;?>',operationalformid:'<?php echo $data["_id"];?>'}
      

  });

  //print

  
});

$('.boothasstNameaddOnly').editable('{{ URL::to("exhibitor/addboothassname") }}', { 
    indicator : 'Saving...',
    name   : 'new_value',
    id : 'elementid',
    //data   : '{"unpaid":"Unpaid","paid":"Paid","free":"Free"}',
    type   : 'textarea',
    style   : 'display: inline',
    submit : 'OK',
    event  : "dblclick",

    callback : function(value, settings) {
      
      
      var idelement = $(this).attr('id');
      var type = $(this).attr('type');
      $(this).addClass('notimport');
      
  },
  

  submitdata : {bootdataid: '<?php echo $boothassistantdata_id;?>',operationalformid:'<?php echo $data["_id"];?>'}
    

});
$('body').on('click', '.printbadge', function(e){
  
    var _id = 'printbadge'+e.target.id;

    var pframe = document.getElementById(_id);
    var pframeWindow = pframe.contentWindow;
    pframeWindow.print();
    e.preventDefault();
    
});

$(document).ready(function(){
  var processingstat = $('#processingstat');
  var backdrop = $('.modal-backdrop');
  
  $('#importallexhibitor').click( function(){
      var idtoprocess = [];
      var currentidtoprocess = [];
      var currenttypetoprocess = [];
      var currenttypeidtoprocess = [];
      var currentpassnametoprocess = [];

      var totalSelected = 0;
      var totalSuccess = 0; 
      var dothat = 0;
      var totalFailure = 0;
      var value = 'blabla';

      $('.notimport').each(function() {

        var idRecord = $(this).attr('id');
        idtoprocess.push(idRecord);

        var thisitem = $(this);

        var current_id = $(this).parent().parent().find('td.status').attr('id');
        currentidtoprocess.push(current_id);

        var current_type = $(this).parent().parent().find('td.action a').attr('type');
        currenttypetoprocess.push(current_type);

        var current_type_id = $(this).parent().parent().find('td.action a').attr('typeid');
        currenttypeidtoprocess.push(current_type_id);

        var current_pass_name = $(this).parent().parent().find('td.passname').text();
        currentpassnametoprocess.push(current_pass_name);

        //var boothassistantdataid = '{{$boothassistantdata_id}}';
        
        
        
        totalSelected++;
      });
      
      if(totalSelected>0){

        var answer = confirm("Are you sure you want to import "+totalSelected+" data for "+companyname+" ?");
        
        if (answer){

          for (var i = 0; i < totalSelected; i++) {
              element = idtoprocess[i];

              elementcurrenttype = currenttypetoprocess[i];
              elementcurrenttypeid = currenttypeidtoprocess[i];
              elementcurrentpassname = currentpassnametoprocess[i];

              // Do something with element i.
              processingstat.show();
              backdrop.show();

              
            
              $.post('{{ URL::to($ajaxImportBoothAssistant) }}',{'exhibitorid':exhibitorid,'companyname':companyname,'companypic':companypic,'companypicemail':companypicemail,'hallname':hallname,'boothname':boothname,'type':elementcurrenttype,'typeid':elementcurrenttypeid,'passname':elementcurrentpassname}, function(data) {
              
              if(data.status == 'OK'){
                
                totalSuccess++;
                dothat++;
                if(dothat >= totalSelected){
                  processingstat.hide();
                  backdrop.hide();

                  alert("Succesfully imported "+totalSuccess+" data from "+totalSelected+ " selected data");
                  
                  <?php
                    $redirect = URL::to('exhibitor/importbothassistant/'.$exhibitorid);
                  ?>
                  setTimeout("location.href = '<?php echo $redirect;?>';",500);
                  
                }

              }else if(data.status == 'NOTFOUND'){
                totalFailure++;
                dothat++;
              }else{
                totalFailure++;
                dothat++;
              }
             
              console.log('Failure'+totalFailure);
              console.log('Success'+totalSuccess);
              console.log('process'+dothat);
            
            },'json');

          }
          
        }else{
          
        }

      }else{
        alert('There\s no data to import')
      }
      
      

  });

});

</script>

@endsection