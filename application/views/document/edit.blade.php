@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

<?php
  //print_r($doc);
?>

{{$form->open_for_files('document/edit/'.$doc['_id'].'/'.$type,'POST',array('class'=>'custom'))}}
<div class="row">
  <div class="six columns left">
    <h4>Document Info</h4>
    {{ $form->hidden('id',$doc['_id'])}}
    {{ $form->text('title','Title.req','',array('class'=>'text')) }}

    {{$form->select('docFormat','Original Document Format',Config::get('kickstart.doc_format'),array('class'=>'four'))}}

    <p><strong>Current Active Attachment :</strong><br />{{ (isset($doc['docFiledata']['uploadTime']))?date('d-m-Y h:i:s',$doc['docFiledata']['uploadTime']->sec):'' }} <strong>{{$doc['docFiledata']['name']}}</strong></p>

    <p><strong>Attachment History :</strong><br />
      @if(isset($doc['docFileList']))
        <ol>
          @foreach($doc['docFileList'] as $f)
          <li>
            {{ (isset($f['uploadTime']))?date('d-m-Y h:i:s',$f['uploadTime']->sec):'' }} <strong>{{$f['name']}}</strong>
          </li>
          @endforeach
        </ol>
      @endif
    </p>

    {{ $form->file('docupload','Document File')}}

    {{ $form->text('docRevisionOf','Revision of','',array('class'=>'tag_revision four','rows'=>'1', 'style'=>'width:100%')) }}

    <div class="row">
      <div class="five columns left">
        {{ $form->text('effectiveDate','Effective Date','',array('class'=>'twelve date')) }}
      </div>
      <div class="five columns right">
        {{ $form->text('expiryDate','Expiry Date','',array('class'=>'twelve date')) }}
      </div>
    </div>

    {{ Form::label('access','This document is')}}
    <div class="row">
      <div class="five columns left">
        {{ $form->radio('access','Confidential','confidential')}} 
      </div>   
      <div class="five columns right">
        {{ $form->radio('access','General','general')}} 
      </div>   
    </div>
    <p>
      <strong>Private</strong> document ( default ) can only be seen by its creator and people it was shared with.<br />
      <strong>Public</strong> document will be able to be seen by creator's peers at the same department, and superiors with higher access level. 
    </p>

    {{ $form->text('docShare','Shared to ( default to all department member )','',array('class'=>'tag_email four','style'=>'width:100%')) }}

    {{ $form->text('docApprovalRequest','Request Approval From','',array('class'=>'tag_email four', 'style'=>'width:100%')) }}

    {{ $form->hidden('oldTag',$doc['oldTag'])}}

    {{ $form->text('docTag','Search Keyword','',array('class'=>'tag_keyword four','rows'=>'1', 'style'=>'width:100%')) }}

  </div>
  <div class="five columns right">
    <h4>Metadata</h4>

    {{$form->select('docDepartment','Department of Origin',Config::get('kickstart.department'),null,array('class'=>'ten'))}}

    {{ $form->select('docCategory','Category',Config::get('kickstart.doc_type'),null,array('class'=>'ten'))}}
    
    <hr />

    <!-- related project -->
    {{ $form->text('docProject','Related Project Number','',array('id'=>'project_number','class'=>'auto_project_number four','rows'=>'1', 'style'=>'width:100%')) }}

    {{ $form->hidden('docProjectId','',array('id'=>'project_id')) }}

    {{ $form->text('docProjectTitle','Project Name','',array('id'=>'project_title','class'=>'auto_project_name four','rows'=>'1', 'style'=>'width:100%')) }}

    <hr />
    <!-- related tender -->
    {{ $form->text('docTender','Related Tender Number','',array('id'=>'tender_number','class'=>'auto_tender_number four','rows'=>'1', 'style'=>'width:100%')) }}

    {{ $form->hidden('docTenderId','',array('id'=>'tender_id')) }}

    {{ $form->text('docTenderTitle','Tender Name','',array('id'=>'tender_title','class'=>'auto_tender_name four','rows'=>'1', 'style'=>'width:100%')) }}

    <hr />
    <!-- related opportunity -->
    {{ $form->text('docOpportunity','Related Opportunity Number','',array('id'=>'opportunity_number','class'=>'auto_opportunity_number four','rows'=>'1', 'style'=>'width:100%')) }}

    {{ $form->hidden('docOpportunityId','',array('id'=>'opportunity_id')) }}

    {{ $form->text('docOpportunityTitle','Opportunity Name','',array('id'=>'opportunity_title','class'=>'auto_opportunity_name four','rows'=>'1', 'style'=>'width:100%')) }}

  </div>
</div>
<hr />
<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2();

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

@endsection