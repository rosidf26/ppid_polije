
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
              <div class="blog-posts single-post">
                <article class="post post-large blog-single-post border-0 m-0 p-0">
                  <div class="post-image ml-0">
                    <a href="#">
                      <img src="{{ url('frontpage/img/blog/wide/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt=""/>
                    </a>
                  </div>

                  <div class="post-date ml-0 detail">
                    <span class="day text-dark">10</span>
                    <span class="month">Jan</span>
                     <span class="year">2025</span>
                  </div>

                  <div class="post-content ml-0">
                    <h2 class="font-weight-bold">
                      <a href="#">Class aptent taciti sociosqu ad litora torquent</a>
                    </h2>

                    <div class="post-meta">
                      <span
                        ><i class="far fa-user"></i> By <a href="#">Admin</a>
                      </span>
                    </div>

                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Curabitur lectus lacus, rutrum sit amet placerat et,
                      bibendum nec mauris. Duis molestie, purus eget placerat
                      viverra, nisi odio gravida sapien, congue tincidunt nisl
                      ante nec tellus. Vestibulum ante ipsum primis in faucibus
                      orci luctus et ultrices posuere cubilia Curae; Lorem ipsum
                      dolor sit amet, consectetur adipiscing elit. Fusce
                      sagittis, massa fringilla consequat blandit, mauris ligula
                      porta nisi, non tristique enim sapien vel nisl.
                      Suspendisse vestibulum lobortis dapibus. Vestibulum ante
                      ipsum primis in faucibus orci luctus et ultrices posuere
                      cubilia Curae; Praesent nec tempus nibh. Donec mollis
                      commodo metus et fringilla. Etiam venenatis, diam id
                      adipiscing convallis, nisi eros lobortis tellus, feugiat
                      adipiscing ante ante sit amet dolor. Vestibulum vehicula
                      scelerisque facilisis. Sed faucibus placerat bibendum.
                      Maecenas sollicitudin commodo justo, quis hendrerit leo
                      consequat ac. Proin sit amet risus sapien, eget interdum
                      dui. Proin justo sapien, varius sit amet hendrerit id,
                      egestas quis mauris.
                    </p>
                    <p>
                      Ut ac elit non mi pharetra dictum nec quis nibh.
                      Pellentesque ut fringilla elit. Aliquam non ipsum id leo
                      eleifend sagittis id a lorem. Sociis natoque penatibus et
                      magnis dis parturient montes, nascetur ridiculus mus.
                      Aliquam massa mauris, viverra et rhoncus a, feugiat ut
                      sem. Quisque ultricies diam tempus quam molestie vitae
                      sodales dolor sagittis. Praesent commodo sodales purus.
                      Maecenas scelerisque ligula vitae leo adipiscing a
                      facilisis nisl ullamcorper. Vestibulum ante ipsum primis
                      in faucibus orci luctus et ultrices posuere cubilia Curae;
                    </p>
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
