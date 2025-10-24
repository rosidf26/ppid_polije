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
                                    <a href="#">
                                        <img
                                            src="{{ url('frontpage/img/blog/wide/blog-11.jpg') }}"
                                            class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="post-content ml-0">
                                    <div class="pdf-container">
                                        <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
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