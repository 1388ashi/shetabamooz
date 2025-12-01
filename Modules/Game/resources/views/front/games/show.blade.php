@extends('layouts.front.master')
@section('metas')
    @if ($game->meta_title)
        <title>{{ $game->meta_title }}</title>
    @endif

    @if ($game->meta_description)
        <meta name="description" content="{{ $game->meta_description }}">
    @endif

    @if ($game->meta_robots)
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if ($game->canonical_tag)
        <link rel="canonical" href="{{ $game->canonical_tag }}" />
    @endif
@endsection

@section('contact')
    <section class="containerFlouidBootcamp bootcamp pb-0">
        <!-- Main Banner START -->
        <section id="MainBAnner" class="bg-color-green-30">
            <section class="containerBootcamp">
                <article class="bannerContact ">
                    <div class=" contentBanner">
                        <h1 class="fs-1 text-color-indigo-main">{{ $game->title }}</h1>
                        <p class="font-s-lg fst-normal text-color-indigo-50">
                            {{ $game->subtitle }}
                        </p>
                        <a href="#bottom"><button class="buttonBootCamp fs-6">ثبت نام در مسابقه</button></a>
                    </div>
                    <div class="sectionImg">
                        <figure class="figureimgBanner d-flex justify-content-center align-items-center">
                            <img class="w-100 imgBanner" src="{{ $game->image['url'] }}" alt="" />

                        </figure>
                        {{-- <a
              data-glightbox
              data-gallery="office-tour"
              href="{{ $game->video['url'] }}"
              class="btn btn-round btn-primary-shadow mb-0 overflow-visible me-7"
          >
              <i class="fas fa-play"></i>
              <h6 class="mb-0 ms-3 fw-normal position-absolute start-100 top-50 translate-middle-y">
                  مشاهده ویدیو
              </h6>
          </a> --}}
                        <!-- Button trigger modal -->
                        <div class="DivForImg bg-color-green"></div>
                    </div>
                </article>
                <article class=" descriptionBanner">
                    <div class="d-flex text-center  justify-content-center text-nowrap ">
                        <div class="px-3 borderleftBanner w-80">
                            <p class="text-color-green fw-bold font-s-lg">شروع مسابقه</p>
                            <p class="font-w-900 fontDecrease text-color-indigo-main">
                                {{ $game->fromhours }}
                            </p>
                        </div>
                        <div class="px-3 w-80">
                            <p class="text-color-green fw-bold font-s-lg text-wrap">ظرفیت مسابقه(باقی مانده)</p>
                            <p class="font-w-900 fontDecrease text-color-indigo-main">
                                {{ $game->count_users }} ({{ $countUsers }}) نفر
                            </p>
                        </div>
                    </div>
                </article>
            </section>
        </section>

        <section class="containerBootcamp marginSection">
            <h1 class="text-center my-5 text-color-indigo-main">
                آشنایی با مسابقه {{ $game->title }}
            </h1>
            <span class="descriptionStyle text-color-indigo-20">
                {!! $game->description !!}
            </span>
            <button id="showMore">
                <div class="styleShowMore">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                    </svg>
                    <p class="mt-2 fw-bold">نمایش بیشتر</p>
                </div>
            </button>
        </section>
        <br>
        @if ($game->gameGifts && count($game->gameGifts) > 0)
        <section class="gifts-section">
            <div class="gifts-title">جوایز مسابقه</div>
            <div class="gifts-list">
                @foreach ($game->gameGifts as $item)
                    @php
                        $rank = $loop->iteration;
                        $colorClass = match ($rank) {
                            1 => 'gold',
                            2 => 'silver',           
                            3 => 'bronze',
                            default => 'normal',
                        };
                    @endphp
                    <div class="gift-card {{ $colorClass }}">
                        <div class="gift-medal {{ $colorClass }}">
                            #{{ $rank }}
                        </div>
                        <div class="gift-content">
                            <div class="gift-title">{{ $item->title }}</div>
                            <div class="gift-prize"><b>{{ $item->gift }}</b></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
        <section id="bottom" class="contactUs containerBootcamp marginSection">
            <div class="widthTwoSection sectionRightBootcamp" id="form-register">
                <div class="form-container">
                    <h1 class="text-color-indigo-main ">زمان را از دست ندهید</h1>
                    <div class="fs-6 text-color-green">جهت اطلاعات بیشتر با این شماره تماس بگیرید:09119002509</div>
                    <form class="mt-4" action="{{ route('game-users.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <div class="form-group">
                            <label for="name" class="text-nowrap">نام شما</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="مثال: عرشیا بطیاری">
                        </div>
                        <div class="form-group">
                            <label for="mobile">شماره موبایل</label>
                            <input type="text" name="mobile" class="form-control" id="mobile"
                                placeholder="091xxxxxxxx">
                        </div>
                        <button type="submit" class="bg-color-green border-0 py-3 rounded-3 text-white w-100">ثبت
                            نام</button>
                    </form>
                </div>
            </div>
            <div class="sectionImg widthTwoSection" id="details">
                <div class="d-flex justify-content-center align-items-center p-4 widthTeacher">
                    <p class="text-color-green font-s-md font-w-600 ">
                    <ul class="listOfTeacher">
                        <li style="list-style-type: none;text-decoration: none">
                            <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600 ">
                                <div class="d-flex">
                                    <div class="titleHeader font-w-900 text-nowrap desc-bootcamp"
                                        style="margin-bottom: 10px">
                                        پیش نیاز :{{ $game->prerequisite }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="list-style-type: none;text-decoration: none">
                            <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600 ">
                                <div class="d-flex">
                                    <div class="titleHeader font-w-900 text-nowrap desc-bootcamp"
                                        style="margin-bottom: 10px">
                                        مکان برگذاری :{{ $game->eventplace }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        @if ($game->catering)
                            <li style="list-style-type: none;text-decoration: none">
                                <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600 ">
                                    <div class="d-flex">
                                        <div class="titleHeader font-w-900 text-nowrap desc-bootcamp"
                                            style="margin-bottom: 10px">
                                            پذیرایی :{{ $game->catering }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                        {{-- @if ($game->gifts)
                <li style="list-style-type: none;text-decoration: none">
                  <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600 ">
                      <div class="d-flex">
                          <div class="titleHeader font-w-900 text-nowrap desc-bootcamp" style="margin-bottom: 10px">
                            جایزه :{{$game->gifts}}
                          </div>
                      </div>
                  </div>
                </li>
                @endif --}}
                    </ul>
                    </p>
                </div>
            </div>
        </section>
    @endsection
