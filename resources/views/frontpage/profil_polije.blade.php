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

                                <div class="post-image ml-0">
                                    <div class="owl-carousel owl-theme show-nav-hover dots-inside nav-inside nav-style-1 nav-light" data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': true, 'dots': true}">
                                        <div>
                                            <div class="img-thumbnail border-0 p-0 d-block">
                                                <img class="img-fluid border-radius-0" src="{{ url('frontpage/img/blog/wide/blog-24.jpg') }}" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="img-thumbnail border-0 p-0 d-block">
                                                <img class="img-fluid border-radius-0" src="{{ url('frontpage/img/blog/wide/blog-20.jpg') }}" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="img-thumbnail border-0 p-0 d-block">
                                                <img class="img-fluid border-radius-0" src="{{ url('frontpage/img/blog/wide/blog-21.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="post-content ml-0">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum nec mauris. Duis molestie, purus eget placerat viverra, nisi odio gravida sapien, congue tincidunt nisl ante nec tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis, massa fringilla consequat blandit, mauris ligula porta nisi, non tristique enim sapien vel nisl. Suspendisse vestibulum lobortis dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent nec tempus nibh. Donec mollis commodo metus et fringilla. Etiam venenatis, diam id adipiscing convallis, nisi eros lobortis tellus, feugiat adipiscing ante ante sit amet dolor. Vestibulum vehicula scelerisque facilisis. Sed faucibus placerat bibendum. Maecenas sollicitudin commodo justo, quis hendrerit leo consequat ac. Proin sit amet risus sapien, eget interdum dui. Proin justo sapien, varius sit amet hendrerit id, egestas quis mauris.</p>
                                    <p>Ut ac elit non mi pharetra dictum nec quis nibh. Pellentesque ut fringilla elit. Aliquam non ipsum id leo eleifend sagittis id a lorem. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam massa mauris, viverra et rhoncus a, feugiat ut sem. Quisque ultricies diam tempus quam molestie vitae sodales dolor sagittis. Praesent commodo sodales purus. Maecenas scelerisque ligula vitae leo adipiscing a facilisis nisl ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                                    <h4 class="mb-3">VISI 2025 - 2029</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum</p>
                                    <h4 class="mb-3">MISI</h4>

                                    <ol class="list list-ordened list-ordened-style-2">
                                        <li>Lorem ipsum</li>
                                        <li>Consectetur adipi</li>
                                        <li>Integer molestie</li>
                                        <li>Facilisis in pre</li>
                                        <li>Faucibus porta la</li>
                                    </ol>

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