@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست کاربران بوت کمپ</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">
        @include('bootcamp::admin.users.filter')
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه کاربران ({{ $users->total() }})
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class="border-top">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="border-top">@sortablelink('mobile', 'شماره موبایل')</th>
                                <th class="border-top">بوت کمپ</th>
                                <th class="border-top">@sortablelink('status', 'وضعیت')</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $i => $user)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>
                                        @foreach ($user->bootcamps as $bootcamp)
                                        {{$bootcamp->title}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @include('bootcamp::admin.users.status', ['status' => $user->status])
                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" data-target="#edit-menu-{{ $user->id }}"  class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ کاربری وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
    @include('bootcamp::admin.users.edit')
    @endsection
