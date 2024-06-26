@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                لیست بوت کمپ ها </li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.bootcamps.create')}}" class="btn btn-twitter">
                    ثبت بوت کمپ جدید
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">لیست
                        همه بوت کمپ ها ({{ $bootcamps->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.bootcamps.index')}}"
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
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class=" border-top" >@sortablelink('title', 'عنوان')</th>
                                <th class=" border-top">استادان</th>
                                <th class=" border-top" >تصویر</th>
                                <th class=" border-top" >@sortablelink('price', 'هزینه بوت کمپ (تومان)')</th>
                                <th class=" border-top" >@sortablelink('status', 'وضعیت')</th>
                                <th class=" border-top">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-top" >عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bootcamps as $i => $bootcamp)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox"
                                               data-id="{{$bootcamp->id}}" {{ $bootcamp->isDeletable() ? '' : 'disabled' }}>
                                    </td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ Str::limit($bootcamp->title, 30) }}</td>
                                    <td>
                                    @foreach ($bootcamp->professors as $item)
                                        {{$item->name}}
                                    @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if ($bootcamp->image['url'])
                                        <a href="{{ $bootcamp->image['url'] }}" target="_blanck">
                                            <div class="bg-light pb-1 pt-1 img-holder img-show w-100" style="max-height: 50px;border-radius: 4px;">
                                                <img src="{{ $bootcamp->image['url'] }}" style="height: 40px;"  alt="{{ $bootcamp->image['name'] }}">
                                            </div>
                                        </a>
                                        @else
                                        ندارد
                                        @endif
                                    </td>
                                    <td>{{ $bootcamp->getPrice() }}</td>
                                    <td>@include('components.status', ['status' => $bootcamp->status])</td>
                                    <td>{{ $bootcamp->getJalaliCreatedAt() }}</td>
                                    <td>
                                        <a href="{{route('admin.faqs-bootcamp',[$bootcamp->id])}}"
                                            class="btn btn-success btn-sm text-white" data-toggle="tooltip"
                                            data-original-title="نمایش سوالات متداول">
                                             <i class="fa fa-question" data-original-title="mdi-account"></i>
                                         </a>
                                        {{-- Show --}}
                                        <a href="{{ route('admin.bootcamps.show', [$bootcamp->id]) }}"
                                            class="btn btn-primary btn-sm text-white" data-toggle="tooltip"
                                            data-original-title="نمایش"><i class="fa fa-eye"></i></a>

                                        {{-- Edit --}}
                                        <a href="{{route('admin.bootcamps.edit',[$bootcamp->id])}}"
                                           class="btn btn-warning btn-sm text-white" data-toggle="tooltip"
                                           data-original-title="ویرایش"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip"
                                                data-original-title="حذف"
                                                onclick="confirmDelete('delete-{{ $bootcamp->id }}')"{{ $bootcamp->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.bootcamps.destroy',[$bootcamp->id])}}"
                                              method="post" id="delete-{{ $bootcamp->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر
                                                هیچ بوت کمپی ای
                                                یافت نشد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        {{ $bootcamps->appends(request()->query())->links() }}
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
{{--    @include('core::includes.dates-script')--}}
{{--    @include('core::includes.delete-all-script', [$route = 'admin.courses.multipleDelete'])--}}
@endsection
