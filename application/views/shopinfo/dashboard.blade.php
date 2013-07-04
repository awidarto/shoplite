@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>


<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Shop Bank Accounts</legend>
                {{ $form->textarea('bankaccount1','Bank 1','',array('class'=>'text span12','style'=>'height:170px', 'id'=>'bankaccount1')) }}
                <span id="update-bank1" class="btn">Update</span>
                {{ $form->textarea('bankaccount1','Bank 2','',array('class'=>'text span12','style'=>'height:170px', 'id'=>'bankaccount2')) }}
                <span id="update-bank2" class="btn">Update</span>

        </fieldset>
    </div>

    <div class="span6">

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#update-bank1').click(function(){
        var key = 'bankaccount1';
        var val = $('#bankaccount1').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Bank Account 1 updated');
            }else{
                alert('Failed to update Bank Account');
            }
        },'json');

    });

    $('#update-bank2').click(function(){
        var key = 'bankaccount2';
        var val = $('#bankaccount2').val();

        $.post('{{ URL::to('ajax/param')}}',{ key: key, value: val },function(data){
            if(data.result == 'OK'){
                alert('Bank Account 2 updated');
            }else{
                alert('Failed to update Bank Account');
            }
        },'json');

    });


});

</script>


@endsection