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
								<h5 class="font-weight-bold pt-4">Kategori</h5>
								<ul class="nav nav-list flex-column mb-5">
									<li class="nav-item"><a class="nav-link" href="#">Satu</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Dua</a></li>
								</ul>
								
							</aside>
						</div>
						<div class="col-lg-9">
							<div class="blog-posts">
								<article class="post post-medium">
									<div class="row mb-3">
										<div class="col-lg-5">
											<div class="post-image">
												<a href="{{ url('detail-berita') }}">
													<img src="{{ url('frontpage/img/blog/medium/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="post-content">
												<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="{{ url('detail-berita') }}">This is a stardard post with preview image</a></h2>
												<p class="mb-0">Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. [...]</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="post-meta">
												<span><i class="far fa-calendar-alt"></i> January 10, 2025 </span>
												<span><i class="far fa-user"></i> By <a href="#">Admin</a> </span>
												<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="{{ url('detail-berita') }}" class="btn btn-xs btn-light text-1 text-uppercase">Baca Selengkapnya</a></span>
											</div>
										</div>
									</div>
								</article>

                                <article class="post post-medium">
									<div class="row mb-3">
										<div class="col-lg-5">
											<div class="post-image">
												<a href="{{ url('detail-berita') }}">
													<img src="{{ url('frontpage/img/blog/medium/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="post-content">
												<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="{{ url('detail-berita') }}">This is a stardard post with preview image</a></h2>
												<p class="mb-0">Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. [...]</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="post-meta">
												<span><i class="far fa-calendar-alt"></i> January 10, 2025 </span>
												<span><i class="far fa-user"></i> By <a href="#">Admin</a> </span>
												<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="{{ url('detail-berita') }}" class="btn btn-xs btn-light text-1 text-uppercase">Baca Selengkapnya</a></span>
											</div>
										</div>
									</div>
								</article>

                                <article class="post post-medium">
									<div class="row mb-3">
										<div class="col-lg-5">
											<div class="post-image">
												<a href="{{ url('detail-berita') }}">
													<img src="{{ url('frontpage/img/blog/medium/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>
										</div>
										<div class="col-lg-7">
											<div class="post-content">
												<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="{{ url('detail-berita') }}">This is a stardard post with preview image</a></h2>
												<p class="mb-0">Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. [...]</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="post-meta">
												<span><i class="far fa-calendar-alt"></i> January 10, 2025 </span>
												<span><i class="far fa-user"></i> By <a href="#">Admin</a> </span>
												<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="{{ url('detail-berita') }}" class="btn btn-xs btn-light text-1 text-uppercase">Baca Selengkapnya</a></span>
											</div>
										</div>
									</div>
								</article>
								

								<ul class="pagination float-right">
									<li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
								</ul>

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
