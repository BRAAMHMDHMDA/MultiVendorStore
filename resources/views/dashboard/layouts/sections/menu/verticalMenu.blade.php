@php
    $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if(!isset($navbarFull))
        <div class="app-brand demo">
            <a href="{{route('dashboard.home')}}" class="app-brand-link">
                @if(config('app.logo&name'))
                    <img src="{{config('app.logo&name')}}" width="70%" alt="">
                @else
                    <img src="{{config('app.logo')}}" width="70%" alt="">
                    <span class="app-brand-text demo menu-text fw-bold">{{config('app.name')}}</span>
                @endif

{{--                <span class="app-brand-logo demo">--}}
{{--                --}}{{--        @include('dashboard._partials.macros',["height"=>20])--}}
{{--              </span>--}}
{{--                <span class="app-brand-text demo menu-text fw-bold">{{config('app.name')}}</span>--}}
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </div>
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)
            {{-- adding active and open class if child is active --}}

            {{-- menu headers --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ $menu->menuHeader }}</span>
                </li>

            @else

                {{-- active menu method --}}
                @php
                    $activeClass = null;
                    $currentRouteName = Illuminate\Support\Str::contains(request()->getRequestUri(), strtolower($menu->name));
//                    $currentRouteName = Route::currentRouteName();
                    if ($currentRouteName) {
                      $activeClass = 'active';
                    }
                    elseif (isset($menu->submenu)) {
                    if (gettype($menu->slug) === 'array') {
                    foreach($menu->slug as $slug){
                    if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                    $activeClass = 'active open';
                    }
                    }
                    }
                    else{
                    if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
                    $activeClass = 'active open';
                    }
                    }

                    }
                @endphp

                {{-- main menu --}}
                @if($menu->guard !== "all")
                    @admin
                        <li class="menu-item {{$activeClass}}">
                        <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                           class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                           @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                            @isset($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endisset
                            <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                            @isset($menu->badge)
                                <div class="badge bg-label-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>

                            @endisset
                        </a>

                        {{-- submenu --}}
                        @isset($menu->submenu)
                            @include('dashboard.layouts.sections.menu.submenu',['menu' => $menu->submenu])
                        @endisset
                    </li>
                    @endadmin
                @else
                    <li class="menu-item {{$activeClass}}">
                        <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                           class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                           @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                            @isset($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endisset
                            <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                            @isset($menu->badge)
                                <div class="badge bg-label-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>

                            @endisset
                        </a>

                        {{-- submenu --}}
                        @isset($menu->submenu)
                            @include('dashboard.layouts.sections.menu.submenu',['menu' => $menu->submenu])
                        @endisset
                    </li>
                @endif

            @endif
        @endforeach
    </ul>

</aside>
