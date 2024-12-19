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
    <div class="row col-12">
        <div class="col-3">
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
        <div class="col-3">
            <div class="card">
                <a href="{{route('admin.bootcamps.index')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-right">
                                    <span class="fs-16 font-weight-semibold">بوت کمپ ها</span>
                                    <h3 class="mb-0 mt-1 text-primary  fs-25">{{ $count['bootcamps'] }}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-primary-transparent my-auto  float-left"> <i class="fa fa-graduation-cap"></i> </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-3">
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
        <div class="col-3">
            <div class="card">
                <a href="{{route('admin.posts.index')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mt-0 text-right">
                                    <span class="fs-16 font-weight-semibold">مطالب</span>
                                    <h3 class="mb-0 mt-1 text-danger fs-25">{{$count['posts']}}</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="icon1 bg-danger-transparent my-auto  float-left"> <i class="feather feather-book-open"></i> </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row col-12">
        <div class="col-6">
        <div class="card">
            <div class="card-header border-0">
                <p class="card-title">آخرین درخواستی های بوت کمپ</p>
                <div class="card-options">
                    <a href="{{ route('admin.bootcamp-users.index') }}" class="btn btn-outline-light ml-3">مشاهده
                        همه</a>
                </div>
            </div>
            <div class="table-responsive attendance_table mt-4 border-top">
                <table class="table mb-0 text-nowrap">
                    <thead>
                    <tr>
                        <th class="text-center">ردیف</th>
                        <th class="text-center">نام</th>
                        <th class="text-center">شماره موبایل</th>
                        <th class="text-center">بوت کمپ</th>
                        <th class="text-center">وضعیت</th>
                        <th class="text-center">تاریخ ارسال</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bootcampRegisters as $bootcampRegister)
                        <tr class="border-bottom">
                            <td>{{ $bootcampRegister->iteration }}</td>
                            <td class="text-center">{{$bootcampRegister->name}}</td>
                            <td class="text-center">{{$bootcampRegister->mobile}}</td>
                            <td>
                            @foreach ($bootcampRegister->bootcamps as $bootcamp)
                            {{$bootcamp->title}}
                            @endforeach
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-transparent">جدید</span>
                            </td>
                            <td class="text-center">{{verta($bootcampRegister->created_at)->format('Y/m/d H:i')}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <p class="text-danger" style="display: flex;justify-content: center !important"><strong>در حال حاضر هیچ درخواستی یافت نشد!</strong></p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <p class="card-title">آخرین درخواستی های دوره</p>
                    <div class="card-options ">
                        <a href="{{ route('admin.course-registers.index') }}" class="btn btn-outline-light ml-3">مشاهده
                            همه</a>
                    </div>
                </div>
                <div class="table-responsive attendance_table mt-4 border-top">
                    <table class="table mb-0 text-nowrap">
                        <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">موبایل</th>
                            <th class="text-center">دوره</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">تاریخ ارسال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courseRegisters as $courseRegister)
                            <tr class="border-bottom">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $courseRegister->name }}</td>
                                <td class="text-center">{{ $courseRegister->mobile }}</td>
                                <td class="text-center">{{ $courseRegister->course->title }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info-transparent">جدید</span>
                                </td>
                                <td class="text-center">{{verta($courseRegister->created_at)->format('Y/m/d H:i')}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <p class="text-danger" style="display: flex;justify-content: center !important"><strong>در حال حاضر هیچ درخواستی یافت نشد!</strong></p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <p class="card-title">آخرین درخواستی های مشاوره</p>
                    <div class="card-options">
                        <a href="{{ route('admin.consultation-requests.index') }}" class="btn btn-outline-light ml-3">مشاهده
                            همه</a>
                    </div>
                </div>
                <div class="table-responsive attendance_table mt-4 border-top">
                    <table class="table mb-0 text-nowrap">
                        <thead>
                        <tr>
                            <th class="text-center">ردیف</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">شماره موبایل</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">تاریخ ارسال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($consultationRequestes as $consultationRequest)
                            <tr class="border-bottom">
                                <td>{{ $consultationRequest->iteration }}</td>
                                <td class="text-center">{{$consultationRequest->name}}</td>
                                <td class="text-center">{{$consultationRequest->mobile}}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary-transparent">جدید</span>
                                </td>
                                <td class="text-center">{{verta($consultationRequest->created_at)->format('Y/m/d H:i')}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <p class="text-danger" style="display: flex;justify-content: center !important"><strong>در حال حاضر هیچ مشاوره ای یافت نشد!</strong></p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <p class="card-title">همکاری ها</p>
                        <div class="card-options ">
                            <a href="{{ route('admin.cooperation-requests.index') }}" class="btn btn-outline-light ml-3">مشاهده
                                همه</a>
                        </div>
                    </div>
                    <div class="table-responsive attendance_table mt-4 border-top">
                        <table class="table mb-0 text-nowrap">
                            <thead>
                            <tr>
                                <th class="text-center">ردیف</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">موبایل</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">تاریخ ارسال</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cooperationRequestes as $cooperationRequest)
                                <tr class="border-bottom">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $cooperationRequest->name }}</td>
                                    <td class="text-center">{{ $cooperationRequest->mobile }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info-transparent">جدید</span>
                                    </td>
                                    <td class="text-center">{{verta($cooperationRequest->created_at)->format('Y/m/d H:i')}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <p class="text-danger" style="display: flex;justify-content: center !important"><strong>در حال حاضر هیچ همکاری یافت نشد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
