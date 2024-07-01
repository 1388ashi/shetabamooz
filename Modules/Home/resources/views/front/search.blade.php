@extends('layouts.front.master')
@section('metas')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('styles')
    <style>
        .no-data{
            width: 100%;
            height: 300px;
            display: grid;
            place-items: center;
        }
        @media screen and (max-width:500px) {
            .no-data{
                height: 200px;
            }
            .no-data h2{
                font-size: 16px;
            }
        }
    </style>
@endsection
@section('contact')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
  Page Banner START -->
        <!-- <section
          class="bg-dark align-items-center d-flex"
          style="
            background: url(assets/images/pattern/04.png) no-repeat center center;
            background-size: cover;
          "
        >

          <div class="container">
            <div class="row">
              <div class="col-12">
                <h1 class="text-white">مقالات های شتاب آموز</h1>
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
        </section> -->
        <!-- =======================
  Page Banner END -->

        <!-- =======================
  Page content START -->
        <section class="position-relative  pt-0 pt-lg-5">
            <div class="container">
                <h3 class=" pb-3">
                    دوره ها
                </h3>
                <div class="row g-4">
                    @forelse($courses as $course)
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card bg-transparent">
                                <div class="overflow-hidden rounded-3">
                                    <img
                                        src="{{ $course->image }}"
                                        class="card-img"
                                        alt="course image"
                                    />
                                    <!-- Overlay -->
                                    <div class="bg-overlay bg-dark opacity-4"></div>
                                    <div class="card-img-overlay d-flex align-items-start p-3">
                                        <!-- badge -->
                                        <a href="{{ route('courses.index') }}" class="badge text-bg-primary">مقالات</a>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title">
                                        <a href="{{ route('courses.show',$course->slug) }}">{{ $course->title }}</a>
                                    </h5>
                                    <p class="text-truncate-2">
                                        {{ $course->short_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <section class="no-data" >
                            <h2>
                                هیچ نتیجه ای برای کلمه {{ request()->keyword }} یافت نشد...
                            </h2>
                        </section>
                    @endforelse
                    <!-- Card item START -->
                    <!-- Card item END -->
                </div>
                <!-- Row end -->
            </div>
        </section>
        <section class="position-relative pt-0 pt-lg-5">
            <div class="container">
                <h3 class=" pb-3">
                    مقالات
                </h3>
                <div class="row g-4">
                    @forelse($posts as $post)
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card bg-transparent">
                                <div class="overflow-hidden rounded-3">
                                    <img
                                        src="{{ $post->image }}"
                                        class="card-img"
                                        alt="course image"
                                    />
                                    <!-- Overlay -->
                                    <div class="bg-overlay bg-dark opacity-4"></div>
                                    <div class="card-img-overlay d-flex align-items-start p-3">
                                        <!-- badge -->
                                        <a href="{{ route('weblogs.index') }}" class="badge text-bg-primary">مقالات</a>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title">
                                        <a href="{{ route('weblogs.show',$post->id) }}">{{ $post->title }}</a>
                                    </h5>
                                    <p class="text-truncate-2">
                                        {{ $post->short_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <section class="no-data" >
                            <h2>
                                هیچ نتیجه ای برای کلمه {{ request()->keyword }} یافت نشد...
                            </h2>
                        </section>
                    @endforelse
                </div>
                <!-- Row end -->
            </div>
        </section>

        <!-- =======================
  Page content END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->

@endsection
