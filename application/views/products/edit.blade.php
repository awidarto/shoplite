@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom addAttendeeForm','id'=>'productForm'))}}

    {{ $form->hidden('id',$formdata['_id'])}}


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
            <legend>Affiliates</legend>

                {{ $form->text('affiliateMerchant','Merchant Name','',array('class'=>'text','id'=>'affiliateMerchant','placeholder'=>'Merchant Name')) }}
                {{ $form->text('affiliateMerchantID','Merchant ID','',array('class'=>'text','id'=>'affiliateMerchantID','placeholder'=>'Merchant ID')) }}
                {{ $form->text('affiliateProductID','Product ID','',array('class'=>'text','id'=>'affiliateProductID','placeholder'=>'Product ID')) }}
                {{ $form->text('affiliateURL','Merchant Landing Page','',array('class'=>'text','id'=>'affiliateURL','placeholder'=>'Merchant Landing URL')) }}

        </fieldset>
                
        <fieldset>
            <legend>Related Products / Mix n Match Items</legend>

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

    </div>

    <div class="span6">

        <fieldset>
            <legend>Product Details</legend>
                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('id'=>'section'))}}<br />

                {{ $form->select('category','Category.req',Config::get('shoplite.categories'),null,array('id'=>'category'))}}<br />

                {{ $form->text('tags','Tags.req','',array('class'=>'text span6 tag_keyword','id'=>'tags')) }}



                {{ Form::label('price','Default Price Set *')}}
                <div class="row-fluid inputInline">
                  
                    {{$form->select('priceCurrency','',Config::get('shoplite.currency'),null,array('id'=>'priceCurrency'))}}<br />
                    {{ $form->text('retailPrice','Retail Price','',array('class'=>'text input-medium','id'=>'retailPrice','placeholder'=>'Retail Price')) }}                  
                    {{ $form->text('salePrice','Sale Price','',array('class'=>'text input-medium','id'=>'salePrice','placeholder'=>'Sale Price')) }}
                    {{ $form->checkbox('onsale','On Sale','Yes',null)}}<br />
                    {{ $form->text('effectiveFrom','From','',array('class'=>'text  input-medium date','id'=>'effectiveFrom','placeholder'=>'From')) }}
                    {{ $form->text('effectiveUntil','Until','',array('class'=>'text  input-medium date','id'=>'effectiveUntil','placeholder'=>'To')) }}
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
                            {{ $form->text('link','Link to Other Product','',array('id'=>'link_input','class'=>'input-large autocomplete_product'))}}
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

    // shared functions for dynamic table
    function addTableRow(table)
    {
        // clone the last row in the table
        var $tr = $(table).find('thead tr').clone();

        var trow = $('<tr></tr>');

        $tr.find('input').each(function(){
            console.log(this);
            var dt = $('<input type="text">').attr('name',$(this).attr('name')+'[]').attr('value',$(this).val()).attr('class',$(this).attr('class'));
            trow.append($('<td></td>').append(dt));
        })

        var act = $('<td><span class="btn del" style="cursor:pointer" ><b class="icon-minus-alt"></b></span></td>');
        
        trow.append(act);

        // append the new row to the table
        $(table).find('tbody').append(trow);

        $(table).find('thead input').val('');

    };    

    $('table').on('click','.del',function(){
        console.log($(this).closest('tr').html());
        $(this).closest('tr').remove();
    });


});

</script>

@endsection