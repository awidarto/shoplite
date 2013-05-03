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
            <legend>Product Information</legend>
                
                {{ $form->text('name','Product Name.req','',array('class'=>'text span8','id'=>'name')) }}
                
                {{ $form->text('productcode','Product Code / SKU.req','',array('class'=>'text span8','id'=>'productcode')) }}
                {{ $form->text('permalink','Permalink.req','',array('class'=>'text span8','id'=>'permalink')) }}
                {{ $form->textarea('description','Description.req','',array('class'=>'text span8','id'=>'description')) }}

        </fieldset>
        <fieldset>
            <legend>Publishing</legend>

                {{ $form->select('publishStatus','Publish Status',Config::get('kickstart.publishstatus'),'online',array('id'=>'publishStatus'))}}<br />

                {{ $form->text('publishFrom','','',array('class'=>'text codePhone date','id'=>'publishFrom','placeholder'=>'From')) }}
                {{ $form->text('publishUntil','','',array('class'=>'text codePhone date','id'=>'publishUntil','placeholder'=>'To')) }}

        </fieldset>
        
    </div>

    <div class="span6">

        <fieldset>
            <legend>Product Details</legend>
                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('class'=>'span2','id'=>'priceCurrency'))}}<br />

                {{ $form->text('category','Category.req','',array('class'=>'text span6','id'=>'category')) }}

                {{ $form->text('tags','Tags.req','',array('class'=>'text span6','id'=>'tags')) }}



                {{ Form::label('price','Default Price Set *')}}
                <div class="row-fluid inputInline">
                  
                    {{$form->select('priceCurrency','',Config::get('shoplite.currency'),null,array('class'=>'areacodePhone','id'=>'priceCurrency'))}}<br />
                    {{ $form->text('retailPrice','','',array('class'=>'text codePhone','id'=>'retailPrice','placeholder'=>'Retail Price')) }}                  
                    {{ $form->text('salePrice','','',array('class'=>'text codePhone','id'=>'salePrice','placeholder'=>'Sale Price')) }}
                    {{ $form->text('effectiveFrom','','',array('class'=>'text codePhone date','id'=>'effectiveFrom','placeholder'=>'From')) }}
                    {{ $form->text('effectiveUntil','','',array('class'=>'text codePhone date','id'=>'effectiveUntil','placeholder'=>'To')) }}
                  
                </div>
        </fieldset>

        <fieldset>
            <legend>Product Main Pictures</legend>

              @for($i=1;$i<6;$i++)
                  <div class="row-fluid">

                    <div  class="span2">
                      {{ HTML::image(URL::base().'/storage/products/'.$formdata['_id'].'/sm_pic0'.$i.'.jpg?'.time(), 'sm_pic0'.$i.'.jpg', array('id' => $formdata['_id'])) }}
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
{{ Form::reset('Reset',array('class'=>'button'))}}
</div>
{{$form->close()}}


<script type="text/javascript">
$(document).ready(function() {

  $('select').select2({
    width : 'resolve'
  });

  $(":file").filestyle({
    //buttonText: 'Select file',
    //textField: true,
    classButton: 'uploader',
    //icon: false
  });
  
});

</script>

@endsection