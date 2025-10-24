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

                                    <h4 class="mb-3">Informasi Publik yang Wajib Disediakan dan Diumumkan Secara Berkala</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Nama Informasi Berkala
                                                    </th>
                                                    <th>
                                                        Link
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        Informasi Profil Politeknik Negeri Jember
                                                    </td>
                                                    <td>


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        a. Profil Singkat Polije
                                                    </td>
                                                    <td>

                                                        <a class="btn btn-outline btn-success btn-xs" href="#" target="_blank">Lihat<span><i class="fas fa-chevron-right"></i></span></a>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        b. Alamat Polije
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
                                                        Ringkasan Informasi tentang program dan/atau kegiatan Polije
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-outline btn-success btn-xs" href="#" target="_blank">Lihat<span><i class="fas fa-chevron-right"></i></span></a>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr class="solid my-2">
                                    </div>
                                </div>
                            </article>
                        </div>


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