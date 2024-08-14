@extends('layouts.front.master')


@section('metas')
    @if($post->meta_title)
        <title>{{ $post->meta_title }}</title>
    @endif

    @if($post->meta_description)
        <meta name="description" content="{{ $post->meta_description }}">
    @endif

    @if($post->meta_robots)
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if($post->canonical_tag)
        <link rel="canonical" href="{{ $post->canonical_tag }}" />
    @endif
@endsection
@section('title', "نمایش بلاگ $post->title ")
@section('contact')
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
                    <h1 class="text-white">{{$post->title}}</h1>
                    <!-- Breadcrumb -->
                    <div class="d-flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    مقالات
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
Main Content START -->
    <section class="pb-0 pt-4 pb-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Title and Info START -->
                    <div class="row">
                        <!-- Avatar and Share -->

                        <!-- Content -->
                        <div class="col-lg-12 order-1">
                            <!-- Pre title -->
                            <span>{{ verta($post->created_at)->formatDifference() }}</span><span class="mx-2">|</span>
                            @foreach($post->categories as $category)
                                <div class="badge text-bg-primary">{{ $category->name }}</div>
                            @endforeach
                            <!-- Title -->
                        </div>
                    </div>
                    <!-- Title and Info END -->

                    <!-- Video START -->
                    <div class="row mt-4">
                        <div class="col-xl-10 mx-auto">
                            <!-- Card item START -->
                            <div
                                class="card overflow-hidden h-200px h-sm-300px h-lg-400px h-xl-500px rounded-3 text-center"
                                style="
                      background-image: url({{ $post->image }});
                      background-position: center left;
                      background-size: cover;
                    "
                            >
                                <!-- Card Image overlay -->
                                <div class="bg-overlay bg-dark opacity-4"></div>
                                <div
                                    class="card-img-overlay d-flex align-items-center p-2 p-sm-4"
                                >
                                    <div class="w-100 my-auto">
                                        <div class="row justify-content-center">
                                            <!-- Video -->
                                            <div class="col-12">
{{--                                                <a--}}
{{--                                                    href="https://www.youtube.com/embed/tXHviS-4ygo"--}}
{{--                                                    class="btn btn-lg text-danger btn-round btn-white-shadow stretched-link position-static mb-0"--}}
{{--                                                    data-glightbox=""--}}
{{--                                                    data-gallery="video-tour"--}}
{{--                                                >--}}
{{--                                                    <i class="fas fa-play"></i>--}}
{{--                                                </a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card item END -->
                        </div>
                    </div>
                    <!-- Video END -->

                    <!-- Quote and content START -->
                    <div class="row mt-4">
                        <!-- Content -->
                        <div class="col-12 mt-4 mt-lg-0">
                            <p>
                                {!! $post->description !!}
                            </p>
                        </div>
                    </div>
                    <!-- Quote and content END -->

                    <!-- Tags and share START -->
{{--                    <div class="d-lg-flex justify-content-lg-between mb-4">--}}
{{--                        <!-- Social media button -->--}}
{{--                        <div class="align-items-center mb-3 mb-lg-0">--}}
{{--                            <h6 class="mb-2 me-4 d-inline-block">اشتراک گزاری:</h6>--}}
{{--                            <ul class="list-inline mb-0 mb-2 mb-sm-0">--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a class="btn px-2 btn-sm bg-facebook" href="#"--}}
{{--                                    ><i class="fab fa-fw fa-facebook-f"></i--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a class="btn px-2 btn-sm bg-instagram-gradient" href="#"--}}
{{--                                    ><i class="fab fa-fw fa-instagram"></i--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a class="btn px-2 btn-sm bg-twitter" href="#"--}}
{{--                                    ><i class="fab fa-fw fa-twitter"></i--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a class="btn px-2 btn-sm bg-linkedin" href="#"--}}
{{--                                    ><i class="fab fa-fw fa-linkedin-in"></i--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <!-- Popular tags -->--}}
{{--                    </div>--}}
                    <!-- Tags and share END -->

                    <hr />
                    <!-- Divider -->

                    <!-- Comment review and form START -->
                    <div class="row mt-4">
                        <!-- Comment START -->
                        <div class="col-md-7">
                            <h3>{{ $comments->count() }} نظر</h3>
                            <!-- Comment level 1-->
                            @forelse($comments as $comment)
                                <div class="my-4 d-flex">
{{--                                    <img--}}
{{--                                        class="avatar avatar-md rounded-circle me-3"--}}
{{--                                        src="{{ $comment->user->image }}"--}}
{{--                                        alt="avatar"--}}
{{--                                    />--}}
                                    <div>
                                        <div class="mb-2">
                                            <h5 class="m-0">{{ $comment->name }}</h5>
                                            <span class="me-3 small">{{ verta($comment->created_at)->formatDifference() }}</span>
                                        </div>
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>نظری برای این پست ثبت نشده است</p>
                            @endforelse
                            <!-- Comment children level 2 -->
{{--                            <div class="my-4 d-flex ps-2 ps-md-4">--}}
{{--                                <img--}}
{{--                                    class="avatar avatar-md rounded-circle me-3"--}}
{{--                                    src="assets/images/avatar/02.jpg"--}}
{{--                                    alt="avatar"--}}
{{--                                />--}}
{{--                                <div>--}}
{{--                                    <div class="mb-2">--}}
{{--                                        <h5 class="m-0">ادمین</h5>--}}
{{--                                        <span class="me-3 small">22 بهمن 1402</span>--}}
{{--                                    </div>--}}
{{--                                    <p>خواهش میکنم از نظر شما</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                        <!-- Comment END -->

                        <!-- Form START -->
                        <div class="col-md-5">
                            <!-- Title -->
                            <h3 class="mt-3 mt-sm-0"></h3>
                            <small>نظر شما در مورد این پست</small>

                            <form class="row g-3 mt-2 mb-5">
                                <!-- Name -->
                                <div class="col-lg-6">
                                    <label class="form-label">نام و نام خانوادگی</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        aria-label="First name"
                                    />
                                </div>
                                <!-- Email -->
                                <div class="col-lg-6">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control" />
                                </div>
                                <!-- Comment -->
                                <div class="col-12">
                                    <label class="form-label">نظر شما</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                <!-- Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mb-0">
                                        ارسال نظر
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Form END -->
                    </div>
                    <!-- Comment review and form END -->
                </div>
            </div>
            <!-- Row END -->
        </div>
    </section>
    <!-- =======================
Main Content END -->

    <!-- =======================
Related blog START -->
    <section class="pt-0">
        <div class="container">
            <!-- Title -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="mb-0">مطالب مرتبط</h2>
                </div>
            </div>

            <!-- Slider START -->
            <div class="tiny-slider arrow-round arrow-hover arrow-dark">
                <div
                    class="tiny-slider-inner"
                    data-autoplay="false"
                    data-arrow="true"
                    data-edge="2"
                    data-dots="false"
                    data-items="3"
                    data-items-lg="2"
                    data-items-sm="1"
                >
                    @foreach($related_posts as $related_posts)
                        <!-- Slider item -->
                        <div class="card bg-transparent">
                            <div class="row g-0">
                                <!-- Image -->
                                <div class="col-md-4">
                                    <img
                                        src="{{ $related_posts->image }}"
                                        class="img-fluid rounded-start"
                                        alt="{{ $related_posts->image_alt }}"
                                    />
                                </div>
                                <!-- Card body -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <!-- Title -->
                                        <h6 class="card-title">
                                            <a href="{{ route('weblogs.show',[$related_posts->slug]) }}">{{ $related_posts->title }}</a>
                                        </h6>
                                        <span class="small">{{ verta($related_posts->created_at)->formatDifference() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Slider END -->
        </div>
    </section>
    <!-- =======================
Related blog END -->
</main>
@endsection
