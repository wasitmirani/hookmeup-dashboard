
@php
$sidebar=sideBarMenu();
// dd($sidebar);
@endphp
@push('styles')
    <style>
.main-menu.menu-light .navigation>li .active {
    background: transparent !important;
}
    </style>
@endpush

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('home')}}"><span class="brand-logo">
             </span>
            <h2 class="brand-text">{{config('app.name')}}</h2></a></li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">

      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        @foreach ($sidebar as $menu)
        @if(!empty($menu['heading']))

            <li class=" navigation-header"><span data-i18n="{{$menu['heading']}}">{{$menu['heading']}}</span><i data-feather="more-horizontal"></i>
            </li>
        @endif
       @if(!empty($menu['menu']))
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="{{$menu['menu']['icon']}}">
            </i><span class="menu-title text-truncate" data-i18n="{{$menu['menu']['title']}}">{{$menu['menu']['title']}}</span>
            <span class="badge badge-light-warning rounded-pill ms-auto me-1"></span>
          </a>

          <ul class="menu-content">
            @foreach ($menu['menu']['sub_menu'] as $item)
                <li >
                    <router-link class="d-flex align-items-center"  to="{{$item['v-route']}}" >
                        <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="{{$item['title']}}">{{$item['title']}}</span>

                    </router-link>
                </li>
            @endforeach


          </ul>
        </li>
        @endif
        @if(!empty($menu['single_link']))


        <li class=" nav-item" active-class="active">
            <router-link  class="d-flex align-items-center " to="{{$menu['single_link']['v-route']}}" >
                <i class=" {{$menu['single_link']['icon']}}"></i>
              <span class="menu-title text-truncate">{{$menu['single_link']['title']}}</span>
            </router-link>

        </li>
        {{-- <li class="nav-item">
           <router-link  class="d-flex align-items-center" to="{{$menu['single_link']['v-route']}}" ><i class=" {{$menu['single_link']['icon']}}"></i><span>{{$menu['single_link']['title']}}</span></router-link>
        </li> --}}
        @endif
        @endforeach
      </ul>
    </div>
  </div>
