@extends('layouts.front.master')
@section('metas')
    @if($course->meta_title)
        <title>{{ $course->meta_title }}</title>
    @endif

    @if($course->meta_description)
        <meta name="description" content="{{ $course->meta_description }}">
    @endif

    @if($course->meta_robots)
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if($course->canonical_tag)
        <link rel="canonical" href="{{ $course->canonical_tag }}" />
    @endif
@endsection

@section('contact')
    <main>
        <!-- =======================
  Page intro START -->
        <section class="bg-light py-0 py-sm-5">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-8">
                        <!-- Badge -->
                        <h6
                            class="mb-3 font-base bg-primary text-white py-2 px-4 rounded-2 d-inline-block"
                        >
                            {{ $course->category->name }}
                        </h6>
                        <!-- Title -->
                        <h1>{{ $course->title }}</h1>
                        <p>
                            {{ $course->short_description }}
                        </p>
                        <!-- Content -->
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0">
                                <i class="far fa-clock text-danger me-2"></i>{{ $course->time }} ساعت
                            </li>
                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0">
                                <i class="fas fa-table text-orange me-2"></i>{{ $course->sections }} جلسه
                            </li>
                            <li class="list-inline-item h6 fw-light">
                                <i class="fas fa-signal text-success me-2"></i>{{ \Modules\Course\App\Models\Course::getLevelLabelAttribute($course->level) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
  Page intro END -->

        <!-- =======================
  Page content START -->
        <section class="pb-0 py-lg-5">
            <div class="container">
                <div class="row">
                    <!-- Main content START -->
                    <div class="col-lg-8">
                        <div class="card shadow rounded-2 p-0">
                            <!-- Tabs START -->
                            <div class="card-header border-bottom px-4 py-3">
                                <ul
                                    class="nav nav-pills nav-tabs-line py-0"
                                    id="course-pills-tab"
                                    role="tablist"
                                >
                                    <!-- Tab item -->
                                    <li class="nav-item me-2 me-sm-4" role="presentation">
                                        <button
                                            class="nav-link mb-2 mb-md-0 active"
                                            id="course-pills-tab-1"
                                            data-bs-toggle="pill"
                                            data-bs-target="#course-pills-1"
                                            type="button"
                                            role="tab"
                                            aria-controls="course-pills-1"
                                            aria-selected="true"
                                        >
                                            توضیحات دوره
                                        </button>
                                    </li>
                                    <li class="nav-item me-2 me-sm-4" role="presentation">
                                        <button
                                          class="nav-link mb-2 mb-md-0"
                                          id="course-pills-tab-2"
                                          data-bs-toggle="pill"
                                          data-bs-target="#course-pills-2"
                                          type="button"
                                          role="tab"
                                          aria-controls="course-pills-2"
                                          aria-selected="false"
                                        >
                                          سرفصل ها
                                        </button>
                                      </li>
                                    <!-- Tab item -->
{{--                                    <li class="nav-item me-2 me-sm-4" role="presentation">--}}
{{--                                        <button--}}
{{--                                            class="nav-link mb-2 mb-md-0"--}}
{{--                                            id="course-pills-tab-2"--}}
{{--                                            data-bs-toggle="pill"--}}
{{--                                            data-bs-target="#course-pills-2"--}}
{{--                                            type="button"--}}
{{--                                            role="tab"--}}
{{--                                            aria-controls="course-pills-2"--}}
{{--                                            aria-selected="false"--}}
{{--                                        >--}}
{{--                                            سرفصل ها--}}
{{--                                        </button>--}}
{{--                                    </li>--}}
                                    <!-- Tab item -->
                                    <li class="nav-item me-2 me-sm-4" role="presentation">
                                        <button
                                            class="nav-link mb-2 mb-md-0"
                                            id="course-pills-tab-3"
                                            data-bs-toggle="pill"
                                            data-bs-target="#course-pills-3"
                                            type="button"
                                            role="tab"
                                            aria-controls="course-pills-3"
                                            aria-selected="false"
                                        >
                                            مدرس
                                        </button>
                                    </li>
                                    <!-- Tab item -->
                                    <li class="nav-item me-2 me-sm-4" role="presentation">
                                        <button
                                            class="nav-link mb-2 mb-md-0"
                                            id="course-pills-tab-4"
                                            data-bs-toggle="pill"
                                            data-bs-target="#course-pills-4"
                                            type="button"
                                            role="tab"
                                            aria-controls="course-pills-4"
                                            aria-selected="false"
                                        >
                                            نظرات
                                        </button>
                                    </li>
                                    <!-- Tab item -->
                                    <li class="nav-item me-2 me-sm-4" role="presentation">
                                        <button
                                            class="nav-link mb-2 mb-md-0"
                                            id="course-pills-tab-5"
                                            data-bs-toggle="pill"
                                            data-bs-target="#course-pills-5"
                                            type="button"
                                            role="tab"
                                            aria-controls="course-pills-5"
                                            aria-selected="false"
                                        >
                                            سوالات متداول
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tabs END -->

                            <!-- Tab contents START -->
                            <div class="card-body p-4">
                                <div class="tab-content pt-2" id="course-pills-tabContent">
                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade show active"
                                        id="course-pills-1"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-1"
                                    >
                                        <!-- Course detail START -->
                                        <p class="mb-3">
                                            {!! $course->description !!}
                                        </p>


                                        @if($properties)
                                            <!-- List content -->
                                            <h5 class="mt-4">ویژگی های دوره</h5>
                                            <ul class="list-group list-group-borderless mb-3">
                                                @foreach($properties as $value)
                                                    <li class="list-group-item h6 fw-light d-flex mb-0">
                                                        <i class="fas fa-check-circle text-success me-2"></i
                                                        >
                                                        {{ $value }}
                                                    </li>

                                                @endforeach
                                            </ul>
                                        @endif

                                        <!-- Course detail END -->
                                    </div>
                                    <!-- Content END -->

                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade"
                                        id="course-pills-2"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-2"
                                    >
                                        <!-- Course accordion START -->
                                        <div
                                            class="accordion accordion-icon accordion-bg-light"
                                            id="accordionExample2"
                                        >
                                            <!-- Item -->
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base" id="heading-1">
                                                    <button
                                                        class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-1"
                                                        aria-expanded="true"
                                                        aria-controls="collapse-1"
                                                    >
                                                        جلسه اول
                                                        <span class="small ms-0 ms-sm-2">(3 بخش)</span>
                                                    </button>
                                                </h6>
                                                <div
                                                    id="collapse-1"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="heading-1"
                                                    data-bs-parent="#accordionExample2"
                                                >
                                                    <div class="accordion-body mt-3">
                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <span
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    1
                                                                </span>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >مقدمه</span
                                                                >
                                                            </div>
{{--                                                            <p class="mb-0">2m 10s</p>--}}
                                                        </div>

                                                        <hr />
                                                        <!-- Divider -->

                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <a
                                                                    href="#"
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    <i class="fas fa-play me-0"></i>
                                                                </a>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >
                                    معرفی دوره</span
                                                                >
                                                            </div>
                                                            <p class="mb-0 text-truncate">15m 10s</p>
                                                        </div>

                                                        <hr />
                                                        <!-- Divider -->

                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <a
                                                                    href="#"
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    <i class="fas fa-play me-0"></i>
                                                                </a>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >بخش اول معرفی</span
                                                                >
                                                            </div>
                                                            <p class="mb-0">18m 10s</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Item -->
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base" id="heading-2">
                                                    <button
                                                        class="accordion-button fw-bold collapsed rounded d-sm-flex d-inline-block"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-2"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-2"
                                                    >
                                                        جلسه دوم
                                                        <span class="small ms-0 ms-sm-2">(4 بخش)</span>
                                                    </button>
                                                </h6>
                                                <div
                                                    id="collapse-1"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading-1"
                                                    data-bs-parent="#accordionExample2"
                                                >
                                                    <div class="accordion-body mt-3">
                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <a
                                                                    href="#"
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    <i class="fas fa-play me-0"></i>
                                                                </a>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >مقدمه</span
                                                                >
                                                            </div>
                                                            <p class="mb-0">2m 10s</p>
                                                        </div>

                                                        <hr />
                                                        <!-- Divider -->

                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <a
                                                                    href="#"
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    <i class="fas fa-play me-0"></i>
                                                                </a>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >
                                    معرفی دوره</span
                                                                >
                                                            </div>
                                                            <p class="mb-0 text-truncate">15m 10s</p>
                                                        </div>

                                                        <hr />
                                                        <!-- Divider -->

                                                        <!-- Course lecture -->
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <div
                                                                class="position-relative d-flex align-items-center"
                                                            >
                                                                <a
                                                                    href="#"
                                                                    class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"
                                                                >
                                                                    <i class="fas fa-play me-0"></i>
                                                                </a>
                                                                <span
                                                                    class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                                >بخش اول معرفی</span
                                                                >
                                                            </div>
                                                            <p class="mb-0">18m 10s</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Course accordion END -->
                                    </div>
                                    <!-- Content END -->
                                    <!-- Content START -->
                                    <div
                                    class="tab-pane fade"
                                    id="course-pills-2"
                                    role="tabpanel"
                                    aria-labelledby="course-pills-tab-2"
                                    >
                                    <!-- Course accordion START -->
                                    <div
                                    class="accordion accordion-icon accordion-bg-light"
                                    id="accordionExample2"
                                    >
                                    <!-- Item -->
                                    @foreach ($headlines as $headline)

                                    <div class="accordion-item mb-3">
                                        <h6 class="accordion-header font-base" id="heading-1">
                                        <button
                                            class="accordion-button fw-bold rounded d-sm-flex d-inline-block collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-1"
                                            aria-expanded="true"
                                            aria-controls="collapse-1"
                                        >
                                            {{$headline->title}}
                                        </button>
                                        </h6>
                                        <div
                                        id="collapse-1"
                                        class="accordion-collapse collapse show"
                                        aria-labelledby="heading-1"
                                        data-bs-parent="#accordionExample2"
                                        >
                                        <div class="accordion-body mt-3">
                                            <!-- Course lecture -->
                                            <div
                                            class="d-flex justify-content-between align-items-center"
                                            >
                                            <div
                                                class="position-relative d-flex align-items-center"
                                            >
                                            <p>{{$headline->description}}</p>
                                                {{-- <span
                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-100px w-sm-200px w-md-400px"
                                                >مقدمه</span
                                                > --}}
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                    </div>
                                    <!-- Content END -->
                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade"
                                        id="course-pills-3"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-3"
                                    >
                                        <!-- Card START -->
                                        <div class="card mb-0 mb-md-4">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-md-5">
                                                    <!-- Image -->
                                                    <img
                                                        src="{{ $course->professor->image }}"
                                                        class="img-fluid rounded-3"
                                                        alt="{{ $course->professor->image }}"
                                                    />
                                                </div>
                                                <div class="col-md-7">
                                                    <!-- Card body -->
                                                    <div class="card-body">
                                                        <!-- Title -->
                                                        <h3 class="card-title mb-0">{{ $course->professor->name }}</h3>
                                                        <p class="mb-2">{{ $course->professor->role }}</p>
                                                        <!-- Social button -->
{{--                                                        <ul class="list-inline mb-3">--}}
{{--                                                            <li class="list-inline-item me-3">--}}
{{--                                                                <a href="#" class="fs-5 text-twitter"--}}
{{--                                                                ><i class="fab fa-twitter-square"></i--}}
{{--                                                                    ></a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="list-inline-item me-3">--}}
{{--                                                                <a href="#" class="fs-5 text-instagram"--}}
{{--                                                                ><i class="fab fa-instagram-square"></i--}}
{{--                                                                    ></a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="list-inline-item me-3">--}}
{{--                                                                <a href="#" class="fs-5 text-facebook"--}}
{{--                                                                ><i class="fab fa-facebook-square"></i--}}
{{--                                                                    ></a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="list-inline-item me-3">--}}
{{--                                                                <a href="#" class="fs-5 text-linkedin"--}}
{{--                                                                ><i class="fab fa-linkedin"></i--}}
{{--                                                                    ></a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="list-inline-item">--}}
{{--                                                                <a href="#" class="fs-5 text-youtube"--}}
{{--                                                                ><i class="fab fa-youtube-square"></i--}}
{{--                                                                    ></a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card END -->

                                        <!-- Instructor info -->
                                        <h5 class="mb-3">معرفی مدرس</h5>
                                        <p class="mb-3">
                                            {{ $course->professor->description }}
                                        </p>

                                        <!-- Email address -->
                                    </div>
                                    <!-- Content END -->

                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade"
                                        id="course-pills-4"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-4"
                                    >


                                        @if($comments->count())
                                            <!-- Review START -->
                                            <div class="row mb-4">
                                                <h5 class="mb-4">نظر هنرجویان</h5>
                                            </div>
                                            <!-- Student review START -->
                                            <div class="row">
                                                <!-- Review item START -->
                                                @foreach($comments as $comment)
                                                    <div class="d-md-flex my-4">
                                                        <!-- Avatar -->
                                                        {{--                                                <div class="avatar avatar-xl me-4 flex-shrink-0">--}}
                                                        {{--                                                    <img--}}
                                                        {{--                                                        class="avatar-img rounded-circle"--}}
                                                        {{--                                                        src="assets/images/avatar/09.jpg"--}}
                                                        {{--                                                        alt="avatar"--}}
                                                        {{--                                                    />--}}
                                                        {{--                                                </div>--}}
                                                        <!-- Text -->
                                                        <div>
                                                            <div
                                                                class="d-sm-flex mt-1 mt-md-0 align-items-center"
                                                            >
                                                                <h5 class="me-3 mb-0">{{ $comment->name }}</h5>
                                                                <!-- Review star -->
                                                            </div>
                                                            <!-- Info -->
                                                            <p class="small mb-2">{{ verta($comment->created_at)->formatDifference() }}</p>
                                                            <p class="mb-2">
                                                                {{ $comment->text }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <hr />
                                            </div>
                                                <!-- Divider -->
                                        @endif


{{--                                            <div class="d-md-flex my-4">--}}
{{--                                                <!-- Avatar -->--}}
{{--                                                <div class="avatar avatar-xl me-4 flex-shrink-0">--}}
{{--                                                    <img--}}
{{--                                                        class="avatar-img rounded-circle"--}}
{{--                                                        src="assets/images/avatar/09.jpg"--}}
{{--                                                        alt="avatar"--}}
{{--                                                    />--}}
{{--                                                </div>--}}
{{--                                                <!-- Text -->--}}
{{--                                                <div>--}}
{{--                                                    <div--}}
{{--                                                        class="d-sm-flex mt-1 mt-md-0 align-items-center"--}}
{{--                                                    >--}}
{{--                                                        <h5 class="me-3 mb-0">{{ $comment->name }}</h5>--}}
{{--                                                        <!-- Review star -->--}}
{{--                                                    </div>--}}
{{--                                                    <!-- Info -->--}}
{{--                                                    <p class="small mb-2">{{ verta($comment->created_at)->formatDifference() }}</p>--}}
{{--                                                    <p class="mb-2">--}}
{{--                                                        {{ $comment->text }}--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <!-- Review item END -->
                                            <!-- Divider -->

                                        <!-- Student review END -->
                                            <br>
                                            <div class="mt-2">
                                                <h5 class="mb-4">ارسال نظر</h5>
                                                <form class="row g-3" action="{{ route('course-comments.store') }}" method="post">
                                                    <!-- Name -->
                                                    @csrf
                                                    <div class="col-md-6 bg-light-input">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            id="inputtext"
                                                            name="name"
                                                            placeholder="نام و نام خانوادگی"
                                                            aria-label="First name"
                                                        />
                                                    </div>

                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <!-- Email -->
                                                    <div class="col-md-6 bg-light-input">
                                                        <input
                                                            type="text"
                                                            name="mobile"
                                                            class="form-control"
                                                            placeholder="شماره تماس"
                                                            id="TEL"
                                                        />
                                                    </div>

                                                    <!-- Message -->
                                                    <div class="col-12 bg-light-input">

                                                <textarea
                                                    class="form-control"
                                                    id="exampleFormControlTextarea1"
                                                    name="text"
                                                    placeholder="متن پیام"
                                                    rows="3"
                                                ></textarea>
                                                    </div>
                                                    <!-- Button -->
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mb-0">
                                                            ارسال نظر
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Leave Review START -->

                                        <!-- Leave Review END -->
                                    </div>
                                    <!-- Content END -->

                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade"
                                        id="course-pills-5"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-5"
                                    >
                                        <!-- Title -->
                                        <h5 class="mb-3">سوالات متداول</h5>
                                        <!-- Accordion START -->
                                        <div
                                            class="accordion accordion-flush"
                                            id="accordionExample"
                                        >
                                            @foreach($faqs as $faq)
                                                <!-- Item -->
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button
                                                            class="accordion-button collapsed"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne"
                                                        >
                              <span class="text-secondary fw-bold me-3"
                              >01</span
                              >
                                                            <span class="h6 mb-0">{{ $faq->question }}</span
                                                            >
                                                        </button>
                                                    </h2>
                                                    <div
                                                        id="collapseOne"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample"
                                                    >
                                                        <div class="accordion-body pt-0">
                                                            {{ $faq->answer }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Accordion END -->
                                    </div>
                                    <!-- Content END -->

                                    <!-- Content START -->
                                    <div
                                        class="tab-pane fade"
                                        id="course-pills-6"
                                        role="tabpanel"
                                        aria-labelledby="course-pills-tab-6"
                                    >
                                        <!-- Review START -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="mb-4">Ask Your Question</h5>

                                                <!-- Comment box -->
                                                <div class="d-flex mb-4">
                                                    <!-- Avatar -->
                                                    <div class="avatar avatar-sm flex-shrink-0 me-2">
                                                        <a href="#">
                                                            <img
                                                                class="avatar-img rounded-circle"
                                                                src="assets/images/avatar/09.jpg"
                                                                alt=""
                                                            />
                                                        </a>
                                                    </div>

                                                    <form class="w-100 d-flex">
                              <textarea
                                  class="one form-control pe-4 bg-light"
                                  id="autoheighttextarea"
                                  rows="1"
                                  placeholder="Add a comment..."
                              ></textarea>
                                                        <button
                                                            class="btn btn-primary ms-2 mb-0"
                                                            type="button"
                                                        >
                                                            Post
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Comment item END -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Content END -->
                                </div>
                            </div>
                            <!-- Tab contents END -->
                        </div>
                    </div>
                    <!-- Main content END -->

                    <!-- Right sidebar START -->
                    <div class="col-lg-4 pt-5 pt-lg-0">
                        <div class="row mb-5 mb-lg-0">
                            <div class="col-md-6 col-lg-12">
                                <!-- Video START -->
                                <div class="card shadow p-2 mb-4 z-index-9">
                                    <div class="overflow-hidden rounded-3">
                                        <img
                                            src="{{ $course->image }}"
                                            class="card-img"
                                            alt="{{ $course->image_alt }}"
                                        />
                                        <!-- Overlay -->
                                        <div class="bg-overlay bg-dark opacity-0"></div>
                                        <div
                                            class="card-img-overlay d-flex align-items-start flex-column p-3"
                                        >
                                            <!-- Video button and link -->
                                            <div class="m-auto">
{{--                                                <a--}}
{{--                                                    href="https://www.youtube.com/embed/tXHviS-4ygo"--}}
{{--                                                    class="btn btn-lg text-danger btn-round btn-white-shadow mb-0"--}}
{{--                                                    data-glightbox=""--}}
{{--                                                    data-gallery="course-video"--}}
{{--                                                >--}}
{{--                                                    <i class="fas fa-play"></i>--}}
{{--                                                </a>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card body -->
                                    <div class="card-body px-3">
                                        <!-- Info -->
                                        <div
                                            class="d-flex justify-content-between align-items-center"
                                        >
                                            <!-- Price and time -->
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <h3 class="fw-bold mb-0 me-2">{{ number_format($course->price - $course->discount) }} هزار تومان</h3>
                                                    @if($course->discount)
                                                        <span class="text-decoration-line-through mb-0 me-2"
                                                        >{{ number_format($course->price) }}</span
                                                        >
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Share button with dropdown -->
                                        </div>

                                        <!-- Buttons -->
                                        <div class="mt-3 d-sm-flex justify-content-sm-between">
                                            <a href="{{ route('course-registers.index',['course_id' => $course->id]) }}" class="btn btn-success mb-0">ثبت نام</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Video END -->

                                <!-- Course info START -->
                                <div class="card card-body shadow p-4 mb-4">
                                    <!-- Title -->
                                    <h4 class="mb-3">اطلاعات دوره</h4>
                                    <ul class="list-group list-group-borderless">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                        <span class="h6 fw-light mb-0"
                        ><i class="fas fa-fw fa-book-open text-primary"></i
                            >جلسات</span
                        >
                                            <span>{{ $course->sections }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                        <span class="h6 fw-light mb-0"
                        ><i class="fas fa-fw fa-clock text-primary"></i
                            >ساعت</span
                        >
                                            <span>{{ $course->time }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                        <span class="h6 fw-light mb-0"
                        ><i class="fas fa-fw fa-signal text-primary"></i
                            >سطح</span
                        >
                                            <span>{{ \Modules\Course\App\Models\Course::getLevelLabelAttribute($course->level) }}</span>
                                        </li>

                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center"
                                        >
                        <span class="h6 fw-light mb-0"
                        ><i class="fas fa-fw fa-medal text-primary"></i
                            >مدرک</span
                        >
                                            <span>فنی و حرفه ای</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Course info END -->
                            </div>
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Right sidebar END -->
                </div>
                <!-- Row END -->
            </div>
        </section>
        <!-- =======================
  Page content END -->

        <!-- =======================
  Listed courses START -->
        <section class="pt-0">
            <div class="container">
                <!-- Title -->
                <div class="row mb-4">
                    <h2 class="mb-0">دوره های دیگر</h2>
                </div>

                <div class="row">
                    <!-- Slider START -->
                    <div class="tiny-slider arrow-round arrow-blur arrow-hover">
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
                            <!-- Card Item START -->
                            @foreach($related_courses as $related_course)
                                <div class="pb-4">
                                    <div class="card p-2 border">
                                        <div class="rounded-top overflow-hidden">
                                            <div class="card-overlay-hover">
                                                <img
                                                    src="{{ $related_course->image }}"
                                                    class="card-img-top"
                                                    alt="{{ $related_course->image_alt }}"
                                                />
                                            </div>
                                            <!-- Hover element -->
                                            <div class="card-img-overlay">
                                                <div
                                                    class="card-element-hover d-flex justify-content-end"
                                                >
                                                    <a
                                                        href="{{ route('courses.show',$related_course->id) }}"
                                                        class="icon-md bg-white rounded-circle text-center"
                                                    >
                                                        <i class="fas fa-shopping-cart text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!-- Badge and icon -->
                                            <div class="d-flex justify-content-between"></div>

                                            <!-- Title -->
                                            <h5 class="card-title">
                                                <a href="{{ route('courses.show',$related_course->id) }}">{{ $related_course->title }}</a>
                                            </h5>
                                            <!-- Badge and Price -->
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <a
                                                    href="{{ route('courses.show',$related_course->category->name) }}"
                                                    class="badge bg-info bg-opacity-10 text-info"
                                                ><i class="fas fa-circle small fw-bold me-2"></i
                                                    >{{ $related_course->category->name }}</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Card Item END -->

                        </div>
                    </div>
                    <!-- Slider END -->
                </div>
            </div>
        </section>
        <!-- =======================
  Listed courses END -->
    </main>
@endsection
