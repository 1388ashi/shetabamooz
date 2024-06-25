@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.faqs-list',$faq->course_id) }}">لیست سوالات</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده سوال</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<style>
    .text-bold{
        font-weight:bold;
    }
    *{
        font-size: 14px;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mg-b-20" id="breadcrumb1">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">
                            <p class="text-bold">مشاهده جزئیات</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-bold">پرسش:</p>
                        <div><p>{!! $faq->question !!}</p></div>
                        <p class="text-bold">پاسخ:</p>
                        <div><p>{!! $faq->answer !!}</p></div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <span class="text-bold">دوره:</span>
                                <span>{{$faq->course->title}}</span>
                            </div>
{{--                            <div class="col">--}}
{{--                                <span class="text-bold">دسته بندی:</span>--}}
{{--                                <span>{{$faqs->category->name}}</span>--}}
{{--                            </div>--}}
                            <div class="col">
                                <span class="text-bold">وضعیت:</span>
                                <span class="text-bold">@include('components.status', ['status' => $faq->status ])</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
