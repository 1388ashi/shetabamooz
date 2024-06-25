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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.cooperation-requests.index') }}">لیست درخواست های همکاری</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده درخواست</li>
        </ol>
    </div>

    <!--  Page-header closed -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h5 class="card-title text-bold">جزئیات درخواست</h5>
            </div>
            <div class="card-body p-30">
                <div class="row">
                    <div class="col-6">
                        <span class="text-bold">نام و نام خانوادگی:</span>
                        <span>{{$request->name}}</span>
                        <br>
                        <br>
                        <span class="text-bold">ایمیل:</span>
                        <span>{{$request->email}}</span>
                        <br>
                        <br>
                        <span class="text-bold">موبایل:</span>
                        <span>{{$request->mobile}}</span>
                        <br>
                        <br>
                    </div>
                    <div class="col-6">
                        <p class="p__title"><span class="text-bold">وضعیت:</span><span class="ltr">@include('components.checked',['status' => $request->status])</span></p>
                        <br>
                        <br>
                    </div>

                    <div class="col-md-12">
                        <p class="text-bold">رزومه:</p>
                        <p>{!! $request->resume !!}</p>
                    </div>
                    <br>
                    <br>
                    <hr>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

@endsection
