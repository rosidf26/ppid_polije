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
                                                        2021
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1One" class="collapse show">
                                                <div class="card-body">
                                                   <div class="pdf-container">
                                                    <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                                        2022
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Two" class="collapse">
                                                <div class="card-body">
                                             <div class="pdf-container">
                                                    <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                                        2023
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Three" class="collapse">
                                                <div class="card-body">
                                                 <div class="pdf-container">
                                                    <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                                        2024
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Three" class="collapse">
                                                <div class="card-body">
                                                 <div class="pdf-container">
                                                    <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title m-0">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                                        2025
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse1Three" class="collapse">
                                                <div class="card-body">
                                                 <div class="pdf-container">
                                                    <iframe src="{{ url('frontpage/kalender_akademik.pdf') }}" width="100%" height="500px"></iframe>
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