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
<section class="containerFlouidBootcamp bootcamp pb-0">
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
            <figure class="figureimgBanner d-flex justify-content-center align-items-center">
              <img
                class="w-100 imgBanner"
                src="{{ $bootcamp->image['url'] }}"
                alt=""
              />

            </figure>
            {{-- <a
              data-glightbox
              data-gallery="office-tour"
              href="{{ $bootcamp->video['url'] }}"
              class="btn btn-round btn-primary-shadow mb-0 overflow-visible me-7"
          >
              <i class="fas fa-play"></i>
              <h6 class="mb-0 ms-3 fw-normal position-absolute start-100 top-50 translate-middle-y">
                  مشاهده تیزر
              </h6>
          </a> --}}
            <!-- Button trigger modal -->
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
              <p class="text-color-green fw-bold font-s-lg">شروع بوت کمپ</p>
              <p class="font-w-900 fontDecrease text-color-indigo-main">
                {{ $bootcamp->fromhours }}
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
      <span class="descriptionStyle text-color-indigo-20">
        {!! $bootcamp->description !!}
      </span>
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
      @if (isset($headlines[0]))
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
                سرفصل‌های دوره
              </h1>
            </div>

            <div class="d-flex flex-column gap-2 py-5">
          @foreach ($headlines as $headline)
              <details>
                <summary
                  class="font-s-lg font-w-600 d-flex justify-content-between align-items-center"
                >
                  <div class="d-flex align-items-center gap-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="33"
                      height="33"
                      fill="#004e98"
                      class="bi bi-list"
                      viewBox="0 0 16 16"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
                      />
                    </svg>
                    <div class="text-color-indigo-main1">{{$headline->title}}</div>
                  </div>

                  <div class="coutMeeting text-color-grayLight">
                  </div>
                </summary>

                <article class="">
                  <pre class="">
                          <code class="text-wrap">
                              <ul class="headingList">
                                <li>
                                  <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600">
                                    <div class="d-flex">
                                        <p class="text-color-indigo-main ">{{$headline->description}}</p>
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
      @endif

    <!-- Teacher STRAT -->
    <section id="teacher" class="containerBootcamp marginSection">
        <div>
          <h1 class="text-center my-5 text-color-indigo-main">
            مدرس و منتورهای بوتکمپ
          </h1>
        </div>
        @foreach ($professors as $professor)
        <div class="box-teacher mt-7">
          <div class="informationTeacher">
            <figure style="width: 50%">
              <img src="{{$professor->image}}" alt="" />
            </figure>
            <h2 class="font-s-3xl my-3 text-color-green">{{$professor->name}}</h2>
            <p class="text-color-grayLight font-w-700">
              {{$professor->role}}
            </p>
          </div>

          <div class="d-flex justify-content-center align-items-center p-4 widthTeacher">
            <p class="text-color-green font-s-md font-w-600 ">
              <ul class="listOfTeacher">
                @foreach ($professor->specialties as $speciality)
                <li style="list-style-type: none;text-decoration: none">
                    <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600 ">
                        <div class="d-flex">
                            <div class="titleHeader font-w-900 text-nowrap" style="margin-bottom: 10px">
                                {{ $speciality->description }}
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
              </ul>
            </p>
          </div>
        </div>
        @endforeach
      </section>
<br>
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
              fill="#ff6700"
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
            <p class="font-s-lg text-color-indigo-main font-w-600 mb-4">
              جامع و پروژه‌محور؛ از پایه تا رسیدن به کسب درآمد
            </p>
            @if ($bootcamp->price !== null)
                @if($bootcamp->discount !== null)
                <h6 style="margin-top: 2px;color: gray"><del>قیمت اصلی: {{ $bootcamp->getPrice() }}</del></h6>
                <h5 style="margin-top: 7px" class="text-color-green">قیمت با تخفیف: {{ number_format($bootcamp->getPriceWithDiscount()) }}</h5>
                @else
                <h5 class="fs-4 mt-2 mb-2 text-color-green">قیمت: {{$bootcamp->getPrice() }}</h5>
                @endif
            @else
            <h4 class="fs-4 mt-5 mb-4 text-color-green">رایگان</h4>
            @endif
            <form action="{{ route('users.store') }}" method="post">
                @csrf
            <div class="row mt-3">
            <div class="col-lg-6">
                <label class="form-label">نام و نام خانوادگی *</label>
                <input
                    type="text"
                    class="form-control"
                    aria-label="First name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                />
            </div>
            <input type="hidden" name="bootcamp_id" value="{{ request()->bootcamp_id }}">
            <div class="col-lg-6">
                <label class="form-label">شماره تماس *</label>
                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required/>
            </div>
            <input type="hidden" name="bootcamp_id" value="{{$bootcamp->id}}">
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="buttonBootCamp  mt-3">ثبت نام</button    >
            </div>
            </div>
        </form>
        </div>
          <div class="signinInformationLeft bg-color-green-20">
            <div class="signInMiniCard mb-3">
              <h6 class="text-color-greenDark">بیش از {{ $bootcamp->time }} ساعت</h6>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                fill="#ff6700"
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
                <h6 class="text-color-greenDark">{{$bootcamp->contacts}}</h6>
              </div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                fill="#ff6700"
                class="bi bi-chat-left"
                viewBox="0 0 16 16"
              >
                <path
                  d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"
                />
              </svg>
            </div>
            <ul class="listInformationSignIn text-color-indigo-main2 font-w-6

            00 font-s-md ">
            <li><b>پیش نیاز :{{$bootcamp->prerequisite}}</b></li>
            @if ($bootcamp->support == 1)
            <li><b>پشتیبانی :{{$bootcamp->support}}</b></li>
            @endif
            @if ($bootcamp->catering == 1)
              <li><b>پذیرایی :{{$bootcamp->catering}}</b></li>
            @endif
            @if ($bootcamp->gifts == 1)
              <li><b>جایزه :{{$bootcamp->gifts}}</b></li>
            @endif
            <li><b>مکان برگذاری :{{$bootcamp->eventplace}}</b></li>
            <li><b>نوع بوت کمپ :{{$bootcamp->type}}</b></li>
            </ul>
          </div>
        </div>
      </section>
    </section>
     <!-- contact US -->
     <section class="contactUs containerBootcamp marginSection">

        <div class="widthTwoSection">
          <div class="form-container">
            <h1 class="text-color-indigo-main ">در کنار شما هستیم</h1>
            <div class="fs-5 text-color-green">مشاوره ثبت‌نام در دوره متخصص طراحی وب</div>
            <form class="mt-4" action="{{route('advisors.store')}}" method="POST">
                @csrf
                <div class="form-group" >
                    <label for="name" class="text-nowrap px-2 w-25">نام شما</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="مثال: عرشیا بطیاری">
                </div>
                <div class="form-group">
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="091xxxxxxxx">
                </div>
                <div class="form-group">
                    <label for="goal">هدف شما از یادگیری؟</label>
                   <input class="form-control" name="type" type="text">
                </div>
                <div class=" flex-column w-100 text-center mt-4">
                    <label class="h6 text-color-indigo-main my-3">چه ساعتی با شما تماس بگیریم؟</label><br>
                    <div class="w-100  d-flex justify-content-between mb-4">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="time" id="time1" value="10-12">
                        <label class="form-check-label" for="time1">10 تا 12</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="time" id="time2" value="13-15">
                        <label class="form-check-label" for="time2">13 تا 15</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="time" id="time3" value="15-17">
                        <label class="form-check-label" for="time3">15 تا 17</label>
                    </div>
                    </div>
                </div>
                <button type="submit" class="bg-color-green border-0 py-3 rounded-3 text-white w-100">ثبت درخواست</button>
            </form>
        </div>
        </div>

        <div class="sectionImg widthTwoSection">
            <figure class="figureimgBanner w-100">
              <img
                class=" imgBanner bg-color-green"
                src="{{asset('front/assets/images/bootcamp/lms-course-counseling.png')}}"
                alt=""
              />
            </figure>
            <div class="DivForImgContact bg-color-green-30"></div>

           <div class="d-flex justify-content-center gap-3">
            <div class="buttonBootCamp flex align-items-center ga-3 ">

              <span class="font-s-lg">09119002509</span>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg>
              </span>
            </div>
            <div class="buttonBootCamp p-3"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
              <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
            </svg></div>
            <div class="buttonBootCamp p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg>
            </div>
           </div>

        </div>

      </section>
      @if (isset($faqs[0]))
      <section id="faq" class=" marginSection">
          <section class="containerBootcamp">
            <div
              class="d-flex flex-column align-items-center justify-content-center"
            >
              <h1 class="text-center my-3 text-color-indigo-main">
              سوالات متداول
              </h1>
            </div>

            <div class="d-flex flex-column gap-2 py-5">
              @foreach ($faqs->sortByAsc('id') as $faq)  
              <details>
                <summary
                  class="font-s-lg font-w-600 d-flex justify-content-between align-items-center"
                >
                  <div class="d-flex align-items-center gap-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="33"
                      height="33"
                      fill="#2a3554"
                      class="bi bi-list"
                      viewBox="0 0 16 16"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
                      />
                    </svg>
                    <div class="text-color-indigo-main">{{$faq->question}}</div>
                  </div>

                  <div class="coutMeeting text-color-grayLight">

                  </div>
                </summary>

                <article class="">
                  <pre class="">
                      <code class="text-wrap">
                          <ul class="headingList">
                              <li>
                              <div class="d-flex justify-content-between gap-2 font-s-md font-family font-w-600">

                                  <div class="d-flex">
                                      <p class="text-color-indigo-main ">{{$faq->answer}}</p>
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
      @endif
@endsection
