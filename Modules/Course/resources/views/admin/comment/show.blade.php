@extends('layouts.admin.master')

@section('styles')
    <style>
        .text-bold{
            font-weight: bold;
        }
        p{
            font-size: 16px;
        }
        .p__title{
            margin: 0 0 50px 0 ;
        }
        .rtl{
            direction: rtl;
            text-align: right;
        }
        .ltr{
            direction: ltr;
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb align-items-baseline">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('admin.comments.index') }}">لیست نطر ها</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">نمایش نطر</li>
        </ol>

    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12">
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="border-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <div class="profile-log-switch">
                                    <!-- Row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="p__title"><span class="text-bold">نام و نام خانوادگی:</span><span>{{$comment->name}}</span></p>
                                            <p class="p__title"><span class="text-bold">تلفن همراه:</span><span>{{$comment->mobile}}</span></p>
{{--                                            <p class="p__title"><span class="text-bold">نوع:</span><span class="ltr">{{\Modules\Course\Entities\Form::getPositionLabelAttribute($comment->type)}}</span></p>--}}

                                            @if($comment->course_id)
                                                <p class="p__title"><span class="text-bold">دوره:</span><span class="ltr">{{$comment->course->title}}</span></p>
                                            @endif

                                        </div>
                                        <div class="col-md-12">
                                            <p class="text-bold">متن:</p>
                                            <p>{{ $comment->text }}</p>
                                        </div>
                                        <hr>
                                        <br><br>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')

@endsection
