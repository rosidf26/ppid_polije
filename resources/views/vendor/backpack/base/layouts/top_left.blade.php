<?php
/**
 * Created by Dims Animations.
 * User: fariztha
 * Date: 11/28/2019
 * Time: 00:01
 */
?><!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="left-sidebar-panel sidebar-left-sm" data-style-switcher-options="{'sidebarColor': 'dark'}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('backpack::inc.head')
</head>
<body>
<section class="body">
    @include('backpack::inc.header')
    <div class="inner-wrapper mb-4">
        @include('backpack::inc.sidebar')
        <section role="main" class="content-body">
            @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))
            @yield('page-header')
            @yield('content')
        </section>
    </div>
</section>
    
@yield('before_scripts')
@stack('before_scripts')

@include('backpack::inc.scripts')

@yield('after_scripts')
@stack('after_scripts')
<script src="{{ url(config('app.url') . '/polije-admin/js/theme.js') }}"></script>
<script src="{{ url(config('app.url') . '/polije-admin/js/custom.js') }}"></script>
<script src="{{ url(config('app.url') . '/polije-admin/js/theme.init.js') }}"></script>


</body>
</html>

