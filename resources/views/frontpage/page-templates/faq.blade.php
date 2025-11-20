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
								 @foreach($faq as $index => $value)
								<section class="toggle @if($index == 0) active @endif">
									<label>{{ $value->question }}</label>
									<p>{!! $value->answer !!}</p>
								</section>
 @endforeach
							</div>
							 <div class="pagination">
                    {{ $faq->links() }}
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