<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#000;
}

.header{
    width:100%;
    border-bottom:3px solid #0f3c78;
    padding-bottom:10px;
    margin-bottom:20px;
}

.logo{
    width:80px;
    float:left;
}

.title{
    text-align:center;
}

.title h2{
    margin:0;
    font-size:22px;
}

.title h3{
    margin:3px 0;
    font-size:16px;
}

.title p{
    margin:2px;
    font-size:11px;
}

.clear{
    clear:both;
}

.judul{
    text-align:center;
    margin:20px 0;
}

.judul h3{
    margin:0;
    font-size:18px;
}

.info{
    margin-bottom:15px;
}

.info table{
    width:50%;
}

.info td{
    padding:3px;
}

table.data{
    width:100%;
    border-collapse:collapse;
}

table.data th{
    background:#0f3c78;
    color:#fff;
    border:1px solid #000;
    padding:7px;
}

table.data td{
    border:1px solid #000;
    padding:6px;
}

.total{
    margin-top:20px;
}

.total table{
    width:40%;
}

.total td{
    border:1px solid #000;
    padding:7px;
}

.ttd{
    margin-top:50px;
    width:100%;
}

.ttd div{
    width:250px;
    float:right;
    text-align:center;
}

.footer{
    margin-top:40px;
    text-align:center;
    font-size:10px;
    color:#666;
}

</style>

</head>

<body>

<div class="header">

    <img
        src="{{ public_path('images/logo.png') }}"
        class="logo">

    <div class="title">

        <h2>

            MONITORING DANA BANTUAN STUDI

        </h2>

        <h2>

            KABUPATEN MAMBERAMO TENGAH

        </h2>

        <h3>

            DINAS PENDIDIKAN

        </h3>

        <p>

            Kobakma - Kabupaten Mamberamo Tengah

        </p>

    </div>

    <div class="clear"></div>

</div>

<div class="judul">

    <h3>

        LAPORAN PENGGUNAAN DANA BEASISWA

    </h3>

</div>

<div class="info">

<table>

<tr>

<td width="180">

Tahun

</td>

<td>

: {{ $tahun }}

</td>

</tr>

<tr>

<td>

Tanggal Cetak

</td>

<td>

: {{ now()->format('d-m-Y') }}

</td>

</tr>

<tr>

<td>

Total Data

</td>

<td>

: {{ $laporans->count() }}

</td>

</tr>

</table>

</div>

<table class="data">

<thead>

<tr>

<th>No</th>

<th>Mahasiswa</th>

<th>NIM</th>

<th>Kategori</th>

<th>Tanggal</th>

<th>Nominal</th>

<th>Monitoring</th>

</tr>

</thead>

<tbody>

@foreach($laporans as $item)

<tr>

<td align="center">

{{ $loop->iteration }}

</td>

<td>

{{ $item->mahasiswa->nama }}

</td>

<td>

{{ $item->mahasiswa->nim }}

</td>

<td>

{{ $item->kategori->nama }}

</td>

<td align="center">

{{ $item->tanggal->format('d-m-Y') }}

</td>

<td align="right">

Rp {{ number_format($item->nominal,0,',','.') }}

</td>

<td align="center">

{{ $item->tanggal_monitoring ? 'Sudah' : 'Belum' }}

</td>

</tr>

@endforeach

</tbody>

</table>

<div class="total">

<table>

<tr>

<td>

<b>Total Penggunaan</b>

</td>

<td align="right">

{{ $laporans->count() }}

</td>

</tr>

<tr>

<td>

<b>Total Dana</b>

</td>

<td align="right">

Rp {{ number_format($laporans->sum('nominal'),0,',','.') }}

</td>

</tr>

</table>

</div>

<div class="ttd">

<div>

Kobakma,
{{ now()->format('d F Y') }}

<br><br>

Kepala Dinas Pendidikan

<br><br><br><br><br>

(...................................)

</div>

<div class="clear"></div>

</div>

<div class="footer">

Laporan ini dibuat secara otomatis oleh Sistem Monitoring Dana Bantuan Studi Kabupaten Mamberamo Tengah.

</div>

</body>

</html>