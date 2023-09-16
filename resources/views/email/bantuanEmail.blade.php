<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bantuan Email</title>
</head>

<body>
    <h1>Selamat anda mendapatkan bantuan sosial dari pemerintah</h1>
    <ul>
        <li>Email: {{ $data['email'] }}</li>
        <li>Nomor HP: {{ $data['nomor_hp'] }}</li>
        <li>Total Bantuan: {{ $data['total_bantuan'] }}</li>
        <li>Tanggal Pengambilan: {{ $data['tanggal_pengambilan'] }}</li>
    </ul>
    <p>Terima kasih atas dukungan Anda.</p>
</body>

</html>
