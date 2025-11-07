@if (backpack_auth()->check())
        <aside id="sidebar-left" class="sidebar-left">
            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            @include('backpack::inc.sidebar_content')
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
@endif
