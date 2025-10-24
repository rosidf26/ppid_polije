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

                                    <h4 class="mb-3">Tugas Pokok PPID</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum</p>
                                    <h4 class="mb-3">Fungsi PPID</h4>

                                    <ul>
                                        <li>Lorem ipsum dolor sit amet</li>
                                        <li>Consectetur adipiscing elit</li>
                                        <li>Integer molestie lorem at massa</li>
                                        <li>Facilisis in pretium nisl aliquet</li>
                                        <li>
                                            Nulla volutpat aliquam velit
                                            <ul>
                                                <li>Phasellus iaculis neque</li>
                                                <li>Purus sodales ultricies</li>
                                                <li>Vestibulum laoreet porttitor sem</li>
                                                <li>Ac tristique libero volutpat at</li>
                                            </ul>
                                        </li>
                                        <li>Faucibus porta lacus fringilla vel</li>
                                        <li>Aenean sit amet erat nunc</li>
                                        <li>Eget porttitor lorem</li>
                                    </ul>

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