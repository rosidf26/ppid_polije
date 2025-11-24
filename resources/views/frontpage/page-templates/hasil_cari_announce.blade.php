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
              <h2 class="font-weight-normal text-7 mb-0">Menampilkan pencarian dari kata kunci <strong class="font-weight-extra-bold">{{ $request->get('p') }}</strong>
              </h2>
              <p class="lead mb-0">{{ $article->total() }} hasil ditemukan.</p>
            </div>
          </div>
          <div class="row">
            <div class="col pt-2 mt-1">
              <hr class="my-4">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <ul class="simple-post-list m-0"> @foreach($article as $index => $value) <li>
                  <div class="post-info">
                    <a href="{{ url( $value->category->slug . '/' . $value->slug) }}">{{ $value->title }}</a>
                    <div class="post-meta">
                      <span class="text-dark text-uppercase font-weight-semibold">{{ tgl_indo($value->date) }}</span> | Tags : @foreach($value->tags as $tag) <a>{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }} @endforeach
                    </div>
                  </div>
                </li> @endforeach </ul>
              <div class="float-right">
                {{ $article->links() }}
              </div>
            </div>
          </div>
        </div>
         <section class="call-to-action call-to-action-default content-align-center call-to-action-in-footer call-to-action-in-footer-margin-top">
          <div class="container">
            <div class="row">
              <div class="col">
                <form action="{{ route('search_announce') }}" method="get">
                  <div class="input-group input-group-lg">
                    <input class="form-control" placeholder="Cari pengumuman..." name="p" value="{{ $request->get('p') }}" id="p" type="text">
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                      </button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- ini footer --> @include('frontpage.templates.footer')
    </div>
    <!-- ini js --> @include('frontpage.templates.js')
  </body>
</html>