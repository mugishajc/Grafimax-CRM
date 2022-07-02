@php
    $users=\Auth::user();
    $profile=asset(Storage::url('avatar/'));
    $currantLang = $users->currentLanguage();
    $languages= Utility::languages();
@endphp
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto search-element" method="post">
        @csrf
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        {{--  <input class="form-control" type="search" placeholder="Job & Task Search here..." aria-label="Search" data-width="250">  --}}

    </form>

    <ul class="navbar-nav navbar-right">
<!--
        @can('manage language')
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg language-dd"><i class="fas fa-language"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">{{__('Choose Language')}}
                    </div>
                    @can('create language')
                        <a href="{{route('manage.language',[$currantLang])}}" class="dropdown-item btn manage-language-btn">
                            <span> {{ __('Create & Customize') }}</span>
                        </a>
                    @endcan

                    <div class="dropdown-list-content dropdown-list-icons">
                        @foreach($languages as $language)
                            <a href="{{route('change.language',$language)}}" class="dropdown-item dropdown-item-unread @if($language == $currantLang) active-language @endif">
                                <span> {{Str::upper($language)}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </li>
        @endcan -->

        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <!-- <img alt="image" src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.jpg')}}" class="rounded-circle mr-1">
                 -->
                <div class="d-sm-none d-lg-inline-block">{{__('Hi')}}, {{\Auth::user()->name}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Ikaze!</div>
                <a href="{{route('profile')}}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{__('My profile')}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{__('Logout')}}</span>
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            </div>
        </li>
    </ul>
</nav>

