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
            @include('frontpage.sections.page_header')

            <div class="container py-4">


                <div class="row">
                    <div class="col">
                        <h2 class="gradient-text-color font-weight-bold m-0 text-center">Layanan Informasi Publik di Politeknik Negeri Jember tidak dipungut biaya, kecuali untuk informasi yang telah ditentukan biayanya sesuai dengan peraturan mengenai penerimaan negara bukan pajak (PNBP). Biaya yang timbul dari permohonan informasi publik ditanggung oleh pemohon.</h2>
                    </div>
                </div>

<br>
                <div class="row">
                    
                    <div class="col-lg-12">
                        <p class="drop-caps drop-caps-style-2 lead">Kebijakan terkait biaya layanan informasi publik di atur dalam Keputusan Direktur Politeknik Negeri Jember Nomor xxxx tentang Standar Pelayanan Permohonan Informasi Publik.</p>
                        <p class="text-right"><strong>Pejabat Pengelola Informasi dan Dokumentasi</strong></p>
                    </div>
                </div>

            </div>

        </div>

        <!-- ini footer -->
        @include('frontpage.templates.footer')
    </div>

    <!-- ini js -->
    @include('frontpage.templates.js')

</body>

</html>