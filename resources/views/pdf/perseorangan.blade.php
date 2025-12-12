<html>

<head>
    <style>
    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    .title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .label {
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 4px;
        vertical-align: top;
    }
    </style>
</head>

<body>

    <div class="title">Permohonan Informasi - Perseorangan</div>

    <table>
        <tr>
            <td class="label">Nama Pemohon:</td>
            <td>{{ $data->nama_pemohon }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Pemohon:</td>
            <td>{{ $data->alamat_pemohon }}</td>
        </tr>
        <tr>
            <td class="label">HP Pemohon:</td>
            <td>{{ $data->hp_pemohon }}</td>
        </tr>
        <tr>
            <td class="label">Email Pemohon:</td>
            <td>{{ $data->email_pemohon }}</td>
        </tr>

        <tr>
            <td class="label">Nama Pengguna:</td>
            <td>{{ $data->nama_pengguna ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Pengguna:</td>
            <td>{{ $data->alamat_pengguna ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">HP Pengguna:</td>
            <td>{{ $data->hp_pengguna ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Email Pengguna:</td>
            <td>{{ $data->email_pengguna ?? '-' }}</td>
        </tr>
    </table>

    <hr>
    <div class="label">Informasi Dibutuhkan:</div>
    <p>{{ $data->info_dibutuhkan }}</p>

    <div class="label">Alasan Butuh:</div>
    <p>{{ $data->alasan_butuh }}</p>

</body>

</html>