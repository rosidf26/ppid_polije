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
                                    @foreach ($page_extra as $key => $path)
                                     @continue(!is_string($path))
                                    <div>
                                            <div class="img-thumbnail border-0 p-0 d-block">
                                                <img class="img-fluid border-radius-0" src="{{ url($path) }}" alt="">
                                            </div>
                                        </div>
                                         @endforeach
                                    </div>
                                </div>

                                <div class="post-content ml-0">

                                    {!! $page->content !!}

                                </div>

                                @if (!empty($page_extra->get('id_youtube')))
                                <div class="post-image ml-0">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe src="https://www.youtube.com/embed/{{ $page_extra->get('id_youtube') }}?autoplay=1&mute=1"></iframe>
                                    </div>
                                </div>
@endif
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