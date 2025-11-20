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

    {{-- Tampilkan gambar hanya jika featured_image tidak null --}}
    @if ($page_extra->get('featured_image'))
        <div class="post-image ml-0">
            <a href="#">
                <img
                    src="{{ url($page_extra->get('featured_image')) }}"
                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                    alt="Featured Image" />
            </a>
        </div>
    @endif

    <div class="post-content ml-0">

        {{-- Tampilkan PDF hanya jika berkas tidak null --}}
        @if ($page_extra->get('berkas'))
            <div class="pdf-container mt-3">
                <iframe 
                    src="{{ url($page_extra->get('berkas')) }}" 
                    width="100%" 
                    height="500px">
                </iframe>
            </div>
        @endif

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