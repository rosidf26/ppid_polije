<?php
/**
 * Created by Dims Animations.
 * User: fariztha
 * Date: 11/27/2019
 * Time: 23:55
 */
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
@if (config('backpack.base.meta_robots_content'))
<meta name="robots" content="{{ config('backpack.base.meta_robots_content', 'noindex, nofollow') }}">
@endif
<title>{{ isset($title) ? $title.' :: '.config('backpack.base.project_name') : config('backpack.base.project_name') }}</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ url(config('app.url') . '/uploads/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ url(config('app.url') . '/uploads/apple-touch-icon.png') }}">


<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/bootstrap/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/animate/animate.css') }}">
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/font-awesome/css/all.min.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/magnific-popup/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/jquery-ui/jquery-ui.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/pnotify/pnotify.custom.css') }}" />
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/vendor/boxicons/css/boxicons.min.css') }}" />

@yield('before_styles')
@stack('before_styles')

@if (config('backpack.base.styles') && count(config('backpack.base.styles')))
@foreach (config('backpack.base.styles') as $path)
<link rel="stylesheet" type="text/css" href="{{ asset($path).'?v='.config('backpack.base.cachebusting_string') }}">
@endforeach
@endif

<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/css/skins/3.0-default.css') }}" />

<!-- <link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/css/theme.css') }}" /> -->
<link rel="stylesheet" href="{{ url(config('app.url') . '/polije-admin/css/custom.css') }}">

@if (config('backpack.base.mix_styles') && count(config('backpack.base.mix_styles')))
@foreach (config('backpack.base.mix_styles') as $path => $manifest)
<link rel="stylesheet" type="text/css" href="{{ mix($path, $manifest) }}">
@endforeach
@endif
@yield('after_styles')
@stack('after_styles')
<script src="{{ url(config('app.url') . '/polije-admin/vendor/modernizr/modernizr.js') }}"></script>