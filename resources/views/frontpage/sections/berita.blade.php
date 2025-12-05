<div class="container pt-5">
    <!-- Section Berita -->
    <h2 class="font-weight-normal text-6 mb-4 text-center">
        <strong class="font-weight-extra-bold">BERITA</strong>
    </h2>

    <div class="row pb-5 news-container">
        <!-- Berita 1 -->
        @foreach($news as $index => $value)
        <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
            <div class="thumb-info thumb-info-hide-wrapper-bg flex-fill d-flex flex-column">
                <div class="thumb-info-wrapper">
                    <a href="{{ $value->category->slug . '/' . $value->slug }}">
                        <img src="{{ ($value->image) ? url($value->image) : url('frontpage/img/team/team-1.jpg') }}"
                            alt="" class="news-image">
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner">{{ $value->title }}</span>
                            <span class="thumb-info-type">{{ strftime("%e %B %Y", strtotime($value->date)) }}</span>
                        </span>
                    </a>
                </div>
                <div class="thumb-info-caption mt-auto">
                    <div class="thumb-info-caption-text">
                        {{ substr(strip_tags($value->content), 0, 150) }}
                    </div>
                    <a class="btn btn-primary btn-md mt-2" href="{{ $value->category->slug . '/' . $value->slug }}">Baca
                        Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Berita 2 -->


        <!-- Berita 3 -->

    </div>

    <!-- Section Pengumuman -->
    <h2 class="font-weight-normal text-6 mb-4 text-center">
        <strong class="font-weight-extra-bold">PENGUMUMAN</strong>
    </h2>

    <div class="row">
        <div class="col pb-4">

            <div class="recent-posts-vertical mt-3">

                <!-- Post 1 -->
                @foreach($pengumuman as $index => $value)
                <article class="post d-flex align-items-start p-3 border rounded shadow-sm mb-3 bg-white">
                    <div class="post-date text-center bg-primary text-white rounded flex-shrink-0 me-3 p-2 custom-date">
                        <span
                            class="day d-block fw-bold fs-4">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('d') }}</span>
                        <span
                            class="month text-uppercase small">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('M') }}</span>
                        <span
                            class="year small opacity-75">{{ \Carbon\Carbon::parse($value->date)->translatedFormat('Y') }}</span>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-semibold mb-2">
                            <a href="{{ $value->category->slug . '/' . $value->slug }}"
                                class="text-decoration-none text-dark">
                                {{ $value->title }}
                            </a>
                        </h4>
                        <p class="mb-3 text-muted">
                            {{ substr(strip_tags($value->content), 0, 150) }}
                        </p>
                        <a href="{{ $value->category->slug . '/' . $value->slug }}"
                            class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mt-1">
                            <strong>Baca Selengkapnya</strong>
                        </a>
                    </div>
                </article>
                @endforeach

                <!-- Post 2 -->

                <!-- Post 3 -->

            </div>

        </div>
    </div>



    <!-- <div class="row mt-3">
  <div class="col">

    <div class="recent-posts-list d-flex flex-column gap-4">
      <article class="post d-flex align-items-start p-3 border rounded shadow-sm flex-row mb-3">
        <div class="post-date text-center bg-primary text-white rounded flex-shrink-0 me-3">
          <span class="day d-block fw-bold">15</span>
          <span class="month text-uppercase">Jan</span>
          <span class="year small opacity-75">2025</span>
        </div>
        <div class="flex-grow-1">
          <h4 class="fw-semibold mb-2">
            <a href="{{ url('detail-pengumuman') }}" class="text-decoration-none text-dark">Lorem ipsum dolor sit amet, consectetur</a>
          </h4>
          <p class="mb-3 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquam nisi ultricies nisi luctus, sed fermentum.</p>
          <a href="{{ url('detail-pengumuman') }}" class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mt-1">
            <strong>Baca Selengkapnya</strong>
            <i class="fas fa-chevron-right text-2 ps-2"></i>
          </a>
        </div>
      </article>

      <article class="post d-flex align-items-start p-3 border rounded shadow-sm flex-row mb-3">
        <div class="post-date text-center bg-primary text-white rounded flex-shrink-0 me-3">
          <span class="day d-block fw-bold">15</span>
          <span class="month text-uppercase">Jan</span>
          <span class="year small opacity-75">2025</span>
        </div>
        <div class="flex-grow-1">
          <h4 class="fw-semibold mb-2">
            <a href="{{ url('detail-pengumuman') }}" class="text-decoration-none text-dark">Lorem ipsum dolor sit amet, consectetur</a>
          </h4>
          <p class="mb-3 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquam nisi ultricies nisi luctus, sed fermentum.</p>
          <a href="{{ url('detail-pengumuman') }}" class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mt-1">
            <strong>Baca Selengkapnya</strong>
            <i class="fas fa-chevron-right text-2 ps-2"></i>
          </a>
        </div>
      </article>

      <article class="post d-flex align-items-start p-3 border rounded shadow-sm flex-row mb-3">
        <div class="post-date text-center bg-primary text-white rounded flex-shrink-0 me-3">
          <span class="day d-block fw-bold">15</span>
          <span class="month text-uppercase">Jan</span>
          <span class="year small opacity-75">2025</span>
        </div>
        <div class="flex-grow-1">
          <h4 class="fw-semibold mb-2">
            <a href="{{ url('detail-pengumuman') }}" class="text-decoration-none text-dark">Lorem ipsum dolor sit amet, consectetur</a>
          </h4>
          <p class="mb-3 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur aliquam nisi ultricies nisi luctus, sed fermentum.</p>
          <a href="{{ url('detail-pengumuman') }}" class="btn btn-light text-uppercase text-primary text-1 py-2 px-3 mt-1">
            <strong>Baca Selengkapnya</strong>
            <i class="fas fa-chevron-right text-2 ps-2"></i>
          </a>
        </div>
      </article>


    </div>
  </div>
</div> -->



    <!-- <div class="list-group">
        
        <div class="list-group-item mb-3 appear-animation" data-appear-animation="fadeInUpShorter">
            <h5 class="mb-1 font-weight-bold text-color-primary">
                <i class="fa-solid fa-bullhorn text-primary me-2"></i>
                Judul Pengumuman Pertama
            </h5>
            <small class="text-muted d-block mb-2">1 September 2025</small>
            <p class="mb-2">
                Ringkasan pengumuman pertama. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Integer nec odio. Praesent libero. Sed cursus ante dapibus diam...
            </p>
            <a href="#" target="_blank" class="btn btn-sm btn-dark">Baca Selengkapnya</a>
        </div>

       
        <div class="list-group-item mb-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
            <h5 class="mb-1 font-weight-bold text-color-primary">
                <i class="fa-solid fa-bullhorn text-primary me-2"></i>
                Judul Pengumuman Kedua
            </h5>
            <small class="text-muted d-block mb-2">28 Agustus 2025</small>
            <p class="mb-2">
                Ringkasan pengumuman kedua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Integer nec odio. Praesent libero. Sed cursus ante dapibus diam...
            </p>
            <a href="#" target="_blank" class="btn btn-sm btn-dark">Baca Selengkapnya</a>
        </div>
    </div> -->

</div>