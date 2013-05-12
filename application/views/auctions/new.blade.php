@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom addAttendeeForm'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Product Information</legend>
                
                {{ $form->text('name','Product Name.req','',array('class'=>'text span8','id'=>'name')) }}
                
                {{ $form->text('productcode','Product Code / SKU.req','',array('class'=>'text span8','id'=>'productcode')) }}
                {{ $form->textarea('description','Description.req','',array('class'=>'text span8','id'=>'description')) }}

                {{ Form::label('bodycopy','About Product *') }}
                {{ View::make('partials.editortoolbar')->render() }}
                {{ $form->textarea('bodycopy','','',array('class'=>'text span11','id'=>'bodycopy','style'=>'height:200px;')) }}

        </fieldset>
        <fieldset>
            <legend>Publishing</legend>

                {{ $form->select('publishStatus','Publish Status',Config::get('kickstart.publishstatus'),'online',array('id'=>'publishStatus'))}}<br />

                {{ $form->text('publishFrom','','',array('class'=>'text codePhone date','id'=>'publishFrom','placeholder'=>'From')) }}
                {{ $form->text('publishUntil','','',array('class'=>'text codePhone date','id'=>'publishUntil','placeholder'=>'To')) }}

        </fieldset>

        <fieldset>
            <legend>Product Pictures</legend>

              @for($i=1;$i<6;$i++)
                  <div class="row-fluid">
                    <div class="span8">
                      {{ $form->file('pic0'.$i,'Picture #'.$i)}}
                   </div>
                    <div class="span4">
                      @if($i == 1)
                        {{ $form->radio('defaultpic','Default',$i,true)}}
                      @else
                        {{ $form->radio('defaultpic','Default',$i)}}
                      @endif
                    </div>
                  </div>
              @endfor

        </fieldset>
        
    </div>

    <div class="span6">

        <fieldset>
            <legend>Auction Details</legend>
                {{ $form->text('title','Auction Title.req','',array('class'=>'text span8','id'=>'title')) }}

                {{ $form->text('permalink','Permalink.req','',array('class'=>'text span8','id'=>'permalink')) }}

                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('id'=>'section'))}}<br />

                {{ $form->select('category','Category.req',Config::get('shoplite.categories'),null,array('id'=>'category'))}}<br />

                {{ $form->text('tags','Tags.req','',array('class'=>'text tag_keyword span6','id'=>'tags')) }}

                {{ Form::label('price','Auction Price Setting *')}}
                <div class="row-fluid inputInline">
                  
                    {{$form->select('priceCurrency','',Config::get('shoplite.currency'),null,array('id'=>'priceCurrency'))}}<br />
                    {{ $form->text('startingPrice','Retail Price','',array('class'=>'text input-medium','id'=>'retailPrice','placeholder'=>'Starting Price')) }}                  
                    {{ $form->text('incrementalPrice','Incremental Value','',array('class'=>'text input-medium','id'=>'salePrice','placeholder'=>'Increment Value')) }}<br />
                  
                </div>
        </fieldset>

        <fieldset>
            <legend>Auction Run Setting</legend>

                {{$form->select('auctionRun','',Config::get('shoplite.auction_run'),'auto',array('id'=>'auctionRun'))}}<br />

                {{ $form->text('auctionStart','From','',array('class'=>'text input-medium date','id'=>'auctionStart','placeholder'=>'From')) }}
                {{ $form->text('auctionEnd','Until','',array('class'=>'text input-medium date','id'=>'auctionEnd','placeholder'=>'To')) }}

        </fieldset>
        <fieldset>
            <legend>Thresholds</legend>

              @for($i=1;$i<4;$i++)
                  <div class="row-fluid">
                    <div class="span4">
                        {{ $form->text('bidValue_'.$i,'Bid Value '.$i,'',array('class'=>'text input-medium','id'=>'bidValue_'.$i,'placeholder'=>'Bid Value')) }}
                    </div>
                    <div class="span8">
                        {{ $form->textarea('message_'.$i,'Message '.$i,'',array('class'=>'text','id'=>'message_'.$i,'style'=>'height:70px;')) }}
                   </div>
                  </div>
              @endfor

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'btn primary'))}}&nbsp;&nbsp;
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

    $('#field_role').change(function(){
        //alert($('#field_role').val());
        // load default permission here
    });

    var editor = new wysihtml5.Editor('bodycopy', { // id of textarea element
      toolbar:      'wysihtml5-toolbar', // id of toolbar element
      parserRules:  wysihtml5ParserRules // defined in parser rules set 
    });

    $('#title').keyup(function(){
        var title = $('#title').val();
        var slug = string_to_slug(title);
        $('#permalink').val(slug);
    });


});

</script>

@endsection