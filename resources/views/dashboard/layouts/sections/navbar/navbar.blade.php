@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{route('dashboard.home')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('dashboard._partials.macros',["height"=>20])
          </span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Style Switcher -->
        <div class="navbar-nav align-items-center">
          <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
            <i class='ti ti-sm'></i>
          </a>
        </div>
        <!--/ Style Switcher -->

        <ul class="navbar-nav flex-row align-items-center ms-auto gap-1">

          <!-- Notification -->
          <x-dashboard.notifications-menu />
          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ Auth::user()->image_url }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->image_url }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">
                        {{ Auth::user()->name }}
                      </span>
                      @admin
                        <small class="text-muted">Admin</small>
                      @else
                        @storeOwner
                          <small class="text-muted">Owner {{Auth::user()->store->name}}</small>
                        @else
                          <small class="text-muted">Vendor {{Auth::user()->store->name}}</small>
                        @endStoreOwner
                      @endadmin
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item @if(Route::is('dashboard.profile')) active @endif" href="{{ Route::has('dashboard.profile') ? route('dashboard.profile') : 'javascript:void(0);' }}">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              @storeOwner
                <li>
                  <a class="dropdown-item @if(Route::is('dashboard.my-store')) active @endif" href="{{route('dashboard.my-store')}}">
                    <i class="ti ti-building-store me-2 ti-sm"></i>
                    <span class="align-middle">Manage My Store</span>
                  </a>
                </li>
              @endStoreOwner

              {{--              <li>--}}
{{--                <a class="dropdown-item" href="">--}}
{{--                  <i class='ti ti-settings me-2'></i>--}}
{{--                  <span class="align-middle">Settings</span>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--              </li>--}}
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class='ti ti-logout me-2'></i>
                  <span class="align-middle">Logout</span>
                </a>
              </li>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
            </ul>
          </li>
          <!--/ User -->



        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
