@extends('layouts.admin.master')

@section('styles')
    <style>
        h5{
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.courses.index') }}">لیست دوره ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">نمایش دوره</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12" >
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li><strong>عنوان دوره: </strong> {{ $course->title }}</li>
                                <li><strong>زمان دوره: </strong> {{ $course->time }}</li>
                                <li><strong>تعداد جلسات: </strong> {{ $course->sections }}</li>
                                <li><strong>سطح: </strong> {{ \Modules\Course\App\Models\Course::getLevelLabelAttribute($course->level) }}</li>
                                <li><strong>قیمت دوره (تومان): </strong> {{ $course->getPrice() }}</li>
                                <li><strong>قیمت تخفیف (تومان): </strong> {{ $course->getDiscount() }}</li>
                                <li><strong>استاد: </strong> {{ optional($course->professor)->name }}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <li><strong>نامک: </strong> {{ $course->slug }}</li>
                            <li><strong>الت تصویر: </strong> {{ $course->image_alt }}</li>
                        </div>
                        <div class="col">
                            <ul>
                                <li><strong>تعداد بازدید: </strong> {{ views($course)->count() }}</li>
                                <li><strong>وضعیت: </strong> @include('components.status', ['status' => $course->status])</li>
                                <li><strong>تاریخ ثبت: </strong> {{ $course->getJalaliCreatedAt() }}</li>
                            </ul>
                        </div>
{{--                        <div class="col">--}}
{{--                            <ul>--}}
{{--                                <li><strong>نام ایجادکننده: </strong> {{ $course->creator->name }}</li>--}}
{{--                                <li><strong>نام آخرین ویرایش کننده: </strong> {{ $course->updater->name }}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <h5 class="control-label">برچسب های ثبت شده</h5>--}}
{{--                            <p>@if($course->tags->count() > 0) {{ implode(',', $course->tags->pluck('name')->all()) }} @endif</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="control-label">عنوان متا</h5>
                            <p>{{ $course->meta_title }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="control-label">توضیحات متا</h5>
                            <p>{{ $course->meta_description }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="control-label">توضیحات کوتاه</h5>
                            <p>{{ $course->short_description }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="control-label">متن کامل</h5>
                            <p>{!! $course->description !!}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="control-label">تصویر شاخص</h5>
                            <img src="{{ $course->image }}" alt="" height="400px">
                        </div>
                    </div>
                    <hr>
                    @if($properties)
                        <div class="row">
                            <div class="col">
                                <span><strong>مناسب برای:</strong></span>
                                @foreach($properties as $value)
                                    <span>{{ $value }}</span>
                                    <span>,</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
