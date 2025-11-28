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
                                    @php
                                    // Filter hanya yang berupa string dan mengandung pola path gambar
                                    $images = $page_extra->filter(function ($item, $key) {
                                        return is_string($item)
                                            && !empty($item)
                                            && str_starts_with($item, 'uploads'); // atau pola lain sesuai kebutuhanmu
                                    });
                                @endphp

                                @if ($images->count() === 1)
                                    {{-- Hanya satu gambar --}}
                                    <img class="img-fluid border-radius-0" src="{{ url($images->first()) }}" alt="">
                                @elseif ($images->count() > 1)
                                    {{-- Lebih dari satu gambar → Carousel --}}
                                    <div class="owl-carousel owl-theme show-nav-hover dots-inside nav-inside nav-style-1 nav-light"
                                        data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': true, 'dots': true}">
                                        
                                        @foreach ($images as $path)
                                            <div>
                                                <div class="img-thumbnail border-0 p-0 d-block">
                                                    <img class="img-fluid border-radius-0" src="{{ url($path) }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @endif

                                </div>

                                <div class="post-content ml-0">

                                    {!! $page->content !!}

                                </div>

                                @php
                                    $youtube_id = extractYoutubeId($page_extra->get('id_youtube'));
                                @endphp

                                @if ($youtube_id)
                                <div class="post-image ml-0">
                                    <div class="embed-responsive embed-responsive-16by9">
                                    <iframe 
    src="https://www.youtube-nocookie.com/embed/{{ $youtube_id }}?autoplay=1&mute=1"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    allowfullscreen
    frameborder="0">
</iframe>
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