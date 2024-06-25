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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.student-povs.index') }}">لیست نظر ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت نظر جدید</li>
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
                        <form action="{{ route('admin.student-povs.store') }}" method="post" class="save"
                              enctype="multipart/form-data" id="formForm">
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
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="name" class="control-label">نام</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control mb-4" placeholder="لطفا نام کاربر را وارد کنید" name="name" type="text" value="{{ old('name') }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="comment"  class="control-label">متن</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="comment" rows="3">{{ old('comment') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="image" class="control-label">تصویر</label>
                                                                    <input type="file" name="image" value="{{ old('image') }}"
                                                                           class="form-control" id="image"
                                                                           onchange="return imageValidation()"
                                                                           placeholder="تصویر را اینجا وارد کنید" autofocus>
                                                                </div>

                                                                <div id="imagePreview" style="margin: 10px;">
                                                                    <img src="{{ old('image') }}" height="200px">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="status" class="control-label">وضعیت نمایش</label>
                                                                <span class="text-danger">&starf;</span>
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                                    <span class="custom-control-label">فعال</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">ثبت</button>
                                                                    <button class="btn btn-danger" onclick="resetForm()" type="button">ریست نظر</button>
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
    <script src="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js')}}" type="text/javascript"></script>

    <script>
        $('#publishDate').MdPersianDateTimePicker({
            targetDateSelector: '#publishDateInput',
            inLine: true,
            englishNumber: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd HH:mm:ss',
            textFormat: 'yyyy-MM-dd HH:mm:ss',
            groupId: 'date6-7-range'
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
            document.getElementById("formForm").reset();
        }

    </script>
@endsection
