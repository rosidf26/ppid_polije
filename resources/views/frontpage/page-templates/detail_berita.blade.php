
<!DOCTYPE html>
<html>
  <head>
    <!-- ini head -->
    @include('frontpage.templates.head')
    <style>
      .post-image {
          display: flex;
          justify-content: center;
          align-items: center;
          overflow: hidden;
      }

      .post-image img {
          max-width: 100%;
          height: auto;
          object-fit: contain;
      }
    </style>
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
                  <form action="{{ route('search_news') }}" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Cari berita..." name="q" id="q" type="text">
										<span class="input-group-append">
											<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>
                <h5 class="font-weight-bold pt-4">Tags</h5>
								@if(isset($all_tags) && $all_tags->count() > 0)
								<ul class="nav nav-list flex-column mb-5">
									 @foreach ($all_tags as $tg)
									<li class="nav-item"><a class="nav-link {{ request()->segment(3) == $tg->slug ? 'active' : '' }}" href="{{ route('tag.filter', $tg->slug) }}"> {{ $tg->name }} ({{ $tg->articles_count }})</a></li>
									@endforeach
								</ul>
								@endif
								<!-- <h5 class="font-weight-bold pt-4">Kategori Publikasi</h5>
								<ul class="nav nav-list flex-column mb-5">
                    @foreach($categories as $index => $value)
                                            {!! $value !!}
                                            @endforeach
								</ul> -->
                <!-- <div class="tabs tabs-dark mb-4 pb-2">
									<ul class="nav nav-tabs">
										<li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#" data-toggle="tab">Berita Lainnya</a></li>
									</ul>
                  <div class="tab-content">
										<div class="tab-pane active">
											<ul class="simple-post-list">
                         @foreach($news as $index => $value)
												<li>
													<div class="post-image">
														<div class="img-thumbnail img-thumbnail-no-borders d-block">
															<a href="{{ url($value->category->slug . '/' . $value->slug) }}">
																<img src="{{ ($value->image) ? url($value->image) : url('frontpage/img/blog/square/blog-11.jpg') }}" width="50" height="50" alt="">
															</a>
														</div>
													</div>
													<div class="post-info">
														<a href="{{ url($value->category->slug . '/' . $value->slug) }}">{{ \Illuminate\Support\Str::limit($value->title, 20) }}</a>
														<div class="post-meta">
															 {{ tgl_indo($value->date) }}
														</div>
													</div>
												</li>
                        @endforeach
											</ul>
										</div>
                </div> -->
								
							  </aside>
            </div>
            <div class="col-lg-9">
              <div class="blog-posts single-post">
                <article class="post post-large blog-single-post border-0 m-0 p-0">
                  <div class="post-image ml-0">
                    <a href="#">
                      <img src="{{ $article->image ? url($article->image) : url('frontpage/img/blog/wide/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt=""/>
                    </a>
                  </div>

                  <div class="post-date ml-0 detail">
                    <span class="day text-dark">{{ \Carbon\Carbon::parse($article->date)->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($article->date)->format('M') }}</span>
                     <span class="year">{{ \Carbon\Carbon::parse($article->date)->format('Y') }}</span>
                  </div>

                  <div class="post-content ml-0">
                    <h2 class="font-weight-bold">
                      <a href="#">{{ $article->title }}</a>
                    </h2>

                    <div class="post-meta">
                      <span
                        ><i class="far fa-user"></i> By <a>Admin</a>
                      </span>
                      <span><i class="far fa-folder"></i>
                          @foreach($article_tag->tags as $value)
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
