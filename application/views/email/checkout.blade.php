<html>
<body>
	<p>
		Pemesanan kamu telah berhasil!<br />

		Kami dari Peachtoblack Customer Service.<br />

		Terima kasih atas kepercayaan Anda untuk memilih Peachtoblack sebagai Media Belanja Online terpercaya.<br />
		<br />
		No. Order : {{ $cart['confirmationCode'] }}<br />
		Total Belanja : <br />
		<br />
		Langkah Selanjutnya :
	</p>


	<ol>
		<li>
			<p>
				Pemesanan hanya akan diproses bila pembayaran dilakukan dalam waktu 1 hari / 24   jam ke salah satu akun bank kami dibawah ini :
			</p>

			<p>
				<strong>BCA</strong><br />
                Atas Nama : Karissa Habibie<br />
                No Rek : 2861571388<br />
                Cabang : Kemang
			</p>
			<p>
				<strong>Permata Bank</strong><br />
				Atas Nama : Khairunnisa<br />
				No Rek : 975.420.760<br />
				Cabang : Pondok Indah
			</p>
			<p>
				* jika menggunakan m-banking, e-banking atau ATM non tunai
			</p>
		</li>
		<li>
			<p>
				Konfirmasi pembayaran Anda :<br />
				Jika Anda sudah melakukan pembayaran, mohon konfirmasi nya di :  {{ HTML::link('shop/confirm','Konfirmasi di sini')}},<br /> dengan menggunakan kode pesanan {{ $cart['confirmationCode'] }}
			</p>

		</li>
	</ol>

	<p>
		Berikut ringkasan pesanan anda :<br />
		{{ $ordertable }}

	</p>
	<p>
		Berikut data Alamat pengiriman yang tercatat di Kami :<br />
		<br />
		{{ $shippingaddress }}
		<br />
		Apabila ada perbedaan atau perubahan data alamat, mohon konfirmasikan kepada Kami.

	</p>
	<p>
		Pesanan akan otomatis dibatalkan jika Kami belum menerima pembayaran nya dalam jangka waktu 24 jam pada hari kerja sejak tanggal Order.
	</p>
	<p>
		Terima kasih,<br />
		<strong>Tim PEACHTOBLACK</strong>
	</p>
	<p>
		Ada pertanyaan?<br />

		Silakan hubungi Customer Service PEACHTOBLACK , email ke help@peachtoblack.com

	</p>

</body>

</html>

