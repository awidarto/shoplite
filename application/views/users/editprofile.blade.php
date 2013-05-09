@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('user/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}
<div class="row">
  <div class="six columns left">
    <h4>User Info</h4>
      <table class="profile-info">
        <tr>
          <td class="detail-title">Email</td>
          <td class="detail-info">{{ $user['email'] }}</td>
        </tr>
      </table>
    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->text('fullname','Full Name.req','',array('class'=>'text')) }}

  </div>
  <div class="five columns right">
    <h4>Contact Info</h4>
    {{ $form->text('mobile','Mobile Number','',array('class'=>'text')) }}
    {{ $form->text('home','Home Number','',array('class'=>'text')) }}
    {{ $form->textarea('street','Street','',array('class'=>'text')) }}
    {{ $form->text('city','City','',array('class'=>'text')) }}
    {{ $form->text('zip','ZIP','',array('class'=>'text')) }}

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