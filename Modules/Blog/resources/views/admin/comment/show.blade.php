@extends('layouts.admin.master')

@section('content')
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
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.comments.index') }}">لیست کامنتها</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده کامنت</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h5 class="card-title text-bold">جزئیات کامنت</h5>
            </div>
            <div class="card-body p-30">
                <div class="row">

                    <div class="col">
                        <span class="text-bold">نام کاربر:</span>
                        {{$comment->name}}
                    </div>
                    <div class="col">
                        <span class="text-bold">موبایل کاربر:</span>
                        {{$comment->mobile}}
                    </div>
                    <div class="col">
                        <span class="text-bold">متعلق به پست:</span>
                        {{$comment->post->title}}
                    </div>
                </div>
                @if($comment->image)
                    <div class="row">
                        <div class="col-6">
                            <div class="img" style="height: 200px">
                                <img src="{{$comment->image}}" height="80%" alt="post">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <p class="p__title"><span class="text-bold">متن:</span><span>{{$comment->text}}</span></p>
                        </p>
                    </div>
                </div>
                <td>
                    <span class="text-bold">وضعیت:</span>
                    @include('components.status', ['status' => $comment->status])
                </td>
            </div>
        </div>
        <br>
    </div>
</div>

@endsection
