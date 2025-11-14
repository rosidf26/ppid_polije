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
{!! $page->content !!}
                                   @php
    // Ambil data options dari Collection
    $options = $page_extra->get('options');

    // Decode jika masih JSON string
    if (is_string($options)) {
        $options = json_decode($options, true);
    }
@endphp
@if (!empty($page_extra->get('featured_image')))
    <img src="{{ url($page_extra->get('featured_image')) }}" alt="Featured Image" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0">
@endif
@if(!empty($options) && is_array($options))
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
                                                 @foreach($options as $row)
                                                <tr>
                                                       <td>{{ $row['no'] ?? '' }}</td>
                                                          <td>{{ $row['name'] ?? '' }}</td>
                                                             <td>{{ $row['pangkat'] ?? '' }}</td>
                                                                <td>{{ $row['status'] ?? '' }}</td>
                                                </tr>
                                                  @endforeach
                                            </tbody>
                                        </table>
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