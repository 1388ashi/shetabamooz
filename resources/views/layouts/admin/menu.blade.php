<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ Env('APP_URL_FRONT') }}">
            <img src="{{ asset('dist/img/logo.png') }}" class="header-brand-img desktop-lgo" alt="admin">
            <img src="{{ asset('dist/img/logo.png') }}" class="header-brand-img dark-logo" alt="admin" width="75px">
            <img src="{{ asset('dist/img/logo.png') }}" class="header-brand-img mobile-logo" width="15px"
                alt="admin">
            <img src="{{ asset('dist/img/logo.png') }}" class="header-brand-img darkmobile-logo"
                alt="admin">
        </a>
    </div>
    <div class="app-sidebar3">
        <ul class="side-menu">
            <li class="side-item side-item-category mt-4">داشیورد مدیریت - {{ auth()->user()->name }}</li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard sidemenu_icon"></i>
                    <span class="side-menu__label">داشبورد</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-users sidemenu_icon"></i>
                    <span class="side-menu__label">مدیریت دوره ها</span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                    <li><a href="{{route('admin.course-categories.index')}}" class="slide-item">دسته بندی ها</a></li>
                    <li><a href="{{route('admin.courses.index')}}" class="slide-item">دوره ها</a></li>
                    <li><a href="{{route('admin.comments.index')}}" class="slide-item">نظرات</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-school-o sidemenu_icon"></i>
                    <span class="side-menu__label">مدیریت بوتکمپ ها</span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                    <li><a href="{{route('admin.bootcamps.index')}}" class="slide-item">بوتکمپ ها</a></li>
                    <li><a href="{{route('admin.bootcamp-faqs.index')}}" class="slide-item">بوتکمپ ها</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-book-open sidemenu_icon"></i>
                    <span class="side-menu__label">مدیریت بلاگ</span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                        <li><a href="{{route('admin.post-categories.index')}}" class="slide-item">دسته بندی ها</a></li>
                        <li><a href="{{route('admin.posts.index')}}" class="slide-item">مطالب</a></li>
                        <li><a href="{{route('admin.post-comments.index')}}" class="slide-item">نظرات</a></li>
                </ul>
            </li>


            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-users sidemenu_icon"></i>
                    <span class="side-menu__label">مدیریت کاربر ها</span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
{{--                    <li><a href="{{ route('admin.admins.index') }}" class="slide-item">ادمین ها</a></li>--}}
                    <li><a href="{{ route('admin.professors.index') }}" class="slide-item">استاد ها</a></li>
                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-globe sidemenu_icon"></i>
                    <span class="side-menu__label">مدیریت درخواست ها</span><i class="angle fa fa-angle-left"></i>
                </a>
                <ul class="slide-menu">
                    <li><a href="{{ route(('admin.consultation-requests.index') ) }}" class="slide-item">درخواست های مشاوره</a></li>
                    <li><a href="{{ route(('admin.cooperation-requests.index') ) }}" class="slide-item">درخواست های همکاری</a></li>
                </ul>
            </li>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="feather feather-globe sidemenu_icon"></i>
                        <span class="side-menu__label">مدیریت محتوا</span><i class="angle fa fa-angle-left"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('admin.student-povs.index') }}" class="slide-item">نظر هنرجویان</a></li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{route('admin.settings.index')}}">
                        <i class="fa fa-cog sidemenu_icon"></i>
                        <span class="side-menu__label">مدیریت تنظیمات</span>
                    </a>
                </li>


            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="feather feather-power ml-3 fs-16 my-auto"></i>
                    <span class="side-menu__label">خروج</span>
                </a>
            </li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</aside>
