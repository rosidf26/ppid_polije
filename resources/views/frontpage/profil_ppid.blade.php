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

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum nec mauris. Duis molestie, purus eget placerat viverra, nisi odio gravida sapien, congue tincidunt nisl ante nec tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis, massa fringilla consequat blandit, mauris ligula porta nisi, non tristique enim sapien vel nisl. Suspendisse vestibulum lobortis dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent nec tempus nibh. Donec mollis commodo metus et fringilla. Etiam venenatis, diam id adipiscing convallis, nisi eros lobortis tellus, feugiat adipiscing ante ante sit amet dolor. Vestibulum vehicula scelerisque facilisis. Sed faucibus placerat bibendum. Maecenas sollicitudin commodo justo, quis hendrerit leo consequat ac. Proin sit amet risus sapien, eget interdum dui. Proin justo sapien, varius sit amet hendrerit id, egestas quis mauris.</p>
                                    <p>Ut ac elit non mi pharetra dictum nec quis nibh. Pellentesque ut fringilla elit. Aliquam non ipsum id leo eleifend sagittis id a lorem. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam massa mauris, viverra et rhoncus a, feugiat ut sem. Quisque ultricies diam tempus quam molestie vitae sodales dolor sagittis. Praesent commodo sodales purus. Maecenas scelerisque ligula vitae leo adipiscing a facilisis nisl ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                                    <h4 class="mb-3">VISI</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum</p>
                                    <h4 class="mb-3">MISI</h4>

                                    <ol class="list list-ordened list-ordened-style-2">
                                        <li>Lorem ipsum</li>
                                        <li>Consectetur adipi</li>
                                        <li>Integer molestie</li>
                                        <li>Facilisis in pre</li>
                                        <li>Faucibus porta la</li>
                                    </ol>
                                    <br>
                                    <h4 class="mb-3">STRUKTUR ORGANISASI</h4>
                                    <img src="{{ url('frontpage/img/blog/wide/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                    <div class="table-responsive">
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Pangkat / Jabatan
                                                    </th>
                                                    <th>
                                                        Diangkat Dalam Jabatan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        Thomas Alfa <br> NIP. 196901071994031001
                                                    </td>
                                                    <td>
                                                        Penata Tingkat I (III/d) <br> Direktur

                                                    </td>
                                                    <td>
                                                        Atasan PPID
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>
                                                        Jacob Bryan <br> NIP. 196901071994031001
                                                    </td>
                                                    <td>
                                                        Pembina (IV/a) <br> Wakil Direktur Bidang Umum dan Keuangan
                                                    </td>
                                                    <td>
                                                        Ketua PPID
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>
                                                        Larry Hug <br> NIP. 197812102003121002
                                                    </td>
                                                    <td>
                                                        Pembina (IV/a) <br> Wakil Direktur Bidang Akademik
                                                    </td>
                                                    <td>
                                                        Tim Pertimbangan
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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