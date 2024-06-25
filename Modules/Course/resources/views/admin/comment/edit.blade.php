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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.comments.index') }}">لیست فرم ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش فرم</li>
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
                        <form action="{{ route('admin.comments.update',$comment->id) }}" method="post" class="save"
                              id="formForm">
                            @csrf
                            @method('patch')
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name" class="control-label">نام</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control mb-4" placeholder="لطفا نام کاربر را وارد کنید" name="name" type="text" value="{{$comment->name}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="mobile"  class="control-label">تلفن همراه</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control mb-4" placeholder="لطفا شماره تلفن همراه کاربر را وارد کنید" name="mobile" type="text" value="{{$comment->mobile}}" required>
                                                                </div>
                                                            </div>
{{--                                                            <div class="col-6">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="age"  class="control-label">سن</label>--}}
{{--                                                                    <span class="text-danger">&starf;</span>--}}
{{--                                                                    <input class="form-control mb-4" placeholder="لطفا سن کاربر را وارد کنید" name="age" value="{{$form->age}}" type="number" required>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                            <div class="col">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="type" class="control-label">نوع</label>--}}
{{--                                                                    <select class="form-select form-control form-select-sm" name="type" aria-label=".form-select-sm example">--}}
{{--                                                                        @foreach($types as $type)--}}
{{--                                                                            <option value="{{$type}}"--}}
{{--                                                                                    @if($type == $comment->type)--}}
{{--                                                                                    selected--}}
{{--                                                                                @endif--}}
{{--                                                                            >--}}
{{--                                                                                {{\Modules\Course\Entities\Form::getPositionLabelAttribute($type)}}--}}
{{--                                                                            </option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="course_id" class="control-label">دوره</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <select class="form-control" name="course_id" aria-label=".form-control example">
                                                                        @foreach($courses as $course)
                                                                            <option value="{{$course->id}}"
                                                                                    @if($course->id == $comment->course_id)
                                                                                    selected
                                                                                @endif
                                                                            >
                                                                                {{ $course->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="description"  class="control-label">متن</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="text" rows="3">{{ old('text',$comment->text) }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-warning" type="submit">ثبت و بروزرسانی</button>
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
    <script>
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



    </script>
@endsection
