@extends('layouts.front.master')
@section('metas')
    @if($bootcamp->meta_title)
        <title>{{ $bootcamp->meta_title }}</title>
    @endif

    @if($bootcamp->meta_description)
        <meta name="description" content="{{ $bootcamp->meta_description }}">
    @endif

    @if($bootcamp->meta_robots)
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if($bootcamp->canonical_tag)
        <link rel="canonical" href="{{ $bootcamp->canonical_tag }}" />
    @endif
@endsection

@section('contact')
<section class="containerFlouidBootcamp bootcamp">
    <!-- Main Banner START -->
    <section id="MainBAnner" class="bg-color-green-30">
      <section class="containerBootcamp">
        <article class="bannerContact ">
          <div class=" contentBanner">
            <h1 class="fs-1 text-color-indigo-main">{{$bootcamp->title}}</h1>
            <p class="font-s-lg fst-normal text-color-indigo-50">
                {{$bootcamp->subtitle}}
            </p>
            <a href="#bottom"><button class="buttonBootCamp fs-6">سرفصل بوت کمپ</button></a>
          </div>
          <div class="sectionImg">
            <figure class="figureimgBanner">
              <img
                class="w-100 imgBanner"
                src="{{ $bootcamp->image['url'] }}"
                alt=""
              />
            </figure>
            <div class="DivForImg bg-color-green"></div>
          </div>
        </article>
        <article class=" descriptionBanner">
          <div class="d-flex text-center  justify-content-center text-nowrap ">
            <div class="px-3 borderleftBanner w-80">
              <p class="text-color-green fw-bold font-s-lg">طول بوت کمپ</p>
              <p class="font-w-900 fontDecrease text-color-indigo-main">
                {{ $bootcamp->time }} ساعت آموزش
              </p>
            </div>
            <div class="px-3 w-80">
              <p class="text-color-green fw-bold font-s-lg">پشتیبانی</p>
              <p class="font-w-900 fontDecrease text-color-indigo-main">
                {{ $bootcamp->support }}
              </p>
            </div>
          </div>

          <div class="teacherBanner">
            @foreach ($professors as $professor)
            <div class="teacher">
                <figure class="">
                    <img  src="{{ $professor->image }}" alt="" />
                </figure>
                <div>
                    <h4 class="fs-6 text-color-indigo-main">
                        مدرس:{{$professor->name}}
                    </h4>
                    <p class="text-color-greenDark">{{$professor->role}}</p>
                </div>
            </div>
            @endforeach
          </div>
        </article>
      </section>
    </section>

    <!-- Description START-->
    <section class="containerBootcamp marginSection">
      <h1 class="text-center my-5 text-color-indigo-main">
        آشنایی با بوت کمپ {{ $bootcamp->title }}
      </h1>
      <p class="descriptionStyle text-color-indigo-20">
        {!! $bootcamp->description !!}
    </p>
      <button id="showMore">
        <div class="styleShowMore">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="30"
            height="30"
            fill="currentColor"
            class="bi bi-arrow-down-circle"
            viewBox="0 0 16 16"
          >
            <path
              fill-rule="evenodd"
              d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"
            />
          </svg>
          <p class="mt-2 fw-bold">نمایش بیشتر</p>
        </div>
      </button>
    </section>

    <!--Headline START -->
    <section id="heading" class="marginSection">
      <section class="containerBootcamp">
        <div
          class="d-flex flex-column align-items-center justify-content-center"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="100"
            height="100"
            fill="#2a3554"
            class="bi bi-youtube"
            viewBox="0 0 16 16"
          >
            <path
              d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"
            />
          </svg>
          <h1 class="text-center my-3 text-color-indigo-main">
            سرفصل‌های بوت کمپ
          </h1>
        </div>

        <div class="d-flex flex-column gap-2 py-5">
            @foreach ($headlines as $headline)
          <details>
            <summary
              class="font-s-lg font-w-600 d-flex justify-content-between align-items-center"
            >
              <div class="d-flex align-items-center gap-2" name="bottom">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="33"
                  height="33"
                  fill="#347733"
                  class="bi bi-list"
                  viewBox="0 0 16 16"
                >
                  <path
                    fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
                  />
                </svg>
                <div class="text-color-indigo-main">{{$headline->title}}</div>
              </div>
              {{-- <div class="coutMeeting text-color-grayLight">
                <div class="font-s-xs text-color-grayLight ">2 جلسه</div>
              </div> --}}
            </summary>

            <article class="">
              <pre class="">
                      <code class="text-wrap">
                          <ul class="headingList">
                            <li>
                                <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600">
                                    <div class="d-flex">
                                        <div class="titleHeader font-w-900 text-nowrap">
                                            {{$headline->description}}:
                                        </div>
                                        {{-- <p class="text-color-indigo-main ">{{$headline->title}}</p> --}}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </code>
                </pre>
            </article>
            </details>
            @endforeach
        </div>
      </section>
    </section>

    <!-- Teacher STRAT -->
    <section id="Teacher " class="containerBootcamp marginSection">
      <div>
        <h1 class="text-center my-5 text-color-indigo-main">
          مدرس و منتورهای بوت کمپ
        </h1>
      </div>
        @foreach ($professors as $professor)
      <div class="box-teacher mt-7">
        <div class="informationTeacher">
          <figure>
            <img src="{{$professor->image}}" alt="" />
          </figure>
          <h2 class="font-s-3xl my-3 text-color-green">{{$professor->name}}</h2>
          <p class="text-color-grayLight font-w-700">
            {{$professor->role}}
          </p>
        </div>

        <div class="d-flex justify-content-center align-items-center p-4">
          <p class="text-color-green font-s-md font-w-600">
            {{$professor->description}}
          </p>
        </div>
      </div>
      @endforeach
    </section>

    <!-- Sign In -->
    <section class="containerFlouidBootcamp bg-color-green-10 marginSection">
      <section class="containerBootcamp">
        <div class="text-center my-5">
          <h1 class="my-4 text-color-indigo-main">اطلاعات تکمیلی</h1>
          <p class="font-s-lg text-color-green">
            سرمایه‌گذاری روی مهارت‌هایتان، یک تصمیم هوشمندانه است!
          </p>
        </div>

        <div class=" signIn">
          <div class="signinInformationRight ">
            <svg
              class="my-3"
              xmlns="http://www.w3.org/2000/svg"
              width="100"
              height="100"
              fill="#347733"
              class="bi bi-pencil-square"
              viewBox="0 0 16 16"
            >
              <path
                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
              />
              <path
                fill-rule="evenodd"
                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
              />
            </svg>

            <h4 class="fs-3 my-3 text-color-green">
              زمان را از دست ندهید
            </h4>
            <p class="font-s-lg text-color-indigo-main font-w-600">
              جامع و پروژه‌محور؛ از پایه تا رسیدن به کسب درآمد
            </p>
            <h4 class="fs-4 mt-5 mb-4 text-color-green">
                {{ $bootcamp->getPrice() }} تومان
            </h4>
            <button class="buttonBootCamp">ثبت نام می کنم</button>
          </div>
          <div class="signinInformationLeft bg-color-green-20">
            <div class="signInMiniCard mb-3">
              <h6 class="text-color-greenDark">بیش از {{ $bootcamp->time }} ساعت</h6>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                fill="#347733"
                class="bi bi-alarm"
                viewBox="0 0 16 16"
              >
                <path
                  d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z"
                />
                <path
                  d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1zm1.038 3.018a6 6 0 0 1 .924 0 6 6 0 1 1-.924 0M0 3.5c0 .753.333 1.429.86 1.887A8.04 8.04 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.04 8.04 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1"
                />
              </svg>
            </div>
            <div class="signInMiniCard mb-3">
              <div>
                <h6 class="text-color-greenDark">{{ $bootcamp->support }}</h6>
                <p class="text-color-indigo-main font-w-600">{{$bootcamp->contacts}}</p>
              </div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                fill="#347733"
                class="bi bi-chat-left"
                viewBox="0 0 16 16"
              >
                <path
                  d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"
                />
              </svg>
            </div>
            <ul class="listInformationSignIn text-color-indigo-main font-w-6

            00 font-s-md ">
            <li>{{$bootcamp->prerequisite}}</li>
            </ul>
          </div>
        </div>
      </section>
    </section>
@endsection
