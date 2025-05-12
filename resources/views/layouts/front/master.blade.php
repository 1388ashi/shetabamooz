<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta name="google-site-verification" content="Tuswx2bwtXj4JC9zlVK6aN1H0XeqRZo8f6v6667Xu5U" />
    <title>@yield('title')</title>

    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <style>
        .courses-link:after{
            content: "\f107";
            font-family: "Font Awesome 5 Free";
            margin-right: 0.35rem;
            font-weight: 900;
            vertical-align: middle;
            border: none;
        }
    </style>
    @yield('metas')


    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem("theme");

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme;
            }
            return window.matchMedia("(prefers-color-scheme: light)").matches
                ? "light"
                : "light";
        };

        const setTheme = function (theme) {
            if (
                theme === "auto" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                document.documentElement.setAttribute("data-bs-theme", "dark");
            } else {
                document.documentElement.setAttribute("data-bs-theme", theme);
            }
        };

        setTheme(getPreferredTheme());

        window.addEventListener("DOMContentLoaded", () => {
            var el = document.querySelector(".theme-icon-active");
            if (el != "undefined" && el != null) {
                const showActiveTheme = (theme) => {
                    const activeThemeIcon = document.querySelector(
                        ".theme-icon-active use"
                    );
                    const btnToActive = document.querySelector(
                        `[data-bs-theme-value="${theme}"]`
                    );
                    const svgOfActiveBtn = btnToActive
                        .querySelector(".mode-switch use")
                        .getAttribute("href");

                    document
                        .querySelectorAll("[data-bs-theme-value]")
                        .forEach((element) => {
                            element.classList.remove("active");
                        });

                    btnToActive.classList.add("active");
                    activeThemeIcon.setAttribute("href", svgOfActiveBtn);
                };

                window
                    .matchMedia("(prefers-color-scheme: dark)")
                    .addEventListener("change", () => {
                        if (storedTheme !== "light" || storedTheme !== "dark") {
                            setTheme(getPreferredTheme());
                        }
                    });

                showActiveTheme(getPreferredTheme());

                document
                    .querySelectorAll("[data-bs-theme-value]")
                    .forEach((toggle) => {
                        toggle.addEventListener("click", () => {
                            const theme = toggle.getAttribute("data-bs-theme-value");
                            localStorage.setItem("theme", theme);
                            setTheme(theme);
                            showActiveTheme(theme);
                        });
                    });
            }
        });
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"
    />

    <!-- Plugins CSS -->
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('front/assets/css/bootcamp.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('front/assets/vendor/font-awesome/css/all.min.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('front/assets/vendor/tiny-slider/tiny-slider.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('front/assets/vendor/glightbox/css/glightbox.css') }}"
    />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Notifications css -->
    <link href="{{ asset('assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style-rtl.css') }}" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-7N7LGGGWT1"
    ></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-7N7LGGGWT1");
    </script>
   <style>  
    #growls-default {  
        right: 78%;  
    }  
    
    .responsive-gif {  
        width: 100%;  
        height: auto;  
    }  

    @media only screen and (max-width: 768px) { 
        .responsive-gif {  
            height: 5vh;
        }  
        .box-gif-bootcamp{
            display: none;
        }
        .box-gif-bootcamp-mobile{
            display: flex;
        }
    }  
    @media only screen and (min-width: 768px) { 
        .box-gif-bootcamp-mobile{
            display: none;
        }
    }  
</style>
</head>
<body>
    @if(\Modules\Setting\App\Models\Setting::getFromName('banner_bootcamp_desktop'))
        <a class="box-gif-bootcamp" href="{{\Modules\Setting\App\Models\Setting::getFromName('link_banner_bootcamp')}}">
            <img src="{{asset('assets/images/bootcamp.gif')}}" alt="Description of gif" class="responsive-gif"> 
        </a>
    @endif
    
    @if(\Modules\Setting\App\Models\Setting::getFromName('banner_bootcamp_mobile'))
        <a class="box-gif-bootcamp-mobile" href="{{\Modules\Setting\App\Models\Setting::getFromName('link_banner_bootcamp')}}">
            <img src="{{asset('front/bootcamp-mobile-size.gif')}}" alt="Description of gif" class="responsive-gif"> 
        </a>
    @endif
<!-- Header START -->
<header class="navbar-light navbar-sticky header-static">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img
                    class="light-mode-item navbar-brand-item"
                    src="{{ asset('front/assets/images/logo.shetabamooz.png') }}"
                    alt="logo"
                />
                <img
                    class="dark-mode-item navbar-brand-item"
                    src="{{ asset('front/assets/images/logo.shetabamooz.png') }}"
                    alt="logo"
                />
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button
                class="navbar-toggler ms-auto"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-animation">
              <span></span>
              <span></span>
              <span></span>
            </span>
            </button>

            <!-- Main navbar START -->
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse">
                <!-- Nav Main menu START -->
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <!-- Nav item 1 Demos -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">صفحه اصلی</a>
                    </li>

                    <!-- Nav item 2 Pages -->
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link courses-link"
                            href="{{ route('courses.index') }}">
                            آموزش ها</a
                        >
                        <ul class="dropdown-menu" aria-labelledby="pagesMenu">
                            @foreach(\Modules\Course\App\Models\Course::query()->get() as $course)
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.show',[$course->slug]) }}"
                                    >
                                        {{ $course->title }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('weblogs.index') }}">بلاگ</a>
                    </li>
                    <!-- Nav item 4 Component-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">درباره ما</a>
                    </li>

                    <!-- Nav item 4 Component-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('consultation-requests.index') }}">تماس با ما</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('cooperation-requests.index') }}">درخواست همکاری</a>--}}
{{--                    </li>--}}
                </ul>
                <!-- Nav Main menu END -->

                <!-- Nav Search START -->
                <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                    <div class="nav-item w-100">
                        <form class="position-relative" method="get" action="{{route('search')}}">
                            <input
                                class="form-control pe-5 bg-transparent"
                                type="search"
                                placeholder="جستجو"
                                name="keyword"
                                aria-label="Search"
                            />
                            <button
                                class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                type="submit"
                            >
                                <i class="fas fa-search fs-6"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="navbar-nav d-none d-lg-inline-block">
                    <a href="https://panel.shetabamooz.com/student/login" class="btn btn-danger-soft mb-0 d-flex justify-content-center align-items-center">
                      <i class="fas fa-sign-in-alt me-2"></i>ورود هنرجو
                    </a>
                  </div>
                <!-- Nav Search END -->

                <!-- Signout button  -->
{{--                <div class="navbar-nav d-none d-lg-inline-block">--}}
{{--                    <button class="btn btn-danger-soft mb-0">--}}
{{--                        <i class="fas fa-sign-in-alt me-2"></i>ورود | ثبت نام--}}
{{--                    </button>--}}
{{--                </div>--}}
                <!-- Right header content END -->
            </div>
            <!-- Main navbar END -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- Header END -->

@yield('contact')
<!-- =======================
Footer START -->
<footer class="pt-0 bg-blue-footer rounded-4 position-relative mx-2 mx-md-4 mb-3">
    <!-- SVG decoration for curve -->
    <figure class="mb-0">
        <svg
            class="fill-body rotate-180"
            width="100%"
            height="150"
            viewBox="0 0 500 150"
            preserveAspectRatio="none"
        >
            <path d="M0,150 L0,40 Q250,150 500,40 L580,150 Z"></path>
        </svg>
    </figure>

    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-6 mx-auto text-center my-5">
                <!-- Logo -->
                <img
                    class="mx-auto h-100px"
                    src="{{ asset('front/assets/images/Frame 502.png') }}"
                    alt="logo"
                />
                <p class="mt-3 text-white">
                    آکادمی شتاب آموز اولین و بهترین آموزشگاه برنامه نویسی در شهر گرگان بوده که با هدف برگزاری دوره های آموزش برنامه نویسی حضوری سعی در ارائه بهترین محتوای آموزشی با جدیدترین متدهای تدریس و مطابق با بازار کار داشته ، بیش از 1000 هنرجوی فعال و موفق در بازار کار گواهی دست یابی ما به اهدافمان بوده است
                </p>
                <!-- Links -->
                <ul
                    class="nav justify-content-center text-primary-hover mt-3 mt-md-0"
                >
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">صفحه اصلی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('courses.index') }}">دوره ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('weblogs.index') }}">مقالات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('about-us') }}">درباره ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('consultation-requests.index') }}">تماس با ما</a>
                    </li>
             {{--       <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('consultation-requests.index') }}">درخواست همکاری</a>
                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-white" href="#">مشاوره</a>--}}
{{--                    </li>--}}
                </ul>
                <!-- Social media button -->
                <ul class="list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a
                            class="btn btn-white btn-sm shadow px-2 text-instagram"
                            href="https://www.instagram.com/shetab.it/"
                        >
                            <i class="fab fa-fw fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a
                            class="btn btn-white btn-sm shadow px-2 text-linkedin"
                            href="https://www.linkedin.com/company/shetabit-com"
                        >
                            <i class="fab fa-fw fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <!-- Bottom footer link -->
                <div class="mt-3 text-white">
                    Copyrights ©2024 shetabamooz. Build by
                    <a
                        href="https://www.shetabit.com/"
                        class="text-reset btn-link text-primary-hover"
                        target="_blank"
                    >shetabit</a
                    >
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top">
    <i
        class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"
    ></i>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('front/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Vendors -->
<script src="{{ asset('front/assets/vendor/tiny-slider/tiny-slider-rtl.js') }}"></script>
<script src="{{ asset('front/assets/vendor/glightbox/js/glightbox.js') }}"></script>
<script src="{{ asset('front/assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>

<!-- Jquery js-->
<script src="{{asset('front/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('front/assets/js/image-validation.js')}}"></script>

<!-- Template Functions -->
<script src="{{ asset('front/assets/js/functions.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Notifications js -->
<script src="{{ asset('assets/plugins/notify/js/jquery.growl.js') }}"></script>
<script>
    // Play video when modal is shown
    $('#videoModal').on('shown.bs.modal', function () {
        document.getElementById('videoPlayerModal').play();
    });

    // Pause video when modal is hidden
    $('#videoModal').on('hidden.bs.modal', function () {
        document.getElementById('videoPlayerModal').pause();
    });
</script>
<script>
    document.getElementById("showMore").addEventListener("click", function () {
      var description = document.querySelector(".descriptionStyle");
      description.classList.add("expanded");
      this.style.display = "none";
    });
  </script>
</body>

@include('layouts.front.components.errors')
@include('layouts.front.components.notifications')
</html>
