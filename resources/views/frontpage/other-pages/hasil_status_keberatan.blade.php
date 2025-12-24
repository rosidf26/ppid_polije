<!DOCTYPE html>
<html>

<head>
    @include('frontpage.templates.head')
</head>

<body>
    <div class="body">

        @include('frontpage.templates.header')

        <div role="main" class="main">

            @include('frontpage.sections.page_title')

            <div class="container py-4">

                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    Status Pernyataan Keberatan
                                </h5>
                            </div>

                            <div class="card-body">

                                <!-- Nomor & Status -->
                                <div class="mb-3">
                                    <strong>Nomor Permohonan Keberatan</strong>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="mr-2">{{ $data->unik_request }}</span>

                                        @php
                                            $class = 'badge badge-secondary badge-xs';

                                            if ($data->status === 'diterima') {
                                                $class = 'badge badge-success badge-xs';
                                            } elseif ($data->status === 'ditolak') {
                                                $class = 'badge badge-danger badge-xs';
                                            }
                                        @endphp

                                        <span class="{{ $class }}">
                                            {{ ucfirst($data->status ?? 'Belum Direspon') }}
                                        </span>
                                    </div>
                                </div>



                                @if ($data->sudahDirespon())
                                    <hr>
                                    <table class="table table-sm table-bordered table-striped mb-0">
                                        <tr>
                                            <th width="40%">Tanggal Pengajuan</th>
                                            <td>{{ tgl_indo($data->tgl_pengajuan) }}</td>
                                        </tr>

                                        <tr>
                                            <th>Tanggal Direspon</th>
                                            <td>{{ tgl_indo($data->tgl_direspon) }}</td>
                                        </tr>

                                        <tr>
                                            <th>Waktu Respon</th>
                                            <td>{{ $data->waktu_menjawab }} Hari</td>
                                        </tr>

                                        <tr>
                                            <th>Respon PPID</th>
                                            <td>{{ $data->respon }}</td>
                                        </tr>
                                    </table>

                                @endif

                            </div>

                            <div class="card-footer text-center bg-white">
                                <a href="{{ route('keberatan.check') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fa fa-search"></i>
                                    Cek Permohonan Lain
                                </a>
                            </div>
                        </div>

                        {{-- ============================= --}}
                        {{-- RIWAYAT PERMOHONAN INFORMASI --}}
                        {{-- ============================= --}}
                        @if($data->permohonan)
                            <div class="card shadow-sm mt-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        Riwayat Permohonan Informasi
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <table class="table table-sm table-bordered table-striped mb-0">
                                        <tr>
                                            <th width="35%">Nomor Permohonan</th>
                                            <td>{{ $data->permohonan->unik_request }}</td>
                                        </tr>

                                        <tr>
                                            <th>Kategori Pemohon</th>
                                            <td>{{ ucfirst($data->permohonan->kategori) }}</td>
                                        </tr>

                                        <tr>
                                            <th>Nama Pemohon</th>
                                            <td>{{ $data->permohonan->nama_display }}</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $data->permohonan->email_display }}</td>
                                        </tr>

                                        <tr>
                                            <th>Tanggal Pengajuan</th>
                                            <td>{{ tgl_indo($data->permohonan->tgl_pengajuan) }}</td>
                                        </tr>

                                        <tr>
                                            <th>Status Permohonan</th>
                                            <td>
                                                {!! $data->permohonan->getStatusBadge() !!}
                                            </td>
                                        </tr>
                                    </table>

                                    <hr>

                                    <div class="mb-2">
                                        <strong>Informasi yang Dimohonkan</strong>
                                        <p class="mb-0">
                                            {{ $data->permohonan->info_dibutuhkan }}
                                        </p>
                                    </div>

                                    <div>
                                        <strong>Alasan Permohonan</strong>
                                        <p class="mb-0">
                                            {{ $data->permohonan->alasan_butuh }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('frontpage.templates.footer')
    @include('frontpage.templates.js')

</body>

</html>