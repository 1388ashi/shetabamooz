@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.admins.index') }}">لیست ادمین ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت ادمین جدید</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-lg-12" >
            <div class="bg-white widget-user mb-5">
                <div class="card-body">
                    <div class="border-0">
                        <form action="{{ route('admin.admins.store') }}" method="post" class="save"
                              id="articleForm">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="card mb-0 p-2 box-shadow-0">
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div
                                                                        class="form-group">
                                                                        <label for="name" class="control-label">نام و نام خانوادگی</label>
                                                                        <span class="text-danger">&starf;</span>
                                                                        <input type="text" name="name" value="{{ old('name') }}"
                                                                               class="form-control" id="name"
                                                                               placeholder="نام و نام خانوادگی را اینجا وارد کنید..." required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div
                                                                        class="form-group">
                                                                        <label for="mobile" class="control-label">تلفن همراه</label>
                                                                        <span class="text-danger">&starf;</span>
                                                                        <input type="text" name="mobile" value="{{ old('mobile') }}"
                                                                               class="form-control" id="mobile"
                                                                               placeholder="تلفن همراه را اینجا وارد کنید..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div
                                                                        class="form-group">
                                                                        <label for="email" class="control-label">آدرس ایمیل</label>
                                                                        <input type="email" name="email" value="{{ old('email') }}"
                                                                               class="form-control" id="email"
                                                                               placeholder="آدرس ایمیل را اینجا وارد کنید...">
                                                                    </div>
                                                                </div>
                                                             </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div
                                                                        class="form-group">
                                                                        <label for="password" class="control-label">کلمه عبور</label>
                                                                        <span class="text-danger">&starf;</span>
                                                                        <input type="password" name="password"
                                                                               class="form-control" id="password"
                                                                               placeholder="کلمه عبور را اینجا وارد کنید..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div
                                                                        class="form-group">
                                                                        <label for="password_confirmation" class="control-label">تکرار کلمه عبور</label>
                                                                        <span class="text-danger">&starf;</span>
                                                                        <input type="password" name="password_confirmation"
                                                                               class="form-control" id="password_confirmation"
                                                                               placeholder="تکرار کلمه عبور را اینجا وارد کنید..." required>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="form-label">وضعیت  <span class="text-danger">&starf;</span></p>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                                        <span class="custom-control-label">فعال</span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                            <div>
                                                                <p class="form-label"><strong>مجوزهای دسترسی</strong></p>
                                                                @foreach($permissions->chunk(4) as $chunk)
                                                                    <div class="row">
                                                                        @foreach($chunk as $permission)
                                                                            <div class="col-3">
                                                                                <label class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->name }}">
                                                                                    <span class="custom-control-label">{{ $permission->label }}</span>
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Row -->
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">ثبت</button>
                                            <button class="btn btn-danger" type="reset">پاک کردن فرم</button>
                                        </div>
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
