@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/cross.png','cross',array('class'=>'check-icon','style'=>'float:left;')) }}

<p>Maaf konfirmasi gagal, kode yang anda masukkan tidak ada di dalam system kami, silakan ulangi dengan kode yang benar, terima kasih</p>

</p>


@endsection