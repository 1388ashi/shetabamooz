@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
            </div>
        </div>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card">
                <a href="{{route('admin.courses.index')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-right">
                                    <span class="fs-16 font-weight-semibold">دوره ها</span>
                                    <h3 class="mb-0 mt-1 text-primary  fs-25">{{ $count['courses'] }}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-primary-transparent my-auto  float-left"> <i class="fa fa-university"></i> </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card">
                <a href="{{route('admin.professors.index')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-right">
                                    <span class="fs-16 font-weight-semibold">استاد ها</span>
                                    <h3 class="mb-0 mt-1 text-danger fs-25">{{$count['professors']}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-danger-transparent my-auto  float-left"> <i class="fa fa-user"></i> </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

{{--        <div class="col-xl-3 col-lg-6 col-md-12">--}}
{{--            <div class="card">--}}
{{--                <a href="{{route('admin.students.index')}}">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-7">--}}
{{--                                <div class="mt-0 text-right">--}}
{{--                                    <span class="fs-16 font-weight-semibold">هنرجویان</span>--}}
{{--                                    <h3 class="mb-0 mt-1 text-secondary fs-25">{{$count['students']}}</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-5">--}}
{{--                                <div class="icon1 bg-secondary-transparent my-auto  float-left"> <i class="fa fa-users"></i> </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-lg-6 col-md-12">--}}
{{--            <div class="card">--}}
{{--                <a href="{{route('admin.professors.index')}}">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-7">--}}
{{--                                <div class="mt-0 text-right">--}}
{{--                                    <span class="fs-16 font-weight-semibold">استاد ها</span>--}}
{{--                                    <h3 class="mb-0 mt-1 text-success fs-25">{{$count['professors']}}</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-5">--}}
{{--                                <div class="icon1 bg-success-transparent my-auto  float-left"> <i class="fa fa-user-circle"></i> </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- End Row -->
@endsection
