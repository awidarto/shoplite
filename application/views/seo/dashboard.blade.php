@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>


<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>SEO Global Keywords</legend>
                {{ $form->text('sitetitle','Site Title','',array('class'=>'text span12','id'=>'sitetitle')) }}
                <span id="update-seo-title" class="btn">Update</span>

                {{ $form->text('seokeywords','SEO Keywords','',array('class'=>'text span6 tag_keyword','id'=>'seokeywords')) }}
                <span id="update-seo" class="btn">Update</span>

                {{ $form->textarea('seodescriptions','SEO Descriptions','',array('class'=>'text span12','style'=>'height:170px', 'id'=>'seodescriptions')) }}
                <span id="update-seo-desc" class="btn">Update</span>

                {{ $form->text('seoauthor','Author','',array('class'=>'text span12','id'=>'seoauthor')) }}
                <span id="update-seo-author" class="btn">Update</span>

        </fieldset>


    </div>

    <div class="span6">

        <fieldset>
            <legend>Google Analytics</legend>

                {{ $form->textarea('googleanalytics','Google Analytics Snippet','',array('class'=>'text span12','style'=>'height:170px', 'id'=>'googleanalytics')) }}
                <span id="update-ga" class="btn">Update</span>

                {{ $form->text('googlesiteverification','Google Site Verification ID','',array('class'=>'text span12 ','id'=>'googlesiteverification')) }}
                <span id="update-seo-gsv" class="btn">Update</span>

                {{ $form->text('alexaid','Alexa ID','',array('class'=>'text span12 ','id'=>'alexaid')) }}
                <span id="update-seo-alexaid" class="btn">Update</span>

        </fieldset>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#update-ga').click(function(){
        var key = 'googleanalytics';
        var val = $('#googleanalytics').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Google Analytics updated');
            }else{
                alert('Failed to update Google Analytics');
            }
        },'json');

    });

    $('#update-seo-gsv').click(function(){
        var key = 'googlesiteverification';
        var val = $('#googlesiteverification').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Google Site Verification updated');
            }else{
                alert('Failed to update Google Site Verification');
            }
        },'json');

    });


    $('#update-seo').click(function(){
        var key = 'seokeywords';
        var val = $('#seokeywords').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('SEO Keywords updated');
            }else{
                alert('Failed to update SEO Keywords');
            }
        },'json');

    });

    $('#update-seo-title').click(function(){
        var key = 'sitetitle';
        var val = $('#sitetitle').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Site Title updated');
            }else{
                alert('Failed to update Site Title');
            }
        },'json');

    });


    $('#update-seo-author').click(function(){
        var key = 'seoauthor';
        var val = $('#seoauthor').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('SEO Author updated');
            }else{
                alert('Failed to update SEO Author');
            }
        },'json');

    });

    $('#update-seo-alexaid').click(function(){
        var key = 'alexaid';
        var val = $('#alexaid').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Alexa ID updated');
            }else{
                alert('Failed to update Alexa ID');
            }
        },'json');

    });

    $('#update-seo-desc').click(function(){
        var key = 'seodescriptions';
        var val = $('#seodescriptions').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('SEO Descriptions updated');
            }else{
                alert('Failed to update SEO Descriptions');
            }
        },'json');

    });



});

</script>


@endsection