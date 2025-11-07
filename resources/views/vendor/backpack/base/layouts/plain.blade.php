<?php
/**
 * Created by Dims Animations.
 * User: fariztha
 * Date: 11/28/2019
 * Time: 00:01
 */
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="fixed">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('backpack::inc.head')
</head>
<body>
<section class="body">
    @yield('page-header')
    @yield('content')
</section>
@yield('before_scripts')
@stack('before_scripts')

@include('backpack::inc.scripts')
@include('backpack::inc.alerts')

@yield('after_scripts')

<script src="{{ url(config('app.url') . '/polije-admin/js/theme.js') }}"></script>
<script src="{{ url(config('app.url') . '/polije-admin/js/custom.js') }}"></script>
<script src="{{ url(config('app.url') . '/polije-admin/js/theme.init.js') }}"></script>

@stack('after_scripts')

</body>
</html>
