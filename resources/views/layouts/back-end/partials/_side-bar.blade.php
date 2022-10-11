<style>
    .navbar-vertical .nav-link {
        color: #041562;
        /* font-weight: bold; */
    }

    .navbar .nav-link:hover {
        color: #041562;
    }

    .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
        color: #F14A16;
    }

    .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
        color: #F14A16;
    }

    .nav-subtitle {
        display: block;
        color: #041562;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03125rem;
    }

    .side-logo {
        background-color: #ffffff;
    }

    .nav-sub {
        background-color: #ffffff!important;
    }

    .nav-indicator-icon {
        margin-left: {{Session::get('direction') === "rtl" ? '6px' : ''}};
    }
</style>
<div id="sidebarMain" class="d-none">
    <aside
        style="background: #ffffff!important; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    <a class="navbar-brand" href="" aria-label="Front">
                        <img style="max-height: 38px"
                             onerror="this.src='{{asset('assets/back-end/img/900x400/img1.jpg')}}'"
                             class="navbar-brand-logo-mini for-web-logo"
                             src="{{storage_path("app/public/company")}}" alt="Logo">
                    </a>
                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>
                <!-- Content -->
                <div class="navbar-vertical-content mt-2" style="margin-left: 20px">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Dashboards</strong> </a>

                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('agent_list') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Agent</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('bank.list') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Bank</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('customer') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Customer</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Agent Sale Report</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>Agent Sale Report</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>All Customer Order  History</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>All Agent Customer List</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>All Agent Sale & Commission Report</strong> </a>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="#">

                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">

                                <a href="{{ route('dashboard') }}"><i class="tio-home-vs-1-outlined nav-icon"></i> <strong>All Agent Sale & Commission Summary</strong> </a>

                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>



