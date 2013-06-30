@layout('public')

@section('content')
<div class="row">
    {{-- print_r($cart['items'])}}
    <div class="span12">
        <h3>Confirm Success</h3>
        <p>
            Thank you for shopping at Peach To Black, feel free to go back into our catalog again and shop for more.
        </p>
        <p>
            Your payment confirmation code is : <span class="big-code">{{ $cart['confirmationCode']}}</span>
        </p>
        <p>
            If you've made your transfer payment, kindly confirm your payment {{ HTML::link('shop/confirm', 'here') }}, using above code, so we can proceed with the delivery. Have a nice day ! 
        </p>
    </div>
</div>

@endsection