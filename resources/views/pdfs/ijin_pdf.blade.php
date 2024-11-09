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

        hr {
            margin: 0px;
            border: solid;
            height: 0.3px;
        }

        p,
        span {
            font-size: 10px;
        }

        p {
            margin: 0.8px;
        }

        body,
        html {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-wrap: nowrap;
            position: relative;
            width: 595px;
            height: fit-content;
            margin: 0 auto;
            background: #ffffff;
            /* overflow: hidden; */
        }

        .container {
            width: 595px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            font-size: 12px;
            position: relative;
            margin-top: 20px;
        }

        .kemenag {
            position: absolute;
            left: 20px;
            top: 1px;
        }

        .header h1 {
            font-weight: 700;
            font-size: 12px;
            margin: 0;
        }

        .title {
            text-align: center;
            font-weight: 700;
            font-size: 11px;
            margin: 0;
        }

        h2 {
            font-size: 12px;
            margin: 10px;
            text-decoration: underline;
        }

        .info-section {
            padding-left: 10px;
            margin-top: 8px;
        }

        .info-section span {
            display: block;
            margin-bottom: 5px;
        }

        .footer {
            height: fit-content;
            width: fit-content;
        }

        .waka {
            position: absolute;
            top: 280px;
            right: 78px;
        }

        .info-section .info-item {
            display: flex;
            margin-bottom: 8px;
        }

        .info-section .info-item .label {
            width: 100px;
            /* Atur lebar yang sama untuk semua label */
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('pdf_assets/images/kemenag_logo.png') }}" class="kemenag" width="70"
                height="62">
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

        <hr>

        <!-- Judul Surat -->
        <div class="title">
            <h2>SURAT IZIN KELUAR</h2>
        </div>

        <!-- Informasi Siswa -->
        <div class="info-section">
            <p style="margin-bottom: 8px">Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

            <div class="info-item">
                <span class="label">Nama</span>
                <span>: {{ $ijin->student->name }}</span>
            </div>

            {{-- <div class="info-item">
                <span class="label">Umur:</span>
                <span>{{ number_format($ijin->student->born_date->diffInYears(\Carbon\Carbon::now()), 0) }} tahun</span>
            </div> --}}

            <div class="info-item">
                <span class="label">Kelas</span>
                <span>: {{ $ijin->student->studentClass->name }}</span>
            </div>

            <div class="info-item">
                <span class="label">Alamat</span>
                <span>: {{ $ijin->student->address }}</span>
            </div>

            <div class="info-item">
                <span class="label">Keperluan</span>
                <span>: {{ $ijin->reason }}</span>
            </div>
        </div>


        <!-- Pernyataan Izin -->
        <div class="info-section">
            <p>Diberikan izin meninggalkan asrama MAN Insan Cendekia Lampung Timur selama
                {{ $ijin->date_pick->diffInDays($ijin->date_return) }} hari terhitung mulai tanggal
                {{ $ijin->date_pick->format('d-m-y') }} sampai {{ $ijin->date_return->format('d-m-y') }}.</p>
            <p>Demikian surat ini kami buat agar dapat digunakan sesuai kebutuhan.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="waka">
                <p>Labuhan Ratu, {{ $ijin->created_at->format('d-m-y') }}</p>
                <p>Mengetahui,</p>
                <p>Waka Asrama</p>
                <br>
                <br>
                <br>
                <p>Ellynda Mufidah, S.Hum</p>
            </div>
        </div>
    </div>
</body>

</html>
