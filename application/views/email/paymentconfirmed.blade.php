<html>
<body>

<p>
    Halo {{ $cart['buyerDetail']['fullname'] }},<br />
    Terima kasih telah mengkonfirmasi pembayaran, berikut data konfirmasi yang kami terima :
</p>

<p>
    Confirmation Code: {{ $cart['confirmationCode']}}<br />
    Transfer to Bank: {{ $confirmation['destinationBank'] }}<br />
    Amount: {{ $confirmation['transferAmount'] }}<br />
    Account Holder Name: {{ $confirmation['sourceAccName'] }}<br />

</p>

<p>
    Pemesanan kamu akan segera di klarifikasi oleh finance dan admin Peach To Black. Mohon diingat bahwa transaksi beda bank dapat memakan waktu 1-2 hari hingga proses pengiriman barang. Terima kasih.
</p>

<p>
    Terima kasih,<br />
    <strong>Tim PEACHTOBLACK</strong>
</p>
<p>
    Ada pertanyaan?<br />

    Silakan hubungi Customer Service PEACHTOBLACK , email ke help@peachtoblack.com

</p>
<p>
    For update follow us on Twitter @PeachtoBlack and <a href="http://www.facebook.com/peachtoblack">Facebook</a>.
</p>

</body>
</html>
