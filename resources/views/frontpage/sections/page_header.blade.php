 @php
 $segments = Request::segments();
 $url = '';
 @endphp
 <section class="page-header page-header-modern bg-color-primary page-header-md">
     <div class="container">
         <div class="row">

             <div class="col-md-12 align-self-center p-static order-2 text-center">

                 <h1 class="text-light font-weight-bold text-8">{{ get_page_title() }}</h1>
             </div>

             <div class="col-md-12 align-self-center order-1">

                 <ul class="breadcrumb d-block text-center breadcrumb-light">
                     <li><a href="{{ url('/') }}">Beranda</a></li>
                     @foreach ($segments as $index => $segment)
                     @php $url .= '/' . $segment; @endphp
                     <li class="{{ ($index == count($segments) - 1) ? 'active' : '' }}">
                         {{ ucfirst(str_replace('-', ' ', $segment)) }}
                     </li>
                     @endforeach
                 </ul>
             </div>
         </div>
     </div>
 </section>