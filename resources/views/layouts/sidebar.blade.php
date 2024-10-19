<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/company/alpha-dark.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/company/alpha-dark.png') }}" alt="" height="26">
            </span>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/company/alpha-light.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/company/alpha-light.png') }}" alt="" height="26">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span data-key="t-menu">@lang('title.menu')</span></li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link menu-link"> <i class="bi bi-speedometer2"></i> <span data-key="t-dashboard">@lang('title.dashboard')</span> </a>
                </li>
                <li class="nav-item">
                    <a href="#sidebarOutpatient" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOutpatient"> <i class="bi bi-person"></i> <span data-key="t-dashboard">@lang('title.outpatient')</span> </a>
                    <div class="collapse menu-dropdown" id="sidebarOutpatient">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('outpatient.entry.index') }}" class="nav-link" data-key="t-team"> @lang('title.entry_form')</a>
                                <a href="pages-team" class="nav-link" data-key="t-team"> @lang('title.exit_form')</a>
                                <a href="pages-team" class="nav-link" data-key="t-team"> @lang('title.cancel_form')</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('klpcm') }}" class="nav-link menu-link"> <i class="bi bi-paperclip"></i> <span data-key="t-dashboard">@lang('title.klpcm')</span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">@lang('title.report')</span></li>
                <li class="nav-item">
                    <a href="{{ route('report.outpatient') }}" class="nav-link menu-link"> <i class="bi bi-printer"></i> <span data-key="t-dashboard">@lang('title.outpatient')</span> </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.klpcm') }}" class="nav-link menu-link"> <i class="bi bi-printer"></i> <span data-key="t-dashboard">@lang('title.klpcm')</span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">@lang('title.master')</span></li>
                <li class="nav-item">
                    <a href="{{ route('report.klpcm') }}" class="nav-link menu-link"> <i class="bi bi-building"></i> <span data-key="t-dashboard">@lang('title.division')</span> </a>
                    <a href="{{ route('report.klpcm') }}" class="nav-link menu-link"> <i class="bi bi-clipboard-pulse"></i> <span data-key="t-dashboard">@lang('title.patient')</span> </a>
                    <a href="{{ route('role.index') }}" class="nav-link menu-link"> <i class="bi bi-gear-wide-connected"></i> <span data-key="t-dashboard">@lang('title.role')</span> </a>
                    <a href="{{ route('permission.index') }}" class="nav-link menu-link"> <i class="bi bi-bounding-box"></i> <span data-key="t-dashboard">@lang('title.permission')</span> </a>
                    <a href="{{ route('report.klpcm') }}" class="nav-link menu-link"> <i class="bi bi-person-fill-gear"></i> <span data-key="t-dashboard">@lang('title.employee')</span> </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
