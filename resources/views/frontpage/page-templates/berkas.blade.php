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
            // Ambil semua key yang bentuknya label_x
            $labels = $page_extra->filter(function ($value, $key) {
                return Str::startsWith($key, 'label_');
            });

            // Susun item yang valid (label dan file harus TIDAK null)
            $items = [];

            foreach ($labels as $key => $label) {
                preg_match('/label_(\d+)/', $key, $match);
                $index = $match[1] ?? null;

                if ($index) {
                    $file = $page_extra->get("berkas_$index");

                    // Hanya tambahkan jika label TIDAK null & file TIDAK null
                    if (!empty($label) && !empty($file)) {
                        $items[] = [
                            'tahun' => $label,
                            'file'  => $file
                        ];
                    }
                }
            }
        @endphp


        {{-- =======================================================
             CASE 1: HANYA ADA 1 ITEM VALID  → TAMPILKAN IFRAME
        ======================================================= --}}
        @if (count($items) === 1)
            <div class="pdf-container">
                <iframe src="{{ url($items[0]['file']) }}" width="100%" height="500px"></iframe>
            </div>


        {{-- =======================================================
             CASE 2: ADA >1 ITEM VALID → TAMPILKAN ACCORDION
        ======================================================= --}}
        @else
            <div class="accordion" id="accordion">

                @foreach ($items as $i => $item)
                    @php
                        $collapseId = 'collapseYear' . $i;
                        $showClass = $i === 0 ? 'show' : '';
                    @endphp

                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title m-0">
                                <a class="accordion-toggle"
                                   data-toggle="collapse"
                                   data-parent="#accordion"
                                   href="#{{ $collapseId }}">
                                    {{ $item['tahun'] }}
                                </a>
                            </h4>
                        </div>

                        <div id="{{ $collapseId }}" class="collapse {{ $showClass }}">
                            <div class="card-body">
                                <div class="pdf-container">
                                    <iframe src="{{ url($item['file']) }}" width="100%" height="500px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

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