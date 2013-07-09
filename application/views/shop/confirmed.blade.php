@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}

<p>Konfirmasi pembayaran kamu telah berhasil terkirim. Pemesanan kamu akan segera kami proses. Terima kasih</p>

</p>


@endsection