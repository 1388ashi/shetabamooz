@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست رسانه های بوتکمپ </li>
        </ol>
        <button data-toggle="modal" data-target="#addGalleries" class="btn btn-indigo">
            ثبت رسانه‌ی جدید
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست رسانه های بوتکمپ ({{ $bootcampGalleries->total() }})
                    </div>
                </div>
                <div class="card-body">
                    @include('components.errors')
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">ردیف</th>
                                <th class="border-top">بوت کمپ</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bootcampGalleries as $i => $gallery)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$gallery->bootcamp->title}}</td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" type="button" data-target="#edit-galleries-{{ $gallery->id }}" class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip"
                                                data-original-title="حذف"
                                                onclick="confirmDelete('delete-{{ $gallery->id }}')">
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.bootcamp-galleries.destroy',$gallery->id)}}"
                                            method="post" id="delete-{{ $gallery->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ رسانه‌ای برای بوتکمپ وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </form>
                        </table>
                        {{$bootcampGalleries->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    @include('bootcamp::admin.bootcamp-galleries.create')
    @include('bootcamp::admin.bootcamp-galleries.edit')
    @endsection


