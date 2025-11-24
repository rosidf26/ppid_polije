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
										<input class="form-control text-1" placeholder="Cari pengumuman..." name="p" id="p">
										<span class="input-group-append">
											<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>
								<h5 class="font-weight-bold pt-4">Tags</h5>
                                  @if(isset($all_tags))
								<ul class="nav nav-list flex-column mb-5">
								 @foreach ($all_tags as $tg)
									<li class="nav-item"><a class="nav-link {{ isset($tag) && $tag->slug == $tg->slug ? 'active' : '' }}" href="{{ route('tag.filter_announce', $tg->slug) }}">  {{ $tg->name }} ({{ $tg->announce_count }}) </a></li>
									@endforeach
								</ul>
                                 @endif
								
							</aside>
						</div>
						<div class="col-lg-9">
              <!-- <h4>Klik Panah Untuk Menggeser</h4> -->
              <div class="owl-carousel owl-theme show-nav-title top-border mb-0" data-plugin-options="{
		'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}},
		'items': 3,
		'margin': 10,
		'loop': false,
		'nav': true,
		'dots': false
	}"> @foreach($articles as $index => $value) <div>
                  <div class="recent-posts post-equal">
                    <article class="post h-100 d-flex flex-column">
                      <div class="row flex-grow-1">
                        <div class="col-auto pr-0">
                          <div class="post-date detail">
                            <span class="day text-color-dark font-weight-extra-bold">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('d') }}</span>
                            <span class="month">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('M') }}</span>
                            <span class="year">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('Y') }}</span>
                          </div>
                        </div>
                        <div class="col pl-1 d-flex flex-column h-100">
                          <h4 class="line-height-3">
                            <a href="{{ url($value->category->slug . '/' . $value->slug) }}" class="text-decoration-none">
                              {{ Str::limit($value->title, 30) }}
                            </a>
                          </h4>
                          <p class="mb-1 flex-grow-1 text-clamp">
                            {{ strip_tags($value->content) }}
                          </p>
                          <div class="mt-auto">
                            <a href="{{ url($value->category->slug . '/' . $value->slug) }}" class="btn btn-xs btn-light text-1 text-uppercase">
                              <strong>Baca Selengkapnya</strong>
                            </a>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                </div> @endforeach </div>
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
