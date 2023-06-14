<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="{{ env('APP_URL') . '/img/logo-ct-dark.png' }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">FK EduSearch</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->ref_role_id == 8)
                {{-- User menu --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Menu</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user.profile' ? 'active' : '' }}"
                        href="{{ route('user.profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'post.index' ? 'active' : '' }}"
                        href="{{ route('post.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Discussion Board</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'complaint.index' ? 'active' : '' }}"
                        href="{{ route('complaint.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-chat-round text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Complaint Record</span>
                    </a>
                </li>
            @elseif(auth()->user()->ref_role_id == 9)
                {{-- Expert menu --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Expert Menu</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'expert.profile' ? 'active' : '' }}"
                        href="{{ route('expert.profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'expert.index' ? 'active' : '' }}"
                        href="{{ route('expert.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Discussion Board</span>
                    </a>
                </li>
            @else
                {{-- Admin menu --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin Menu</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'complaint.index' ? 'active' : '' }}"
                        href="{{ route('complaint.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-chat-round text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Complaint</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'report.index' ? 'active' : '' }}"
                        href="{{ route('report.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-bug text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Report</span>
                    </a>
                </li>
            @endif
            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Examples</h6>
            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'form-example' ? 'active' : '' }}"
                    href="{{ route('form-example') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Form</span>
                </a>
            </li> --}}

        </ul>
    </div>
    {{-- <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="/img/illustrations/icon-documentation-warning.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div>
        <a href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100"
            href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank" type="button">Upgrade to PRO</a>
    </div> --}}
</aside>
