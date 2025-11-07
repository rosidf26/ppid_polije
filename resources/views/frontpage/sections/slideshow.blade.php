  <div class="slider-container rev_slider_wrapper" style="height: 600px;">
     <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 600, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'parallax': { 'type': 'scroll', 'origo': 'enterpoint', 'speed': 1000, 'levels': [2,3,4,5,6,7,8,9,12,50], 'disable_onmobile': 'on' }, 'navigation' : {'arrows': { 'enable': false }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
         <ul>
              @foreach($slideshows as $index => $value )
             <li class="slide-overlay slide-overlay-primary" data-transition="fade">
                 <img src="{{ url($value->image) }}"
                     alt=""
                     data-bgposition="center center"
                     data-bgfit="cover"
                     data-bgrepeat="no-repeat"
                     class="rev-slidebg">

                 <div class="tp-caption d-none d-md-block"
                     data-frames='[{"delay":2200,"speed":500,"frame":"0","from":"opacity:0;x:10%;","to":"opacity:1;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                     data-x="center" data-hoffset="['80','80','80','135']"
                     data-y="center" data-voffset="['-33','-33','-33','-55']"><img src="{{ url('frontpage/img/slides/slide-white-line.png') }}" alt=""></div>

                 <h1 class="tp-caption font-weight-extra-bold text-color-light negative-ls-2"
                     data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                     data-x="center"
                     data-y="center"
                     data-fontsize="['50','50','50','90']"
                     data-lineheight="['55','55','55','95']">{{ $value->title }}</h1>

                 <div class="tp-caption text-light font-weight-light mt-2"
                     data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                     data-x="center"
                     data-y="center" data-voffset="['40','40','40','80']"
                     data-fontsize="['18','18','18','50']"
                     data-lineheight="['20','20','20','55']">{{ $value->description }}</div>

             </li>
        @endforeach
            
         </ul>
     </div>
 </div>