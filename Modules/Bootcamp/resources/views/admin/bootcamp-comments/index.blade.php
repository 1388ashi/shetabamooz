@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست نظرات بوت کمپ</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">
        @include('bootcamp::admin.bootcamp-comments.filter')
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه نظرات ({{ $bootcampComments->total() }})
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">ردیف</th>
                                <th class="border-top">نام و نام خانوادگی</th>
                                <th class="border-top">شماره موبایل</th>
                                <th class="border-top">بوت کمپ</th>
                                <th class="border-top">وضعیت</th>
                                <th class="border-top">تاریخ ارسال</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bootcampComments as $i => $bootcampComment)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$bootcampComment->name}}</td>
                                    <td>{{$bootcampComment->mobile}}</td>
                                    <td>
                                        {{$bootcampComment->bootcamp->title}}
                                    </td>
                                    <td>
                                        @include('bootcamp::admin.bootcamp-comments.status', ['status' => $bootcampComment->status])
                                    </td>
                                    <td>{{verta($bootcampComment->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <button 
                                            data-toggle="modal" 
                                            data-original-title="ویرایش" 
                                            data-target="#edit-bootcamp-comment-{{ $bootcampComment->id }}"  
                                            class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ نظری وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$bootcampComments->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
    @include('bootcamp::admin.bootcamp-comments.edit')
    @endsection
