@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.style.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>
        .bold-weight{
            font-weight : bold;
        }
    </style>
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">پروفایل</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')
    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12" >
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="border-0">
                        <form action="{{ route('admin.profile', [$admin->id]) }}" method="post" class="save"
                              id="userForm">
                            @csrf
                            @method('PUT')

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="name"  class="control-label">نام و نام خانوادگی</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control" id="name" placeholder="لطفا نام و نام خانوادگی را وارد کنید" name="name" value="{{ old('name', $admin->name) }}" type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">

                                                                <div class="form-group">
                                                                    <label for="mobile"  class="control-label">موبایل</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control" id="mobile" placeholder="لطفا موبایل را وارد کنید" value="{{ old('mobile', $admin->mobile) }}" name="mobile" type="tel" pattern="(^09\d{9}$)" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="email"  class="control-label">ایمیل</label>
                                                                    {{--                                                            <span class="text-danger">&starf;</span>--}}
                                                                    <input class="form-control" id="email" placeholder="لطفا ایمیل را وارد کنید" name="email" type="text" value="{{ old('email', $admin->email) }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="title"  class="control-label">کلمه عبور</label>
                                                                    <input class="form-control mb-4" placeholder="لطفا کلمه عبور خود را وارد کنید" name="password" id="password" type="password">
                                                                    <span class="text-muted-dark">در صورتی که کلمه عبور را خالی رها کنید همان کلمه عبور قبلی حفظ خواهد شد.</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="password_confirmation"  class="control-label">تکرار کلمه عبور</label>
                                                                    <input class="form-control mb-4" placeholder="لطفا کلمه عبور خود را تکرار کنید" name="password_confirmation" id="password_confirmation" type="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <span id='message'></span>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-warning" type="submit">به روزرسانی</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Row -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')
    <script src="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script type="text/javascript">
        var $birthDay = new Date({{request('birthday')}});

        $('#birthday_show').MdPersianDateTimePicker({
            targetDateSelector: '#birthday',
            targetTextSelector: '#birthday_show',
            englishNumber: false,
            fromDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });

        //add summernote
        $(function(e) {
            $('.summernote').summernote({
                placeholder: "متن را اینجا وارد کنید...",
                tabsize: 3,
                height: 300
            });
        });
        //select2
        $(document).ready(function () {
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                tags: true
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder:'دسته بندی (ها) را انتخاب کنید',
                closeOnSelect:false,
            });
        });

        function resetForm() {
            let $date = document.getElementById("birthday_show").value;
            document.getElementById("userForm").reset();
            document.getElementById("birthday_show").value = $date;
        }

    </script>

    <script>
        $('#password, #password_confirmation').on('keyup', function () {

            if ($('#password').val() == $('#password_confirmation').val()) {
                $('#message').html('کلمه عبور یکسان است').css('color', 'green');
            } else
                $('#message').html('کلمه عبور یکسان نیست').css('color', 'red');
        });
    </script>
@endsection
