@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}

<p>Registrasi kamu berhasil. Terima kasih sudah melakukan pendaftaran di {{ Config::get('site.title')}} 
<br/>Kamu akan menerima konfirmasi via e-mail.</p>

<p>{{ HTML::link('signin','Login sekarang',array('class'=>'backtohome'))}}
</p>


@endsection