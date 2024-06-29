@extends('layouts.front.master')

@section('metas')
    <meta name="robots" content="noindex, nofollow">
@endsection


@section('contact')
    <main>
        <!-- =======================
  Page Banner START -->
        <section
            class="pt-5 pb-0"
            style="
          background-image: url({{ asset('front/assets/images/element/map.svg') }});
          background-position: center left;
          background-size: cover;
        "
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-6 text-center mx-auto">
                        <!-- Title -->
                        <h6 class="text-primary">تماس با ما</h6>
                        <h1 class="mb-4">ما اینجاییم که کمکتون کنیم!</h1>
                    </div>
                </div>

                <!-- Contact info box -->
                <div class="row g-5 g-md-5 mt-0 mt-lg-5 d-flex justify-content-center ">
                    <!-- Box item -->
                    <div class="col-lg-9 mt-lg-0">
                        <div class="card card-body shadow py-5 text-center h-100">
                            <!-- Title -->
                            <h5 class="mb-3">آدرس ما</h5>
                            <ul class="list-inline mb-0">
                                <!-- Address -->
                                <li class="list-item mb-3 h6 fw-light">
                                    <a href="#">
                                        <i class="fas fa-fw fa-map-marker-alt me-2 mt-1"></i>
                                        گرگان ، ویلاشهر ، رو به رو ویلاشهر 14 ، مجتمع گیتی ، طبقه 4 ، واحد 31
                                    </a>
                                </li>
                                <!-- Phone number -->
                                <li class="list-item mb-3 h6 fw-light">
                                    <a href="#">
                                        <i class="fas fa-fw fa-phone-alt me-2"></i>09119002509
                                    </a>
                                </li>
                                <!-- Email id -->
                                <li class="list-item mb-0 h6 fw-light">
                                    <a href="#">
                                        <i class="far fa-fw fa-envelope me-2"></i
                                        >info@shetabamooz.com
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Box item -->
                    {{-- <div class="col-lg-6 mt-lg-0">
                        <div class="card card-body shadow py-5 text-center h-100">
                            <!-- Title -->
                            <h5 class="mb-3">شبکه های اجتماعی</h5>
                            <ul class="list-inline mb-0 ms-sm-2">
                                <li class="list-inline-item">
                                    <a class="fs-5 me-1 text-instagram" href="#"
                                    ><i class="fab fa-fw fa-instagram"></i
                                        ></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="fs-5 me-1 text-linkedin" href="#"
                                    ><i class="fab fa-fw fa-linkedin-in"></i
                                        ></a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- =======================
  Page Banner END -->

        <!-- =======================
  Image and contact form START -->
        <section>
            <div class="container">
                <div class="row g-4 g-lg-0 align-items-center">
                    <div class="col-md-6 align-items-center text-center">
                        <!-- Image -->
                        <img
                            src="{{ asset('front/assets/images/element/contact.svg') }}"
                            class="h-400px"
                            alt=""
                        />

                        <!-- Social media button -->
                        <div
                            class="d-sm-flex align-items-center justify-content-center mt-2 mt-sm-4"
                        >
                            <h5 class="mb-0">Follow us on:</h5>
                            <ul class="list-inline mb-0 ms-sm-2">
                                <li class="list-inline-item">
                                    <a class="fs-5 me-1 text-instagram" href="#"
                                    ><i class="fab fa-fw fa-instagram"></i
                                        ></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="fs-5 me-1 text-linkedin" href="#"
                                    ><i class="fab fa-fw fa-linkedin-in"></i
                                        ></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact form START -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <h2 class="mt-4 mt-md-0">درخواست مشاوره</h2>
                        <p>برای درخواست مشاوره رایگان همین الان شماره خود را ثبت کنید</p>

                        <form action="{{ route('consultation-requests.store') }}" method="post">
                            @csrf
                            <!-- Name -->
                            <div class="mb-4 bg-light-input">
                                <label for="yourName" class="form-label"
                                >نام و نام خانوادگی *</label
                                >
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="name"
                                    value="{{ old('name') }}"
                                    id="yourName" required
                                />
                            </div>
                            <!-- Number -->
                            <div class="mb-4 bg-light-input">
                                <label for="emailInput" class="form-label"
                                >شماره تماس *</label
                                >
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="mobile"
                                    value="{{ old('mobile') }}"
                                    id="emailInput" required
                                />
                            </div>
                            <!-- Message -->
                            <div class="mb-4 bg-light-input">
                                <label for="textareaBox" class="form-label">متن پیام*</label>
                                <textarea
                                    class="form-control"
                                    name="text"
                                    id="textareaBox"
                                    rows="4" required
                                >{{ old('text') }}</textarea>
                            </div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary mb-0" type="submit">
                                    ارسال درخواست
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Contact form END -->
                </div>
            </div>
        </section>
        <!-- =======================
  Image and contact form END -->

        <!-- =======================
  Map START -->
        <section class="pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <iframe
                            class="w-100 h-400px grayscale rounded"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425878428698!3d40.74076684379132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sGoogle!5e0!3m2!1sen!2sin!4v1586000412513!5m2!1sen!2sin"
                            height="500"
                            style="border: 0"
                            aria-hidden="false"
                            tabindex="0"
                        ></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
  Map END -->
    </main>

@endsection
