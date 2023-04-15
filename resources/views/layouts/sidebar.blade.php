<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('menu.menu')</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('menu.dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('poly') }}" class="waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-polys">@lang('menu.poly')</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-handicap"></i>
                        <span key="t-inpatient">@lang('menu.inpatient')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('inpatient') }}" key="t-default">@lang('menu.inpatient')</a></li>
                        <li><a href="{{ route('inpatient.report') }}" key="t-default">@lang('menu.report')</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-walk"></i>
                        <span key="t-outpatient">@lang('menu.outpatient')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('outpatient') }}" key="t-default">@lang('menu.outpatient')</a></li>
                        <li><a href="{{ route('outpatient.report') }}" key="t-default">@lang('menu.report')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('company') }}" class="waves-effect">
                        <i class="bx bx-building"></i>
                        <span key="t-company">@lang('menu.company')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('branch') }}" class="waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-branch">@lang('menu.branch')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-user">@lang('menu.user')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
