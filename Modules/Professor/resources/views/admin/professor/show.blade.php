@extends('layouts.admin.master')

@section('content')
    <style>
        .text-bold{
            font-weight: bold !important;
        }
        p{
            font-size: 16px;
        }
        .p__title{
            margin: 0 0 50px 0 ;
        }
        .rtl{
            direction: rtl !important;
            text-align: right !important;
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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.professors.index') }}">لیست استادها</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده استاد</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
    </div>
@endsection
