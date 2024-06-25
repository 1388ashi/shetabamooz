@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.style.css')}}" />
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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.professors.index') }}">لیست استادها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت استاد جدید</li>
        </ol>
        {{--        <div class="mt-3 mt-lg-0">--}}
        {{--        </div>--}}
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12" >
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="border-0">
                        <form action="{{ route('admin.professors.store') }}" method="post" class="save"
                              id="postForm" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="row">
                                                            <div class="col-xl-12 ">
                                                                <div class="">
                                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label for="name"  class="control-label">نام</label>
                                                                                    <span class="text-danger">&starf;</span>
                                                                                    <input class="form-control mb-4" placeholder="لطفا نام را وارد کنید" name="name" value="{{ old('name') }}" type="text" required>
                                                                                </div>
                                                                            </div>
{{--                                                                            <div class="col">--}}
{{--                                                                                <div class="form-group">--}}
{{--                                                                                    <label for="mobile"  class="control-label">موبایل</label>--}}
{{--                                                                                    <span class="text-danger">&starf;</span>--}}
{{--                                                                                    <input class="form-control mb-4" placeholder="لطفا موبایل را وارد کنید" name="mobile" value="{{old('mobile')}}" type="text" required>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="col">--}}
{{--                                                                                <div class="form-group">--}}
{{--                                                                                    <label for="email"  class="control-label">ایمیل</label>--}}
{{--                                                                                    <input class="form-control mb-4" placeholder="لطفا ایمیل را وارد کنید" name="email" value="{{ old('email') }}" type="text">--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
                                                                        </div>


                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label for="role" class="control-label">نقش</label>
                                                                                    <span class="text-danger">&starf;</span>
                                                                                    <input class="form-control mb-4" placeholder="لطفا نقش را وارد کنید" name="role" value="{{ old('role') }}" type="text" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label for="description" class="control-label">توضیحات</label>
                                                                                    <textarea class="form-control" placeholder="لطفا توضیحات را وارد کنید" name="description" rows="3">{{ old('description') }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label for="image" class="control-label">تصویر</label>
                                                                                    <span class="text-danger">&starf;</span>
                                                                                    <input type="file" name="image" value="{{ old('image') }}"
                                                                                           class="form-control" id="image"
                                                                                           onchange="return imageValidation()"
                                                                                           placeholder="تصویر را اینجا وارد کنید" autofocus>
                                                                                </div>
                                                                                <div id="imagePreview" style="margin: 10px;">
                                                                                    <img src="{{ old('image') }}" height="200px">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label for="status" class="control-label">وضعیت نمایش</label>
                                                                                    <span class="text-danger">&starf;</span>
                                                                                    <label class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                                                        <span class="custom-control-label">فعال</span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mt-8">
                                                                            <div class="col">
                                                                                <div class="text-center">
                                                                                    <button class="btn btn-primary" type="submit">ثبت</button>
                                                                                    <button class="btn btn-danger" onclick="resetForm()" type="button">ریست فرم</button>
                                                                                </div>
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
    <script src="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js')}}" type="text/javascript"></script>
    <script>
        var $birth_date = new Date({{request('birth_date')}});

        $('#birth_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#birth_date',
            targetTextSelector: '#birth_date_show',
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
            document.getElementById("postForm").reset();
        }


        {{--$(document).ready(function() {--}}
        {{--    var provinces = {!! json_encode($provinces) !!}--}}
        {{--    console.log(provinces)--}}
        {{--    var cities = {!! json_encode($cities) !!}--}}
        {{--    console.log(cities)--}}

        {{--    $('#province_id').on('change', function() {--}}
        {{--        // alert( this.value );--}}
        {{--        let selected_province_id = this.value--}}
        {{--        // add hidden class to all options of city--}}
        {{--        $('#city_id option').removeClass('show');--}}
        {{--        $('#city_id option').filter(function(){--}}
        {{--            return $(this).data('province_id') == selected_province_id;--}}
        {{--        }).addClass('show')--}}
        {{--        // remove hidden class from cities where their province_id is equal to <this.value>--}}
        {{--    });--}}
        {{--    // hide all cities by default--}}
        {{--    // only show those cities that their province_id is equal to selected province_id--}}

        {{--});--}}

        {{--function makeOption(optionValue,optionLabel){--}}

        {{--    select = document.getElementById('city_id');--}}

        {{--    var opt = document.createElement('option');--}}
        {{--    opt.value = optionValue;--}}
        {{--    opt.innerHTML = optionLabel;--}}

        {{--    select.appendChild(opt);--}}
        {{--}--}}

        {{--function makeProvinceCities(){--}}

        {{--}--}}

        $('#password, #password_confirmation').on('keyup', function () {

            if ($('#password').val() == $('#password_confirmation').val()) {
                $('#message').html('پسورد یکسان است').css('color', 'green');
            } else
                $('#message').html('پسورد یکسان نیست').css('color', 'red');
        });

    </script>

@endsection
