@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('export','POST',array('class'=>'custom'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
<fieldset>

                {{$form->select('collection','Data to Export',Config::get('eventreg.collectiontype'),array('class'=>'span12'))}}


                {{ Form::label('format','Format')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('format','CSV','csv',true)}}
                    </div>
            <!--
                    <div class="span2">
                      {{ $form->radio('format','Excel','xls')}}
                    </div>
                    <div class="span2">
                      {{ $form->radio('format','Excel2004','xlsx')}}
                    </div>
                    <div class="span6"></div>
            -->
                </div>

                {{ Form::label('daterange','Range')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('daterange','All','all',true)}}
                    </div>
                    <div class="span10"></div>
                </div>
                <div class="row-fluid radioInput">
                    <div class="span4">
                      {{ $form->radio('daterange','Date of Creation','creation')}}
                    </div>
                    <div class="span8">
                        <div class="row-fluid">
                          <div class="span6">
                            {{ $form->text('fromDate','From','',array('class'=>'span11 date')) }}
                          </div>
                          <div class="span6">
                            {{ $form->text('toDate','To','',array('class'=>'span11 date')) }}
                          </div>
                        </div>
                    </div>
                </div>
        </fieldset>

    </div>

</div>
<br/>
<br/>
<div>
  <a class="btn btn-success" id="" href="{{URL::to('export/allboothassistant')}}"><span class="icon-">&#xe1dd;</span>&nbsp;Export All Exhibitor's Pass</a>
  
</div>
<hr />

<div class="row right">
    {{ Form::submit('Download',array('class'=>'button'))}}&nbsp;&nbsp;
    {{ Form::reset('Reset',array('class'=>'button'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2({
    width : 'resolve'
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
  $("#s2id_field_country").select2("val", "Indonesia");
</script>

@endsection