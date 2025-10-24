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
                        <div class="blog-posts single-post">

                            <article class="post post-large blog-single-post border-0 m-0 p-0">
                                <div class="post-content ml-0">


                                    <div class="accordion" id="accordion">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                                                        Dasar Hukum Keterbukaan Informasi Publik
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1One" class="collapse show">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Judul
                                                                    </th>
                                                                    <th>
                                                                        Sinopsis
                                                                    </th>
                                                                    <th>
                                                                        Dokumen
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        1
                                                                    </td>
                                                                    <td>
                                                                        Undang-Undang Republik Indonesia Nomor 14 Tahun 2008
                                                                    </td>
                                                                    <td>
                                                                        Tentang Keterbukaan Informasi Publik

                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-outline btn-success btn-xs" href="#" target="_blank">Lihat<span><i class="fas fa-chevron-right"></i></span></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        2
                                                                    </td>
                                                                    <td>
                                                                        Undang-Undang Republik Indonesia Nomor 25 Tahun 2009
                                                                    </td>
                                                                    <td>
                                                                        Pelayanan Publik
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-outline btn-success btn-xs" href="#" target="_blank">Lihat<span><i class="fas fa-chevron-right"></i></span></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        3
                                                                    </td>
                                                                    <td>
                                                                        Undang-Undang Republik Indonesia Nomor 43 Tahun 2009
                                                                    </td>
                                                                    <td>
                                                                        Kearsipan
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-outline btn-success btn-xs" href="#" target="_blank">Lihat<span><i class="fas fa-chevron-right"></i></span></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                                        Dasar Hukum Layanan Informasi Publik di Lingkungan Politeknik Negeri Jember
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Two" class="collapse">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Judul
                                                                    </th>
                                                                    <th>
                                                                        Sinopsis
                                                                    </th>
                                                                    <th>
                                                                        Dokumen
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                                        Standard Operating Procedure (SOP) PPID Politeknik Negeri Jember
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Three" class="collapse">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped mt-3">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Judul
                                                                    </th>
                                                                    <th>
                                                                        Sinopsis
                                                                    </th>
                                                                    <th>
                                                                        Dokumen
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </article>

                        </div>
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