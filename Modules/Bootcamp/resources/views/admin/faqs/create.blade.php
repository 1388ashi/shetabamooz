@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.faqs-bootcamp',request()->bootcamp) }}">لیست سوالات</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت سوال جدید</li>
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
                        <form action="{{route('admin.bootcamp-faqs.store')}}" method="post" class="save"
                              id="faqsForm">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="form-group">
                                                            <label for="question" class="control-label">سوال</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <textarea class="form-control" id="question" name="question" rows="3" placeholder="لطفا سوال خود را وارد کنید" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="answer" class="control-label">جواب</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <textarea class="form-control" id="answer" name="answer" rows="3" placeholder="لطفا جواب خود را وارد کنید" required></textarea>
                                                        </div>

                                                        <div class="row">
                                                            <input type="hidden" name="bootcamp_id" value="{{ request()->bootcamp }}">

                                                            <div class="col-sm-6">
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
    <!-- Summernote js  -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>

    <script>
        // $(function(e) {
        //     $('.summernote').summernote({
        //         placeholder: "سوال را اینجا وارد کنید...",
        //         tabsize: 3,
        //         height: 300
        //     });
        // });
        //
        // $(function(e) {
        //     $('.summernote2').summernote({
        //         placeholder: "جواب را اینجا وارد کنید...",
        //         tabsize: 3,
        //         height: 300
        //     });
        // });

        function resetForm() {
            document.getElementById("faqsForm").reset();
        }

    </script>
@endsection


