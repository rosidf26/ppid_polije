
<div class="container pt-5">
    <div class="row">
         @foreach($informasi_publik as $index => $value)
       
        <!-- Informasi Setiap Saat -->
        <div class="col-lg-4 d-flex">
            <div class="card card-hover shadow-sm w-100 d-flex flex-column">
                <!-- Icon besar transparan di tengah -->
                <div class="card-bg-icon">
                    <i class="icons icon-{{ (isset($value->extras['featured_icon'])) ? $value->extras['featured_icon'] : ''
                                }}"></i>
                </div>
                <div class="card-body d-flex flex-column text-center">
                    <h4 class="card-title font-weight-bold mb-2">{{ $value->title }}</h4>
                    <p class="card-text">
                         {{ (isset($value->extras['featured_content'])) ? $value->extras['featured_content'] : '' }}
                    </p>
                    <div class="mt-auto">
                        <a href="{{ url($value->slug) }}" class="btn btn-primary btn-lg text-3 font-weight-semibold px-3 py-2" target="_blank">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
            @endforeach

    </div>

    <hr class="solid my-5">

    <div class="row">
        <div class="col">
            <h2 class="font-weight-normal text-6 mb-2 pb-1 text-center"><strong class="font-weight-extra-bold">TAUTAN TERKAIT</strong></h2>

            <div class="my-4 lightbox appear-animation" data-appear-animation="fadeInUpShorter" data-plugin-options="{'delegate': 'a.lightbox-portfolio', 'type': 'image', 'gallery': {'enabled': true}}">
                <div class="owl-carousel owl-theme pb-3" data-plugin-options="{'items': 4, 'margin': 35, 'loop': false}">

@foreach($stakeholders as $index => $value)
                    <div class="portfolio-item">
                        <span class="thumb-info thumb-info-lighten thumb-info-no-borders thumb-info-bottom-info thumb-info-centered-icons border-radius-0">
                            <span class="thumb-info-wrapper border-radius-0">
                                <img src="{{ url($value->image) }}" class="img-fluid border-radius-0" alt="">
                                <span class="thumb-info-action">
                                    <a href="{{ url($value->link) }}">
                                        <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fas fa-link"></i></span>
                                    </a>
                                </span>
                            </span>
                        </span>
                    </div>
                     @endforeach

                </div>
            </div>



        </div>
    </div>

</div>