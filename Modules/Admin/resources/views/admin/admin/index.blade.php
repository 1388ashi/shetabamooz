@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                لیست ادمین ها </li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                @can('write_admin')
                <a href="{{ route('admin.admins.create')}}" class="btn btn-twitter">
                    ثبت ادمین جدید
                    <i class="fa fa-plus"></i>
                </a>
                @endcan
            </div>
        </div>
    </div>
    <!--  Page-header closed -->

    <!-- Search -->
    <form method="get" id='basicSearch' action="{{route('admin.admins.index')}}"
          autocomplete="off"
          onblur="document.form1.input.value = this.value;">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12" >
                {{--            <div class="card card-collapsed">--}}
                <div class="card">
                    <div class="card-header  border-0">
                        <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">جستجوی پیشرفته</div>
                        <div class="card-options">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse" style="margin: 5px;"><i
                                    class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen" style="margin: 5px;"><i
                                    class="fe fe-maximize"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove" style="margin: 5px;"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">نام و نام خانوادگی</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="نام و نام خانوادگی" id="name" value="{{ request('name') }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mobile">تلفن همراه</label>
                                            <input type="text" name="mobile" value="{{ request('mobile') }}"
                                                   class="form-control"
                                                   id="mobile" placeholder="تلفن همراه">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">وضعیت</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">همه وضعیت ها</option>
                                                <option value="1">فعال</option>
                                                <option value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="from_date_show">از تاریخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" id="from_date_show" placeholder="تاریخ شروع..." type="text">
                                        <input hidden name="from_date" id="from_date" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="to_date_show">از تاریخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" id="to_date_show" placeholder="تاریخ پایان..." type="text">
                                        <input hidden name="to_date" id="to_date" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 pt-5">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">جستجو</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Search-->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">لیست
                        همه ادمین ها ({{ $admins->total() }})
                    </div>
                    <div class="card-options">
                        <div class="container-fluid">
                            <button class="btn btn-danger btn-xs delete-all" data-url="">حذف انتخاب شده ها</button>
                        </div>
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse" style="margin: 5px;"><i
                                class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen" style="margin: 5px;"><i
                                class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove" style="margin: 5px;"><i class="fe fe-x"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0" style="width: 5px;"><input type="checkbox"
                                                                                              id="check_all"></th>
                                <th class="wd-20p border-bottom-0" style="width: 5px;">@sortablelink    ('id', 'شناسه')</th>
                                <th class="wd-25p border-bottom-0" style="width: 50%">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="wd-25p border-bottom-0" style="width: 50%">@sortablelink('mobile', 'موبایل')</th>
                                <th class="wd-25p border-bottom-0" style="width: 50%">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('last_login', 'آخرین لاگین')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox"
                                               data-id="{{$admin->id}}" {{ $admin->isDeletable() ? '' : ' disabled' }}>
                                    </td>
                                    <td>{{ $admin->id }}</td>
                                    <td class="tdnowrap">{{ $admin->name }}</td>
                                    <td class="tdnowrap">{{ $admin->mobile }}</td>
                                    <td>@include('components.status', ['status' => $admin->status])</td>
                                    <td>{{ $admin->getJalaliLastLogin() }}</td>
                                    <td>{{ $admin->getJalaliCreatedAt() }}</td>
                                    <td>
                                        @can('read_admin')
                                        {{-- Show --}}
                                        <a href="{{route('admin.admins.show',[$admin->id])}}"
                                           class="btn btn-primary btn-sm text-white" data-toggle="tooltip"
                                           data-original-title="مشاهده"><i class="fa fa-eye"></i></a>
                                        @endcan
                                            @can('modify_admin')
                                        {{-- Edit --}}
                                        <a href="{{route('admin.admins.edit',[$admin->id])}}"
                                           class="btn btn-warning btn-sm text-white" data-toggle="tooltip"
                                           data-original-title="ویرایش"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('delete_admin')
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip"
                                                data-original-title="حذف"
                                                onclick="confirmDelete('delete-{{ $admin->id }}')"{{ $admin->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.admins.destroy',[$admin->id])}}"
                                              method="post" id="delete-{{ $admin->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                            @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر
                                                هیچ ادمین ای
                                                یافت نشد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        {{ $admins->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')
    @include('core::includes.dates-script')
    @include('core::includes.delete-all-script',[$route = 'admin.admins.multipleDelete'])
@endsection
