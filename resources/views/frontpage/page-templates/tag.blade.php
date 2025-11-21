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
								<form action="page-search-results.html" method="get">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Cari berita..." name="s" id="s" type="text">
										<span class="input-group-append">
											<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>
								<h5 class="font-weight-bold pt-4">Tags</h5>
                                  @if(isset($all_tags))
								<ul class="nav nav-list flex-column mb-5">
								 @foreach ($all_tags as $tg)
									<li class="nav-item"><a class="nav-link {{ isset($tag) && $tag->slug == $tg->slug ? 'active' : '' }}" href="{{ route('tag.filter', $tg->slug) }}">  {{ $tg->name }} ({{ $tg->articles_count }}) </a></li>
									@endforeach
								</ul>
                                 @endif
								
							</aside>
						</div>
						<div class="col-lg-9">
							<div class="blog-posts">
								 @foreach($articles as $index => $value)
								<article class="post post-medium">
									<div class="row mb-3">
										<div class="col-lg-5">
											<div class="post-image">
												<a href="{{ url( $value->category->slug . '/' . $value->slug ) }}">
													<img src="{{ $value->image ? url($value->image) : url('frontpage/img/blog/medium/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="post-content">
												<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="{{ url( $value->category->slug . '/' . $value->slug ) }}">{{ \Illuminate\Support\Str::limit($value->title, 50) }}</a></h2>
												<p class="mb-0">{{ substr(strip_tags($value->content), 0, 400) }} ...</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="post-meta">
												<span><i class="far fa-calendar-alt"></i> {{ tgl_indo($value->date) }} </span>
												<span><i class="far fa-user"></i> By <a>Admin</a> </span>
												 @if($value->tags->count())
												 @endif
												<span><i class="far fa-folder"></i> 
												 @foreach($value->tags as $tag)
												<a>{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
												@endforeach
												</span>
												<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="{{ url( $value->category->slug . '/' . $value->slug ) }}" class="btn btn-xs btn-light text-1 text-uppercase">Baca Selengkapnya</a></span>
											</div>
										</div>
									</div>
								</article>
								@endforeach

								<!-- PAGINATION -->
								<div class="float-right">
									{{ $articles->links() }}
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
