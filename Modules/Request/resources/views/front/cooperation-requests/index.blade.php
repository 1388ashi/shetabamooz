@extends('layouts.front.master')

@section('title', "درخواست همکاری")
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
                <div class="col-lg-8 col-xl-8 text-center mx-auto">
                    <!-- Title -->
                    <h2 class="mb-4">درخواست همکاری با شتاب آموز!</h2>
                    <h6 class="text-primary">جهت همکاری به عنوان یکی از مدرسین شتاب آموز رزومه خود را ارسال کنید</h6>
                </div>
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
                    <form  method="post" action="{{ route('cooperation-requests.store') }}">
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
                        <div class="mb-4 bg-light-input">
                            <label for="yourName" class="form-label"
                            >ایمیل *</label
                            >
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                name="email"
                                value="{{ old('email') }}"
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
                            <label for="resume" class="form-label">رزومه*</label>
                            <textarea
                                class="form-control"
                                name="resume"
                                id="resume"
                                rows="4" required
                            >{{ old('resume') }}</textarea>
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
  Form and Tabs END -->
    </main>
@endsection
