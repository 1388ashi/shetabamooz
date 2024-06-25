@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.faqs-list',$faq->course_id) }}">لیست سوالات</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش سوال</li>
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
                        <form action="{{route('admin.faqs.update',$faq->id)}}" method="post" id="faqsForm">
                            @csrf
                            @method('put')
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="form-group">
                                                            <label for="question" class="control-label">پرسش</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <textarea class="form-control" id="question" name="question" rows="3" placeholder="لطفا سوال خود را وارد کنید" required>{{$faq->question}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="answer" class="control-label">پاسخ</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <textarea class="form-control" id="answer" name="answer" rows="3" placeholder="لطفا جواب خود را وارد کنید" required>{{$faq->answer}}</textarea>
                                                        </div>

                                                        <div class="row">
{{--                                                            <div class="col-sm-6">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="category" class="control-label">دسته بندی</label>--}}
{{--                                                                    <select name="category" id="category" class="form-control">--}}
{{--                                                                        @foreach($categories as $category)--}}
{{--                                                                            <option value="{{ $category->id }}"--}}
{{--                                                                                    @if(isset($faqs))--}}
{{--                                                                                    @if($category->id === $faqs->category_id)--}}
{{--                                                                                    selected--}}
{{--                                                                                @endif--}}
{{--                                                                                @endif--}}
{{--                                                                            >--}}
{{--                                                                                {{ $category->name }}--}}
{{--                                                                            </option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                            <div class="col-sm-6">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="category" class="control-label">دوره</label>--}}
{{--                                                                    <span class="text-danger">&starf;</span>--}}
{{--                                                                    <select name="course" id="course" class="form-control">--}}
{{--                                                                        @foreach($courses as $course)--}}
{{--                                                                            <option value="{{ $course->id }}"--}}
{{--                                                                                    @if(isset($course))--}}
{{--                                                                                    @if($course->id === $faq->course_id)--}}
{{--                                                                                    selected--}}
{{--                                                                                @endif--}}
{{--                                                                                @endif--}}
{{--                                                                            >--}}
{{--                                                                                {{ $course->title }}--}}
{{--                                                                            </option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

                                                            <input type="hidden" name="course_id" value="{{ $faq->course_id }}">

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="status" class="control-label">وضعیت نمایش</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="status"
                                                                            {{ $faq->status ? ' checked' : '' }}
                                                                        >
                                                                        <span class="custom-control-label">فعال</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">ثبت</button>
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
    </script>
@endsection


