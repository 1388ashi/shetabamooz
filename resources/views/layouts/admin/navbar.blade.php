<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="index.html">
                <img src="{{asset('assets/images/brand/favicon.png')}}" height="45px"
                     class="header-brand-img desktop-lgo" alt="Dayonelogo">
                <img src="{{asset('assets/images/brand/favicon.png')}}"
                     class="header-brand-img dark-logo" alt="Dayonelogo">
                <img src="{{asset('assets/images/brand/favicon.png')}}"
                     class="header-brand-img mobile-logo" alt="Dayonelogo" style="height: 45px">
                <img src="{{asset('assets/images/brand/favicon.png')}}"
                     class="header-brand-img darkmobile-logo" alt="Dayonelogo">
            </a>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#">
                    <i class="feather feather-menu"></i>
                </a>
                <a class="close-toggle" href="#">
                    <i class="feather feather-x"></i>
                </a>
            </div>
{{--            <div class="mt-0">--}}
{{--                <form class="form-inline">--}}
{{--                    <div class="search-element">--}}
{{--                        <input type="search" class="form-control header-search" placeholder="جستجو..."--}}
{{--                               aria-label="Search" tabindex="1">--}}
{{--                        <button class="btn btn-primary-color">--}}
{{--                            <i class="feather feather-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
            <!-- SEARCH -->
            <div class="d-flex order-lg-2 my-auto mr-auto">
                <a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#"
                   data-toggle="search">
                    <i class="feather feather-search search-icon header-icon"></i>
                </a>
                <div class="dropdown header-fullscreen">
                    <a class="nav-link icon full-screen-link">
                        <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>

{{--                    <div class="dropdown header-notify">--}}
{{--                        <a  href="{{ route('admin.notes.reminds') }}" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">--}}
{{--                            <i class="feather feather-bell header-icon"></i>--}}
{{--                            @if(\Modules\Note\Entities\Note::getunreadNotesCount() > 0)--}}
{{--                                <span class="bg-dot"></span>--}}
{{--                            @endif--}}
{{--                        </a>--}}
{{--                    </div>--}}

            </div>
        </div>
    </div>
</div>
