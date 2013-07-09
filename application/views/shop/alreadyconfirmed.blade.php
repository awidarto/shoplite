@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}

<p>Pembayaran sudah dikonfirmasi sebelumnya. Pemesanan kamu sedang kami proses. Terima kasih</p>

</p>


@endsection