<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>{{ $settings['website_title']->value }} | Politeknik Negeri Jember</title>

<meta name="keywords" content="@yield('meta_keywords', $settings['website_title']->value . ', Politeknik Negeri Jember, POLIJE')" />
<meta name="description" content="@yield('description', $settings['website_description']->value )"/>
<meta name="author" content="Politeknik Negeri Jember">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ url('uploads/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ url('uploads/apple-touch-icon.png') }}">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

<!-- Web Fonts  -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ url('frontpage/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/fontawesome-free-7.0.1-web/css/all.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/magnific-popup/magnific-popup.min.css') }}">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ url('frontpage/css/theme.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/css/theme-elements.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/css/theme-blog.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/css/theme-shop.css') }}">

<!-- Current Page CSS -->
<link rel="stylesheet" href="{{ url('frontpage/vendor/rs-plugin/css/settings.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/rs-plugin/css/layers.css') }}">
<link rel="stylesheet" href="{{ url('frontpage/vendor/rs-plugin/css/navigation.css') }}">

<!-- Demo CSS -->


<!-- Skin CSS -->
<link rel="stylesheet" href="{{ url('frontpage/css/skins/default.css') }}">

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ url('frontpage/css/custom.css') }}">

<!-- Head Libs -->
<script src="{{ url('frontpage/vendor/modernizr/modernizr.min.js') }}"></script>