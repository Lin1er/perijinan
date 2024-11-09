<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ijin Notification</title>
</head>
<body>
    <h1>Notifikasi Ijin Baru</h1>
    <p>Nama Siswa: {{ $ijin->student->username }}</p>
    <p>Alasan Ijin: {{ $ijin->reason }}</p>
    <p>Status: {{ $ijin->verify_status == '1' ? 'Verified' : 'Pending' }}</p>
    <p>Lampiran PDF berisi detail ijin tersedia.</p>
</body>
</html>
