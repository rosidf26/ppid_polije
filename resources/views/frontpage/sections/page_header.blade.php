 @php
 $segments = Request::segments();
 $url = '';
 @endphp
 <section class="page-header page-header-modern bg-color-primary page-header-sm">
     <div class="container">
         <div class="row">

             <div class="col-md-12 align-self-center p-static order-2 text-center">

                 <h1 class="text-light font-weight-bold text-8">{{ get_page_title() }}</h1>
             </div>

             <div class="col-md-12 align-self-center order-1">

                 <ul class="breadcrumb d-block text-center breadcrumb-light">
                    <li><a href="{{ url('/') }}">Beranda</a></li>

                    {{-- JIKA URL = kategori/... --}}
                    @if (count($segments) >= 2 && $segments[0] === 'kategori')
                        <li>
                            {{ ucfirst(str_replace('-', ' ', $segments[0])) }}
                        </li>
                        <li class="active">
                            {{ ucfirst(str_replace('-', ' ', $segments[1])) }}
                        </li>

                    {{-- JIKA URL = berita/slug-artikel  --}}
                    @elseif (count($segments) >= 2 && $segments[0] === 'berita')
                        <li class="active">
                            {{ ucfirst($segments[0]) }}
                        </li>

                    {{-- JIKA URL = pengumuman/slug-artikel --}}
                    @elseif (count($segments) >= 2 && $segments[0] === 'pengumuman')
                        <li class="active">
                            {{ ucfirst($segments[0]) }}
                        </li>

                    {{-- JIKA URL hanya 1 segment --}}
                    @else
                        @foreach ($segments as $segment)
                            <li class="active">
                                {{ ucfirst(str_replace('-', ' ', $segment)) }}
                            </li>
                        @endforeach
                    @endif
                </ul>
             </div>
         </div>
     </div>
 </section>