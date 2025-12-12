<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .watermark {
            position: fixed;
            top: 30%;
            left: 15%;
            width: 500px;
            opacity: 0.08;
            z-index: -1;
            transform: rotate(-30deg);
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

    <img src="{{ public_path('frontpage/img/logo.png') }}" class="watermark">


    <div style="text-align:center; margin-bottom:20px;">
        <img src="{{ public_path('polije-admin/img/kop.png') }}" style="width:100%; max-height:150px;">
    </div>

    <div class="title">Permohonan Informasi - Lembaga</div>

    <table>
        <tr>
            <td class="label">Nama Organisasi:</td>
            <td>{{ $data->nama_organisasi }}</td>
        </tr>
        <tr>
            <td class=" label">Telp Organisasi:</td>
            <td>{{ $data->telp_organisasi }}</td>
        </tr>
        <tr>
            <td class="label">Email Organisasi:</td>
            <td>{{ $data->email_organisasi }}</td>
        </tr>
        <tr>
            <td class="label">Medsos:</td>
            <td>{{ $data->medsos_organisasi }}</td>
        </tr>

        <tr>
            <td class="label">Nama Narahubung:</td>
            <td>{{ $data->nama_narahubung }}</td>
        </tr>
        <tr>
            <td class="label">Telp Narahubung:</td>
            <td>{{ $data->telp_narahubung }}</td>
        </tr>
    </table>

    <hr>
    <div class="label">Informasi Dibutuhkan:</div>
    <p>{{ $data->info_dibutuhkan }}</p>

    <div class="label">Alasan Butuh:</div>
    <p>{{ $data->alasan_butuh }}</p>

</body>

</html>