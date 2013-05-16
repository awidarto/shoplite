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
                {{ $form->text('permalink','Permalink.req','',array('class'=>'text span8','id'=>'permalink')) }}
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
            <legend>Ownership</legend>
                <div class="annotation">Leave blank for single merchant shop</div>
                {{ $form->text('ownerMerchant','Merchant Name','',array('class'=>'text input-xlarge','id'=>'ownerMerchant','placeholder'=>'Merchant Name')) }}
                {{ $form->text('ownerMerchantID','Merchant ID','',array('class'=>'text input-xlarge','id'=>'ownerMerchantID','placeholder'=>'Merchant ID')) }}
        </fieldset>

        <fieldset>
            <legend>Affiliates</legend>

                {{ $form->text('affiliateMerchant','Merchant Name','',array('class'=>'text input-xlarge','id'=>'affiliateMerchant','placeholder'=>'Merchant Name')) }}
                {{ $form->text('affiliateMerchantID','Merchant ID','',array('class'=>'text input-xlarge','id'=>'affiliateMerchantID','placeholder'=>'Merchant ID')) }}
                {{ $form->text('affiliateProductID','Product ID','',array('class'=>'text input-xlarge','id'=>'affiliateProductID','placeholder'=>'Product ID')) }}
                {{ $form->text('affiliateURL','Merchant Landing Page','',array('class'=>'text input-xxlarge','id'=>'affiliateURL','placeholder'=>'Merchant Landing URL')) }}

        </fieldset>

        <fieldset>
            <legend>Related Products</legend>

            <table id="relatedTable">
                <thead>
                    <tr>
                        <th>
                            {{ $form->text('related','Product Name','',array('class'=>'text autocomplete_product', 'id'=>'related','placeholder'=>'Product Name')) }}
                        </th>
                        <th>
                            {{ $form->text('relatedId','Product ID','',array('class'=>'text','id'=>'related_id','placeholder'=>'Related ID')) }}
                        </th>
                        <th>
                            <span class="btn" id="related_add_btn" style="cursor:pointer" ><b class="icon-plus-alt"></b></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </fieldset>

        <fieldset>
            <legend>Compound Product</legend>

            {{ $form->checkbox('groupParent','This Product is a Compound Product','Yes',null)}}
        </fieldset>

        <fieldset>
            <legend>Compound Product Component</legend>

            <table id="componentTable">
                <thead>
                    <tr>
                        <th>
                            {{ $form->text('component','Product Name','',array('class'=>'text autocomplete_product', 'id'=>'component','placeholder'=>'Product Name')) }}
                        </th>
                        <th>
                            {{ $form->text('componentId','Product ID','',array('class'=>'text','id'=>'component_id','placeholder'=>'Related ID')) }}
                        </th>
                        <th>
                            <span class="btn" id="component_add_btn" style="cursor:pointer" ><b class="icon-plus-alt"></b></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($formdata['componentProducts']))
                        <?php $classes = array('input-large','input-large'); ?>
                        {{ makerows($formdata['componentProducts'],$classes) }}
                    @endif
                </tbody>
            </table>

        </fieldset>
        
    </div>

    <div class="span6">

        <fieldset>
            <legend>Product Details</legend>

                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('id'=>'section'))}}<br />

                {{ $form->select('category','Category.req',Config::get('shoplite.categories'),null,array('id'=>'category'))}}<br />

                {{ $form->text('tags','Tags.req','',array('class'=>'text tag_keyword span6','id'=>'tags')) }}



                {{ Form::label('price','Default Price Set *')}}
                <div class="row-fluid inputInline">
                  
                    {{$form->select('priceCurrency','',Config::get('shoplite.currency'),null,array('id'=>'priceCurrency'))}}<br />
                    {{ $form->text('retailPrice','Retail Price','',array('class'=>'text input-medium','id'=>'retailPrice','placeholder'=>'Retail Price')) }}                  
                    {{ $form->text('salePrice','Sale Price','',array('class'=>'text input-medium','id'=>'salePrice','placeholder'=>'Sale Price')) }}<br />
                    {{ $form->text('effectiveFrom','From','',array('class'=>'text input-medium date','id'=>'effectiveFrom','placeholder'=>'From')) }}
                    {{ $form->text('effectiveUntil','Until','',array('class'=>'text input-medium date','id'=>'effectiveUntil','placeholder'=>'To')) }}
                  
                </div>
        </fieldset>

        <fieldset>
            <legend>Product Main Pictures</legend>

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

        <fieldset>
            <legend>Product Variants</legend>

            <datalist id="sizeOptions">
              <option value="All Size"></option>
              <option value="XS"></option>
              <option value="S"></option>
              <option value="M"></option>
              <option value="L"></option>
              <option value="XL"></option>
              <option value="XXL"></option>
              <option value="XXXL"></option>
            </datalist>

            <table id="variantTable">
                <thead>
                    <tr>
                        <th>
                            {{ $form->text('size','Size','',array('id'=>'size_input','class'=>'input-small','list'=>'sizeOptions'))}}
                        </th>
                        <th>
                            {{ $form->text('color','Color','',array('id'=>'color_input','class'=>'input-small'))}}
                        </th>
                        <th>
                            {{ $form->text('qty','Qty','',array('id'=>'qty_input','class'=>'input-small'))}}
                        </th>
                        <th>
                            {{ $form->text('link','Link to Other Product','',array('id'=>'link_input','class'=>'input-large autocomplete_product_link'))}}
                        </th>
                        <th>
                            <span class="btn" id="add_btn" style="cursor:pointer" ><b class="icon-plus-alt"></b></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </fieldset>

        <fieldset>
            <legend>Custom Fields</legend>

            <table id="customTable">
                <thead>
                    <tr>
                        <th>
                            {{ $form->text('cfield','Field Name','',array('id'=>'cfield_input','class'=>'input-large')) }}
                        </th>
                        <th>
                            {{ $form->text('cvalue','Field Value','',array('id'=>'cvalue_input','class'=>'input-small'))}}
                        </th>
                        <th>
                            {{ $form->text('cunit','Field Unit','',array('id'=>'cunit_input','class'=>'input-small','list'=>'unitOptions'))}}
                        </th>
                        <th>
                            <span class="btn" id="custom_add_btn" style="cursor:pointer" ><b class="icon-plus-alt"></b></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

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

    $('#name').keyup(function(){
        var title = $('#name').val();
        var slug = string_to_slug(title);
        $('#permalink').val(slug);
    });

    $('#color_input').colorPicker();
    
    // dynamic tables
    $('#add_btn').click(function(){
        //alert('click');
        addTableRow($('#variantTable'));
        return false;
    });

    // custom field table
    $('#custom_add_btn').click(function(){
        //alert('click');
        addTableRow($('#customTable'));
        return false;
    });

    $('#related_add_btn').click(function(){
        //alert('click');
        addTableRow($('#relatedTable'));
        return false;
    });

    $('#component_add_btn').click(function(){
        //alert('click');
        addTableRow($('#componentTable'));
        return false;
    });



});

</script>

@endsection