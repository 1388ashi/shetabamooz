@extends('layouts.front.master')


@section('metas')
    @if(\Modules\Setting\App\Models\Setting::getFromName('course_list_meta_title'))
        <title>{{ \Modules\Setting\App\Models\Setting::getFromName('course_list_meta_title') }}</title>
    @endif

    @if(\Modules\Setting\App\Models\Setting::getFromName('course_list_meta_description'))
        <meta name="description" content="{{ \Modules\Setting\App\Models\Setting::getFromName('course_list_meta_description') }}">
    @endif

    @if(\Modules\Setting\App\Models\Setting::getFromName('course_list_meta_robots'))
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if(\Modules\Setting\App\Models\Setting::getFromName('course_list_meta_canonical'))
        <link rel="canonical" href="{{ \Modules\Setting\App\Models\Setting::getFromName('course_list_meta_canonical') }}" />
    @endif
@endsection

@section('title', 'لیست اخرین دوره ها')
@section('contact')
<style>
    @media only screen and (max-width: 600px) {
    .card-title {
        font-size: 16px;
    }
    .list-inline-item {
        font-size: 13px;
    }
    .cat-title {
        font-size: 10px;
    }
    .card-body {
        padding-right: 9px;
    }
}
</style>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
  Page Banner START -->
        <section
            class="bg-dark align-items-center d-flex"
            style="
          background: url({{ asset('front/assets/images/pattern/04.png') }}) no-repeat center center;
          background-size: cover;
        "
        >
            <!-- Main banner background image -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Title -->
                        <h1 class="text-white">دوره های شتاب آموز</h1>
                        <!-- Breadcrumb -->
                        <div class="d-flex">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">صفحه اصلی</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        دوره ها
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
  Page Banner END -->

        <!-- =======================
  Page content START -->
        <section class="pb-0 py-sm-5">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <!-- Main content START -->
                    <div class="col-xl-12 col-xxl-12">
                        <!-- Course list START -->
                        <div class="row g-4">
                            @foreach($courses as $course)
                                <!-- Card list START -->
                                <div class="col-6">
                                    <div class="card shadow overflow-hidden p-2 pb-0">
                                        <div class="row g-0">
                                            <div class="col-md-5 overflow-hidden">
                                                <a    href="{{ route('courses.show',[$course->slug]) }}">

                                                    <img
                                                    src="{{ $course->image }}"
                                                    class="rounded-2"
                                                    alt="Card image"
                                                    />
                                                </a>
                                                <!-- Ribbon -->
                                                {{-- <div class="card-img-overlay">
                                                    <div class="ribbon"><span>رایگان</span></div>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body pb-0">
                                                    <!-- Badge and rating -->
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-2"
                                                    >
                                                        <!-- Badge -->
                                                        <a
                                                            href="{{ route('courses.show',[$course->slug]) }}"
                                                            class="badge text-bg-primary mb-2 mb-sm-0 cat-title"
                                                        >{{ $course->category->name }}</a
                                                        >
                                                    </div>

                                                    <!-- Title -->
                                                    <h5 class="card-title">
                                                        <a href="{{ route('courses.show',[$course->slug]) }}">{{ $course->title }}</a>
                                                    </h5>
                                                    <p class="text-truncate-2 d-none d-lg-block">
                                                        پیش از شروع آموزش و گذارندن دوره آموزش حضوری زبان پی
                                                        اچ پی بهتر است کمی با این زبان بیشتر آشنا شویم . پی
                                                    </p>

                                                    <!-- Info -->
                                                    <ul class="list-inline">
                                                        <li
                                                            class="list-inline-item h6 fw-light mb-1 mb-sm-0"
                                                        >
                                                            <i class="far fa-clock text-danger me-2"></i>{{ $course->time }}
                                                            ساعت
                                                        </li>
                                                        <li
                                                            class="list-inline-item h6 fw-light mb-1 mb-sm-0"
                                                        >
                                                            <i class="fas fa-table text-orange me-2"></i>{{ $course->sections }}
                                                            جلسه
                                                        </li>
                                                        <li class="list-inline-item h6 fw-light">
                                                            <i class="fas fa-signal text-success me-2"></i
                                                            >{{ \Modules\Course\App\Models\Course::getLevelLabelAttribute($course->level) }}
                                                        </li>
                                                    </ul>
                                                    <!-- Price and avatar -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card list END -->
                            @endforeach
                        </div>
                        <!-- Course list END -->
                        {{ $courses->links() }}
                    </div>
                    <!-- Main content END -->
                </div>
                <!-- Row END -->
            </div>
        </section>
        <!-- =======================
  Page content END -->

        <!-- =======================
  Newsletter START -->
        <section class="pt-5 pt-lg-0">
            <div class="container position-relative overflow-hidden">
                <!-- SVG decoration -->
                <figure
                    class="position-absolute top-50 start-50 translate-middle ms-3"
                >
                    <svg>
                        <path
                            class="fill-white opacity-3"
                            d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z"
                        />
                        <path
                            class="fill-white opacity-3"
                            d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z"
                        />
                        <path
                            class="fill-white opacity-3"
                            d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z"
                        />
                        <path
                            class="fill-white opacity-3"
                            d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z"
                        />
                    </svg>
                </figure>
                <!-- Svg decoration -->
                <figure
                    class="position-absolute bottom-0 end-0 mb-5 d-none d-sm-block"
                >
                    <svg
                        class="rotate-130"
                        width="258.7px"
                        height="86.9px"
                        viewBox="0 0 258.7 86.9"
                    >
                        <path
                            stroke="white"
                            fill="none"
                            stroke-width="2"
                            d="M0,7.2c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5"
                        />
                        <path
                            stroke="white"
                            fill="none"
                            stroke-width="2"
                            d="M0,57c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5 c16,0,16,25.5,31.9,25.5c16,0,16-25.5,31.9-25.5c16,0,16,25.5,31.9,25.5s16-25.5,31.9-25.5"
                        />
                    </svg>
                </figure>

{{--                <div class="bg-grad p-3 p-sm-5 rounded-3">--}}
{{--                    <div class="row justify-content-center position-relative">--}}
{{--                        <!-- SVG decoration -->--}}
{{--                        <figure--}}
{{--                            class="fill-white opacity-1 position-absolute top-50 start-0 translate-middle-y"--}}
{{--                        >--}}
{{--                            <svg width="141px" height="141px">--}}
{{--                                <path--}}
{{--                                    d="M140.520,70.258 C140.520,109.064 109.062,140.519 70.258,140.519 C31.454,140.519 -0.004,109.064 -0.004,70.258 C-0.004,31.455 31.454,-0.003 70.258,-0.003 C109.062,-0.003 140.520,31.455 140.520,70.258 Z"--}}
{{--                                />--}}
{{--                            </svg>--}}
{{--                        </figure>--}}
{{--                        <!-- Newsletter -->--}}
{{--                        <div class="col-12 position-relative my-2 my-sm-3">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <!-- Title -->--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <h3 class="text-white mb-3 mb-lg-0">--}}
{{--                                        اگر جهت شرکت در دوره های برنامه نویسی نیاز به مشاوره دارین--}}
{{--                                        ثبت نام کنین--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                                <!-- Input item -->--}}
{{--                                <div class="col-lg-6 text-lg-end">--}}
{{--                                    <form class="bg-body rounded p-2">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input--}}
{{--                                                class="form-control border-0 me-1"--}}
{{--                                                type="email"--}}
{{--                                                placeholder="شماره خود را وارد کنین"--}}
{{--                                            />--}}
{{--                                            <button type="button" class="btn btn-dark mb-0 rounded">--}}
{{--                                                عضویت--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Row END -->--}}
{{--                </div>--}}
            </div>
        </section>
        <!-- =======================
  Newsletter END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->


@endsection
