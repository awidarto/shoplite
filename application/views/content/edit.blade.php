@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open_for_files('content/edit/'.$doc['_id'],'POST',array('class'=>'custom','id'=>'newdoc'))}}
<div class="row">
  <div class="seven columns left">
    {{ $form->hidden('id',$doc['_id'])}}

    {{ $form->hidden('oldTag',$doc['oldTag'])}}

    {{ $form->text('title','Title.req','',array('class'=>'text')) }}

    {{ $form->textarea('description','Description.req','',array('class'=>'text')) }}

    {{ $form->textarea('body','Body','',array('class'=>'text')) }}

  </div>
  <div class="four columns right">

    {{ $form->text('slug','Permalink','',array('class'=>'twelve')) }}

    {{ $form->select('section','Section',Config::get('kickstart.contentsection'),array('class'=>'one'))}}

    {{ $form->select('category','Category',Config::get('kickstart.contentcategory'),array('class'=>'one'))}}

    {{ $form->checkbox('published','Published',1)}}

    {{ $form->checkbox('always','Unlimited Date',1)}} 

    {{ $form->text('startDate','Start Publishing','',array('class'=>'five date')) }}

    {{ $form->text('endDate','End Publishing','',array('class'=>'five date')) }}

    {{ $form->text('tag','Tag','',array('class'=>'tag_keyword','rows'=>'1')) }}

  </div>
</div>

<div class="row">
  <div class="twelve columns">

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

  $('#newdoc').submit(function() {
    $('#upload-indicator').toggle();
    $('#newdoc').submit();
  });

</script>

@endsection