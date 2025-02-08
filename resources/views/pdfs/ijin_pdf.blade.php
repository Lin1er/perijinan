<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Keluar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@400;700&display=swap">
    <style>
        :root {
            --font-family: "Inria Sans", Arial, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-wrap: nowrap;
            position: relative;
            width: 640px;
            height: fit-content;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
        }
        .container {
            width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            font-size: 20px;
            position: relative;
            margin-top: 0px;
        }
        hr.head-line {
            position: absolute;
            left: -15px;
            width: 710px;
        }
        .kemenag {
            position: absolute;
            left: -20px;
            top: 1px;
        }
        .header h1 {
            font-weight: 700;
            font-size: 16px;
            margin: 0;
        }
        .header div p {
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-weight: 700;
            margin: 0;
            margin-top: 10px;
        }
        .title h2 {
            font-size: 15px;
            text-decoration: underline;
        }
        .info-section {
            padding-left: 10px;
            /* margin-top: 8px; */
        }
        .info-section p {
            margin: 2px;
        }
        .info-section span {
            display: block;
            margin-bottom: 5px;
        }
        .info-section .biodata{
            margin-left: 20px;
        }
        .footer {
            height: fit-content;
            width: fit-content;
        }
        .waka {
            position: absolute;
            top: 400px;
            right: 10px;
        }
        .waka p {
            margin: 0;
        }
        .info-section .info-item {
            margin-bottom: -2px;
            font-size: 15px;
        }
        .info-section .info-item span {
            display: inline-block;
        }
        .info-section .info-item .label {
            width: 100px;
            font-weight: bold;
        }
        hr.sign-line {
            margin: 0px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('pdf_assets/images/kemenag_logo.png') }}" class="kemenag" width="80"
                height="72">
            <div>
                <h1>KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
                    KANTOR KEMENTRIAN AGAMA KABUPATEN LAMPUNG TIMUR<br>
                    MAN INSAN CENDEKIA LAMPUNG TIMUR</h1>
                <p style="margin : 0px">Jl. Taman Nasional Way Kambas Desa Rajabasa Lama 1 Kec. Labuhan Ratu Kab.
                    Lampung Timur</p>
                <p style="margin : 0px">Telp. (0725)7647523 | Website: <a
                        href="https://maniclampungtimur.sch.id">maniclampungtimur.sch.id</a></p>
            </div>
        </div>

        <hr class="head-line">

        <div class="title">
            <h2>SURAT IZIN KELUAR</h2>
        </div>

        <div class="info-section bio">
            <p style="margin-bottom: 8px">Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

            <div class="info-item biodata">
                <span class="label">Nama</span>
                <span>: {{ $ijin->student->name }}</span>
            </div>

            {{-- <div class="info-item">
                <span class="label">Umur:</span>
                <span>{{ number_format($ijin->student->born_date->diffInYears(\Carbon\Carbon::now()), 0) }} tahun</span>
            </div> --}}

            <div class="info-item biodata">
                <span class="label">Angkatan</span>
                <span>: {{ $ijin->student->studentClass->batch }} {{ $ijin->student->studentClass->name }}</span>
            </div>

            <div class="info-item biodata">
                <span class="label">Alamat</span>
                <span>: {{ $ijin->student->address }}</span>
            </div>

            <div class="info-item biodata">
                <span class="label">Keperluan</span>
                <span>: {{ $ijin->reason }}</span>
            </div>

            <div class="info-item biodata">
                <span class="label">Izin berlaku</span>
                <span>: {{ $ijin->date_pick->format('d-m-Y') }} s/d {{ $ijin->date_return->format('d-m-Y') }}</span>
            </div>

            <div class="info-item biodata">
                <span class="label">Catatan izin</span>
                <span>: {{ $ijin->notes }}</span>
            </div>
        </div>


        <div class="info-section">
            <p>Diberikan izin meninggalkan asrama MAN Insan Cendekia Lampung Timur selama
                {{ $ijin->date_pick->diffInDays($ijin->date_return) }} hari terhitung mulai tanggal
                {{ $ijin->date_pick->format('d-m-y') }} sampai {{ $ijin->date_return->format('d-m-y') }}.</p>
            <p>Demikian surat ini kami buat agar dapat digunakan sesuai kebutuhan.</p>
        </div>

        <div class="footer">
            <div class="waka">
                {{-- <p>Labuhan Ratu, {{ $ijin->created_at->format('d-m-y') }}</p> --}}
                <p>Mengetahui,</p>
                <p>Waka Asrama, Labuhan Ratu, {{ $ijin->created_at->format('d-m-y') }}</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr class="sign-line">
                <p>Ellynda Mufidah, S.Hum</p>
            </div>
        </div>
    </div>
</body>

</html>

