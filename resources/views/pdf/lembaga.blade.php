<html>

<head>
    <style>
        /* @page {
            size: A5 portrait;
        } */

        body {
            font-family: sans-serif;
            font-size: 13px;

            margin-bottom: 0;
            /* ruang agar konten tidak menimpa footer */
        }

        body::before {
            content: "";
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;

            background-image: url("{{ public_path('frontpage/img/logo.png') }}");
            background-repeat: repeat;
            background-size: 200px;

            transform: rotate(-30deg);
            opacity: 0.035;
            z-index: -1;
        }

        .title {
            text-align: center;
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

        /* ===== BADGE STATUS ===== */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            /* lebih kecil */
            font-size: 9px;
            /* ukuran XS */
            font-weight: bold;
            color: #fff;
            border-radius: 12px;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #28a745;
            /* hijau */
        }

        .badge-danger {
            background-color: #dc3545;
            /* merah */
        }

        .badge-secondary {
            background-color: #6c757d;
            /* abu */
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
        }

        .footer img {
            width: 60%;
            max-height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <!-- <img src="{{ public_path('frontpage/img/logo.png') }}" class="watermark"> -->


    <div class="content">
        <div class="title">Bukti Permohonan Informasi - Lembaga</div>
        @php
            $sudahDirespon = in_array($data->status, ['diterima', 'ditolak']);
        @endphp
        <table>
            <tr>
                <td class="label">Request ID:</td>
                <td>{{ $data->unik_request }}</td>
            </tr>
            @if ($sudahDirespon)
                <tr>
                    <td class="label">Status Permohonan:</td>
                    <td>
                        @php
                            $statusClass = 'badge-secondary';

                            if ($data->status === 'diterima') {
                                $statusClass = 'badge-success';
                            } elseif ($data->status === 'ditolak') {
                                $statusClass = 'badge-danger';
                            }
                        @endphp

                        <span class="badge {{ $statusClass }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </td>
                </tr>
            @endif
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
            @if ($sudahDirespon)
                <tr>
                    <td class="label">Tanggal Pengajuan:</td>
                    <td>{{ tgl_indo($data->tgl_pengajuan) }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Direspon:</td>
                    <td>{{ tgl_indo($data->tgl_direspon) }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu Respon:</td>
                    <td>{{ $data->waktu_menjawab }} Hari</td>
                </tr>
            @endif
        </table>

        <hr>
        <div class="label">Informasi Dibutuhkan:</div>
        <p>{{ $data->info_dibutuhkan }}</p>

        <div class="label">Alasan Butuh:</div>
        <p>{{ $data->alasan_butuh }}</p>

        @if ($sudahDirespon)
            <hr>
            <div class="label">Respon PPID:</div>
            <p>{{ isset($data->respon) && trim($data->respon) !== '' ? $data->respon : '-' }}</p>
        @endif
    </div>

    <div class="footer">
        <img src="{{ public_path('polije-admin/img/footer-removebg.png') }}" alt="Footer">
    </div>
</body>

</html>