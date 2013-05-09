@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom addAttendeeForm'))}}

    {{ $form->hidden('id',$formdata['_id'])}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Main</legend>
                
                {{ $form->text('title','Title.req','',array('class'=>'text span12','id'=>'title')) }}
                
                {{ $form->text('slug','Slug.req','',array('class'=>'text span12','id'=>'slug')) }}
                {{ $form->textarea('shorts','Short.req','',array('class'=>'text span12','id'=>'shorts')) }}

                {{ Form::label('bodycopy','Body *') }}
                <div id="wysihtml5-toolbar" style="display: none;">
                  <a data-wysihtml5-command="bold">bold</a>
                  <a data-wysihtml5-command="italic">italic</a>
                  
                  <!-- Some wysihtml5 commands require extra parameters -->
                  <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a>
                  <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a>
                  <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a>
                  
                  <!-- Some wysihtml5 commands like 'createLink' require extra paramaters specified by the user (eg. href) -->
                  <a data-wysihtml5-command="createLink">insert link</a>
                  <div data-wysihtml5-dialog="createLink" style="display: none;">
                    <label>
                      Link:
                      <input data-wysihtml5-dialog-field="href" value="http://" class="text">
                    </label>
                    <a data-wysihtml5-dialog-action="save">OK</a> <a data-wysihtml5-dialog-action="cancel">Cancel</a>
                  </div>
                </div>

                {{ $form->textarea('bodycopy','','',array('class'=>'text span12','id'=>'bodycopy','style'=>'height:250px;')) }}

        </fieldset>
        
    </div>

    <div class="span6">

        <fieldset>
            <legend>Publishing</legend>

                {{ $form->select('publishStatus','Publish Status',Config::get('kickstart.publishstatus'),'online',array('id'=>'publishStatus'))}}<br />

                {{ $form->text('publishFrom','','',array('class'=>'text codePhone date','id'=>'publishFrom','placeholder'=>'From')) }}
                {{ $form->text('publishUntil','','',array('class'=>'text codePhone date','id'=>'publishUntil','placeholder'=>'To')) }}

        </fieldset>
        <fieldset>
            <legend>Details</legend>
                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('id'=>'section'))}}<br />

                {{ $form->text('category','Category.req','',array('class'=>'text span6','id'=>'category')) }}

                {{ $form->text('tags','Tags.req','',array('class'=>'text span6','id'=>'tags')) }}

        </fieldset>

        <fieldset>
            <legend>Pictures</legend>

              @for($i=1;$i<6;$i++)
                  <div class="row-fluid">


                    <div  class="span2">
                      {{ HTML::image(URL::base().'/storage/news/'.$formdata['_id'].'/sm_pic0'.$i.'.jpg?'.time(), 'sm_pic0'.$i.'.jpg', array('id' => $formdata['_id'])) }}
                    </div>

                    <div class="span7">
                      {{ $form->file('pic0'.$i,'Picture #'.$i)}}
                   </div>
                    <div class="span3">
                      {{ $form->radio('defaultpic','Default',$i)}}
                    </div>

                  </div>
              @endfor

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

{{ HTML::script('js/wysihtml5-0.3.0.min.js') }}   
{{ HTML::script('js/parser_rules/advanced.js') }}   

<script type="text/javascript">
$(document).ready(function() {

    $('select').select2({
      width : 'resolve'
    });

    $(":file").filestyle({
      classButton: 'uploader',
    });

    var editor = new wysihtml5.Editor('bodycopy', { // id of textarea element
      toolbar:      'wysihtml5-toolbar', // id of toolbar element
      parserRules:  wysihtml5ParserRules // defined in parser rules set 
    });

    $('#title').keyup(function(){
        var title = $('#title').val();
        var slug = string_to_slug(title);
        $('#slug').val(slug);
    });

  
});

</script>

@endsection