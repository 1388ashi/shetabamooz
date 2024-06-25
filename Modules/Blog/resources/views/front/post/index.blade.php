@extends('layouts.front.master')

@section('metas')
    @if(\Modules\Setting\App\Models\Setting::getFromName('post_list_meta_robots'))
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if(\Modules\Setting\App\Models\Setting::getFromName('post_list_meta_canonical'))
        <link rel="canonical" href="{{ \Modules\Setting\App\Models\Setting::getFromName('post_list_meta_canonical') }}" />
    @endif
@endsection

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
                    <h1 class="text-white">مقالات های شتاب آموز</h1>
                    <!-- Breadcrumb -->
                    <div class="d-flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dark breadcrumb-dots mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">صفحه اصلی</a></li>
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
Page content START -->
    <section class="position-relative pt-0 pt-lg-5">
        <div class="container">
            <div class="row g-4">
                @foreach($posts as $post)
                    <!-- Card item START -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card bg-transparent">
                            <div class="overflow-hidden rounded-3">
                                <img
                                    src="{{ $post->image }}"
                                    class="card-img"
                                    alt="{{ $post->image_alt }}"
                                />
                                <!-- Overlay -->
                                <div class="bg-overlay bg-dark opacity-4"></div>
                                <div class="card-img-overlay d-flex align-items-start p-3">
                                    <!-- badge -->
                                    @foreach($post->categories as $category)
                                        <a href="{{ route('posts.index') }}" class="badge text-bg-primary">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Title -->
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a>
                                </h5>
                                <p class="text-truncate-2">
                                    {{ $post->short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card item END -->
                @endforeach
            </div>
            <!-- Row end -->
            {{ $posts->links() }}
        </div>
    </section>
    <!-- =======================
Page content END -->
</main>
@endsection
