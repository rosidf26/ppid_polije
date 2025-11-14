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
@if(!empty($options) && is_array($options))
                                    <div class="table-responsive">
                                    
                                        <table class="table table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Keterangan
                                                    </th>
                                                    <th>
                                                        Link
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                  @foreach($options as $row)
                                                <tr>
                                                    
                                                <td>{{ $row['no'] ?? '' }}</td>
                                                <td>{{ $row['desc'] ?? '' }}</td>
                                                <td>
                                                    @if(!empty($row['link']))
                                                    <a href="{{ $row['link'] }}" class="btn btn-outline btn-success btn-xs" target="_blank">
                                                        Lihat <span><i class="fas fa-chevron-right"></i></span>
                                                    </a>
                                                    @else
                                                    <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                
                                        <hr class="solid my-2">
                                    </div>

                                    @else
    <div class="alert alert-danger">
        Belum ada data tersedia.
    </div>
@endif
                                </div>
                            </article>
                        </div>


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