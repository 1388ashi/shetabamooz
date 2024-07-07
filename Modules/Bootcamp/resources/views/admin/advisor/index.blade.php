@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست مشاوره های بوت کمپ</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">

            @include('bootcamp::admin.advisor.filter')
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه مشاوره ها ({{ $advisors->total() }})
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
                                <th class="border-top">هدف یادگیری</th>
                                <th class="border-top">زمان تماس</th>
                                <th class="border-top">@sortablelink('status', 'وضعیت')</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($advisors as $i => $advisor)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$advisor->name}}</td>
                                    <td>{{$advisor->mobile}}</td>
                                    <td>{{$advisor->type}}</td>
                                    <td>{{$advisor->time}}</td>
                                    <td>
                                        @include('bootcamp::admin.advisor.status', ['status' => $advisor->status])
                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" data-target="#edit-menu-{{ $advisor->id }}"  class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ مشاوره ای وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$advisors->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
    @include('bootcamp::admin.advisor.edit')
    @endsection
