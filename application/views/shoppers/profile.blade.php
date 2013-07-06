@layout('public')

@section('content')
<?php
	$p = $profile;
?>

<div class="row">
	<div class="span12">
		<h3>{{ $p['firstname'].' '.$p['lastname']}}</h3>
		<h4>Member since {{ date('d-m-Y',$p['createdDate']->sec) }}</h4>
		<p>
			<i>{{ $p['email']}}</i><br />
			<strong>Address:</strong><br />
			{{ $p['address_1'] }}<br />

			@if($p['address_2'] != '')
				{{ $p['address_2'] }}<br />
			@endif
			
			{{ $p['city'].' '.$p['zip']}}<br />
			{{ $p['country']}}


		<ul>


		</ul>

		</p>
		<a href="{{ URL::to('myprofile/edit') }}">Edit My Profile</a>
	</div>
</div>

<?php
/*
Array
(
    [_id] => MongoId Object
        (
            [$id] => 51d6865dccae5bae02000000
        )

    [activeCart] => 51d69016ccae5b3203000000
    [address_1] => Komp DKI Joglo Blok D No 3 RT 001/004 Kembangan
    [address_2] => 
    [agreetnc] => Yes
    [bankname] => 
    [branch] => 
    [cardnumber] => 
    [ccname] => 
    [city] => Jakarta Barat
    [country] => Indonesia
    [createdDate] => MongoDate Object
        (
            [sec] => 1373013597
            [usec] => 745000
        )

    [email] => andy.awidarto@gmail.com
    [expiremonth] => 
    [expireyear] => 
    [firstname] => Andi
    [fullname] => Andi Karsono
    [lastUpdate] => MongoDate Object
        (
            [sec] => 1373013597
            [usec] => 745000
        )

    [lastname] => Awidarto
    [mobile] => 13424535576
    [pass] => $2a$08$YQIadPUH1EacgKauPzJiBuBxv6PWsuwPKLjDkgdwPkkhskmmpOirK
    [role] => shopper
    [saveinfo] => Yes
    [shippingphone] => 021-5841281
    [shopperseq] => 0000000012
    [zip] => 11640
)
*/
?>

@endsection
