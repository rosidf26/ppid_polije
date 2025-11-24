
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
            <div class="col-lg-3">
                <aside class="sidebar">
                  <form action="{{ route('search_announce') }}" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Cari pengumuman..." name="p" id="p" type="text">
										<span class="input-group-append">
											<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>
                <h5 class="font-weight-bold pt-4">Tags</h5>
								@if(isset($all_tags) && $all_tags->count() > 0)
								<ul class="nav nav-list flex-column mb-5">
									 @foreach ($all_tags as $tg)
									<li class="nav-item"><a class="nav-link {{ request()->segment(3) == $tg->slug ? 'active' : '' }}" href="{{ route('tag.filter_announce', $tg->slug) }}"> {{ $tg->name }} ({{ $tg->announce_count }})</a></li>
									@endforeach
								</ul>
								@endif								
							  </aside>
            </div>
            <div class="col-lg-9">
              <div class="blog-posts single-post">
                <article class="post post-large blog-single-post border-0 m-0 p-0">
                  <div class="post-date ml-0 detail">
                    <span class="day text-dark">{{ \Carbon\Carbon::parse($article->date)->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($article->date)->format('M') }}</span>
                     <span class="year">{{ \Carbon\Carbon::parse($article->date)->format('Y') }}</span>
                  </div>

                  <div class="post-content ml-0">
                    <h2 class="font-weight-bold">
                      <a class="text-primary">{{ $article->title }}</a>
                    </h2>

                    <div class="post-meta">
                      <span
                        ><i class="far fa-user"></i> By <a>Admin</a>
                      </span>
                       <span><i class="far fa-folder"></i>
                          @foreach($pengumuman_tag->tags as $value)
                        <a>{{ $value->name }}</a>{{ !$loop->last ? ',' : '' }}
                          @endforeach
                      </span>
                    </div>

                     {!! $article->content !!}
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
