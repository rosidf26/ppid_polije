<!DOCTYPE html>
<html>

<head>
    <!-- ini head -->
    @include('frontpage.templates.head')
</head>

<body>

    <div class="body">
        <!-- ini header -->
        @include('frontpage.templates.header')

        <div role="main" class="main">

            <!-- ini header -->
            @include('frontpage.sections.page_title')

            <div class="container py-4">

                <div class="row">
                    <div class="col">
                        <div class="alert alert-success">
                            <h4 class="mb-2">✅ Pernyataan Keberatan Berhasil Dikirim</h4>
                            <p class="mb-0">
                                Nomor Permohonan Anda:
                                <strong>{{ $data->unik_request }}.</strong> Mohon disimpan sebagai bukti dan
                                untuk
                                pengecekan status.
                            </p>
                        </div>

                        <div class="card shadow-sm p-4">
                            <p>
                                Estimasi waktu respons:
                                <strong>3–5 hari kerja</strong>
                            </p>

                            <a href="{{ route('keberatan.download', $data->unik_request) }}"
                                class="btn btn-primary btn-lg mt-1">
                                <i class="la la-download"></i>
                                Download Bukti Keberatan (PDF)
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- ini footer -->
    @include('frontpage.templates.footer')

    <!-- ini js -->
    @include('frontpage.templates.js')
</body>

</html>