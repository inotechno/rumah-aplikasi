<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img width="30" src="{{ asset('img/' . config('settings.app_logo_crop')) }}" alt="">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ config('settings.app_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps &amp; Landing Page</span>
        </li>

        <li class="menu-item {{ request()->is('service') ? 'active' : '' }}">
            <a href="{{ route('service.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-shape-triangle"></i>
                <div data-i18n="Services">Services</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('portfolio') ? 'active' : '' }}">
            <a href="{{ route('portfolio.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bxl-netlify"></i>
                <div data-i18n="Portfolios">Portfolios</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('partner') ? 'active' : '' }}">
            <a href="{{ route('partner.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bxl-graphql"></i>
                <div data-i18n="Partners">Partners</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('message') ? 'active' : '' }}">
            <a href="{{ route('message.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bxs-chat"></i>
                <div data-i18n="Messages">Messages</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Blog Post</span>
        </li>

        <li class="menu-item {{ request()->is('category') ? 'active' : '' }}">
            <a href="{{ route('category.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Categories">Categories</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('post') ? 'active' : '' }}">
            <a href="{{ route('post.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="Posts">Posts</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-tag-alt"></i>
                <div data-i18n="Tags">Tags</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Setting</span>
        </li>
        <!-- Apps & Pages -->

        <li class="menu-item">
            <a href="app-calendar.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Setting">Setting</div>
            </a>
        </li>
    </ul>



</aside>
