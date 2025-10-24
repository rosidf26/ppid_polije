<!DOCTYPE html>
<html>

<head>

    <!-- ini head -->
    @include('frontpage.templates.head')

</head>

<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <div class="body">
        <!-- ini header -->
        @include('frontpage.templates.header')

        <div role="main" class="main">

            <!-- ini slideshow -->
            @include('frontpage.sections.slideshow')

            <!-- ini card dan tautan terkait -->
            @include('frontpage.sections.card')

            <!-- ini statistik  -->
            @include('frontpage.sections.statistik')

            <!-- ini berita & pengumuman -->
            @include('frontpage.sections.berita')

            <!-- ini komentar -->
            @include('frontpage.sections.komentar')

        </div>

        <!-- ini footer -->
        @include('frontpage.templates.footer')

    </div>

    <!-- ini js -->
    @include('frontpage.templates.js')

</body>

</html>