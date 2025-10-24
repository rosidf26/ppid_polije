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

            <div class="container py-4 mb-4">

                <div class="row">
                    <div class="col-lg-3 order-1 order-lg-1 mt-4 mt-lg-0 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="300">
							<aside class="sidebar">
								<h5 class="font-weight-bold">RINGKASAN LAPORAN PER TAHUN</h5>
								<ul class="nav nav-list flex-column mb-5">
									<li class="nav-item"><a class="nav-link" href="#">2021</a></li>
									<li class="nav-item"><a class="nav-link" href="#">2022</a></li>
									<li class="nav-item"><a class="nav-link" href="#">2023</a></li>
									<li class="nav-item"><a class="nav-link" href="#">2024</a></li>
								</ul>
								
							</aside>
						</div>
						<div class="col-lg-9 order-2 order-lg-2">

							<div class="row">
								<div class="col">

									<div class="lightbox" data-plugin-options="{'delegate': 'a.lightbox-portfolio', 'type': 'image', 'gallery': {'enabled': true}}">
										<div class="row portfolio-list">
											<div class="col-lg-12 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="500">
												<div class="portfolio-item">
													<span class="thumb-info thumb-info-centered-icons thumb-info-no-borders">
														<span class="thumb-info-wrapper">
															<img src="{{ url('frontpage/img/projects/project-1-short.jpg') }}" class="img-fluid" alt="">
															<a href="{{ url('frontpage/img/projects/project-1-short.jpg') }}" class="lightbox-portfolio">
																<span class="thumb-info-action">
																	<span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fas fa-search text-dark"></i></span>
																</span>
															</a>
														</span>
													</span>
												</div>
											</div>
											<div class="col-lg-12 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="700">
												<div class="portfolio-item">
													<span class="thumb-info thumb-info-centered-icons thumb-info-no-borders">
														<span class="thumb-info-wrapper">
															<img src="{{ url('frontpage/img/projects/project-2-short.jpg') }}" class="img-fluid" alt="">
															<a href="{{ url('frontpage/img/projects/project-2-short.jpg') }}" class="lightbox-portfolio">
																<span class="thumb-info-action">
																	<span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fas fa-search text-dark"></i></span>
																</span>
															</a>
														</span>
													</span>
												</div>
											</div>
											<div class="col-lg-12 appear-animation" data-appear-animation="fadeInUpShorter">
												<div class="portfolio-item">
													<span class="thumb-info thumb-info-centered-icons thumb-info-no-borders">
														<span class="thumb-info-wrapper">
															<img src="{{ url('frontpage/img/projects/project-27-short.jpg') }}" class="img-fluid" alt="">
															<a href="{{ url('frontpage/img/projects/project-27-short.jpg') }}" class="lightbox-portfolio">
																<span class="thumb-info-action">
																	<span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fas fa-search text-dark"></i></span>
																</span>
															</a>
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>

								</div>
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