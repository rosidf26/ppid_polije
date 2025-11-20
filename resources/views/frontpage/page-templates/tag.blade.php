<!DOCTYPE html>
<html>
<head>
    @include('frontpage.templates.head')
</head>
<body>

<div class="body">

    {{-- Header --}}
    @include('frontpage.templates.header')

    <div role="main" class="main">

        {{-- Page Header --}}
        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="breadcrumb d-block text-center breadcrumb-light">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Tag: {{ $tag->name }}</li>
                        </ul>
                        <h1 class="text-center font-weight-bold text-8">Tag: {{ $tag->name }}</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-4">

            <div class="row">

                {{-- SIDEBAR --}}
                <div class="col-lg-3">
                    <aside class="sidebar">

                        {{-- SEARCH --}}
                        <form action="#" method="get">
                            <div class="input-group mb-3 pb-1">
                                <input class="form-control text-1" placeholder="Cari artikel..." name="s" id="s" type="text">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-dark text-1 p-2">
                                        <i class="fas fa-search m-2"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        {{-- TAG LIST --}}
                        @if(isset($all_tags))
                        <h5 class="font-weight-bold pt-4">Tags</h5>
                        <ul class="nav nav-list flex-column mb-5">
                            @foreach($all_tags as $t)
                                <li class="nav-item">
                                    <a class="nav-link {{ $tag->slug == $t['slug'] ? 'active font-weight-bold' : '' }}"
                                       href="{{ url('tag/' . $t['slug']) }}">
                                        {{ $t['name'] }} ({{ $t['count'] }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @endif

                    </aside>
                </div>

                {{-- MAIN CONTENT --}}
                <div class="col-lg-9">
                    <div class="blog-posts">

                        @foreach ($articles as $item)
                            <article class="post post-medium">

                                <div class="row mb-3">
                                    <div class="col-lg-5">
                                        <div class="post-image">
                                            <a href="{{ url($item->category->slug . '/' . $item->slug) }}">
                                                <img src="{{ $item->image ? url($item->image) : url('frontpage/img/blog/medium/blog-11.jpg') }}"
                                                     class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" />
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-7">
                                        <div class="post-content">
                                            <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
                                                <a href="{{ url($item->category->slug . '/' . $item->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($item->title, 60) }}
                                                </a>
                                            </h2>

                                            <p class="mb-0">
                                                {{ Str::limit(strip_tags($item->content), 280) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="post-meta">

                                            <span><i class="far fa-calendar-alt"></i> {{ tgl_indo($item->date) }}</span>
                                            <span><i class="far fa-user"></i> Admin</span>

                                            <span><i class="fas fa-tag"></i>
                                                @foreach($item->tags as $t)
                                                    <a href="{{ url('tag/' . $t->slug) }}">{{ $t->name }}</a>{{ !$loop->last ? ',' : '' }}
                                                @endforeach
                                            </span>

                                            <span class="float-right mt-3 mt-sm-0">
                                                <a href="{{ url($item->category->slug . '/' . $item->slug) }}"
                                                   class="btn btn-xs btn-light text-1 text-uppercase">
                                                    Baca Selengkapnya
                                                </a>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </article>
                        @endforeach

                        {{-- PAGINATION --}}
                        <div class="mt-4">
                            {{ $articles->links() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- Footer --}}
    @include('frontpage.templates.footer')

</div>

{{-- JS --}}
@include('frontpage.templates.js')

</body>
</html>
