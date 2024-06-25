@extends('layouts.admin.master')

@section('styles')
    <style>
        .bold-weight{
            font-weight : bold;
        }
    </style>
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.professors.index') }}">لیست اساتید</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش استاد</li>
        </ol>
        {{--        <div class="mt-3 mt-lg-0">--}}
        {{--        </div>--}}
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12" >
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="border-0">
                        <form action="{{ route('admin.professors.update',$professor->id) }}" method="post" class="save"
                              id="professorForm" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="name"  class="control-label">نام</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control mb-4" placeholder="لطفا نام را وارد کنید" name="name" value="{{ old('name',$professor->name) }}" type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="role" class="control-label">نقش</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <input class="form-control mb-4" placeholder="لطفا نقش را وارد کنید" name="role" value="{{ old('role',$professor->role) }}" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="biography" class="control-label">توضیحات</label>
                                                            <textarea class="form-control" placeholder="لطفا توضیحات را وارد کنید" name="description" rows="3">{{ old('description',$professor->description) }}</textarea>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="image" class="control-label">تصویر</label>
                                                                    <input type="file" name="image" value="{{ old('image',$professor->image) }}"
                                                                           class="form-control" id="image"
                                                                           onchange="return imageValidation()"
                                                                           placeholder="تصویر را اینجا وارد کنید" autofocus>
                                                                </div>
                                                                <div id="imagePreview" style="margin: 10px;">
                                                                    <img src="{{ old('image',$professor->image) }}" height="200px">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="status" class="control-label">وضعیت نمایش</label>
                                                                    <span class="text-danger">&starf;</span>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="status" value="1"
                                                                            {{ $professor->status ? ' checked' : '' }}
                                                                        >
                                                                        <span class="custom-control-label">فعال</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-warning" type="submit">ثبت و بروزرسانی</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Row -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')

@endsection
