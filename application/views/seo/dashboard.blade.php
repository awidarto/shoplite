@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>


<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>SEO Global Keywords</legend>
                {{ $form->text('seokeywords','SEO Keywords','',array('class'=>'text span6 tag_keyword','id'=>'seokeywords')) }}
                <span id="update-seo" class="btn">Update</span>

        </fieldset>


    </div>

    <div class="span6">

        <fieldset>
            <legend>Google Analytics</legend>

                {{ $form->textarea('googleanalytics','Google Analytics Snippet','',array('class'=>'text span12','style'=>'height:170px', 'id'=>'googleanalytics')) }}
                <span id="update-ga" class="btn">Update</span>
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


});

</script>


@endsection