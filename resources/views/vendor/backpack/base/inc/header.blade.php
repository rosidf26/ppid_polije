<?php
/**
 * Created by Dims Animations Inc.
 * User: fariztha
 * Date: 11/28/2019
 * Time: 04:11
 */
?>
    <header class="header">
        <div class="logo-container">
            <a href="{{ backpack_url('/') }}" class="logo">
                <img src="{{ url(config('app.url') . '/polije-admin/img/logo.png') }}" width="75" height="35"
                     alt="Portal PPID POLIJE | Admin"/>
            </a>
            <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">
            <span class="separator"></span>
            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="{{ url(config('app.url') . '/polije-admin/img/user.png') }}" alt="{{ backpack_auth()->user()->name }}" class="rounded-circle" data-lock-picture="{{ url(config('app.url') . '/polije-admin/img/!sample-user.jpg') }}">
                    </figure>
                    <div class="profile-info" data-lock-name="{{ backpack_auth()->user()->name }}" data-lock-email="{{ backpack_auth()->user()->email }}">
                        <span class="name">{{ backpack_auth()->user()->name }}</span>
                        <span class="role">{{ backpack_auth()->user()->email }}</span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled mb-2">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ backpack_url('/profile') }}"><i class="bx bx-user-circle"></i>Profil</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ backpack_url('logout') }}"><i class="bx bx-power-off"></i> Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
