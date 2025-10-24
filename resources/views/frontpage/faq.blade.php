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
				

				<div class="container py-2">
<div class="row">
						<div class="col">

							<h2 class="font-weight-normal text-7 mb-2">Frequently Asked <strong class="font-weight-extra-bold">Questions</strong></h2>
							<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula.</p>

							<hr class="solid my-5">

							<div class="toggle toggle-primary" data-plugin-toggle>
								<section class="toggle active">
									<label>Curabitur eget leo at velit imperdiet vague iaculis vitaes?</label>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.</p>
								</section>

								<section class="toggle">
									<label>Curabitur eget leo at velit imperdiet viaculis vitaes?</label>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa.</p>
								</section>
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