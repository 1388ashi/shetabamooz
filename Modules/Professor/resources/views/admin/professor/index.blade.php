@extends('layouts.admin.master')

@section('styles')
    <style>
        .text-bold{
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست استادها</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.professors.create')}}" class="btn btn-twitter">
                    ثبت استاد جدید
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <!--  Page-header closed -->
    <!------->

    <!------->
    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه استادها ({{ $professors->total() }})
                    </div>

                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.professors.index')}}"
                          autocomplete="off"
                          onblur="document.form1.input.value = this.value;" class="form-inline mr-4">
                        <div class="search-element">
                            <input type="search" name="keyword" class="form-control header-search" placeholder="جستجو..."
                                   aria-label="Search" tabindex="55">
                            <button class="btn btn-primary">
                                <i class="feather feather-search"></i>
                            </button>
                        </div>
                    </form>
                    <!---->
                    <div class="card-options">
                        <div class="container-fluid">
                            <button class="btn btn-danger btn-xs delete-all" data-url="">حذف انتخاب شده ها</button>
                        </div>
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0" style="width: 5%;"><input type="checkbox" id="check_all"></th>
                                <th class="wd-1p border-bottom-0" style="width: 10%;">ردیف</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('name', 'نام')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">تصویر</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">نقش</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($professors as $i => $professor)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$professor->id}}"></td>
                                    <td>{{++$i}}</td>
                                    <td>{{Str::limit($professor->name,30)}}</td>
                                    <td><img src="{{ $professor->image }}" alt="{{ $professor->image }}" height="50px"></td>
                                    <td>{{Str::limit($professor->role,30)}}</td>
                                    <td>@include('components.status', ['status' => $professor->status])</td>
                                    <td>
                                        <a href="{{route('admin.professors.edit',$professor->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" onclick="confirmDelete('delete-{{ $professor->id }}')" {{ $professor->isDeletable() ? '' : ' disabled' }}><i class="fa fa-trash-o"></i></button>
                                        <form action="{{ route('admin.professors.destroy', $professor->id) }}" method="post" id="delete-{{ $professor->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ استادی وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$professors->links()}}
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

    @include('core::includes.delete-all-script', [$model_name = 'professors'])
@endsection
