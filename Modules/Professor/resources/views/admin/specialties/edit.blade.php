@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.specialties-list',$specialty->professor) }}">لیست مشخصات</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش مشخصه</li>
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
                        <form action="{{route('admin.specialties.update',$specialty->id)}}" method="post" id="faqsForm">
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
                                                        <div class="form-group">
                                                            <label for="description" class="control-label">توضیحات</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="لطفا توضیح خود را وارد کنید" required>{{$specialty->description}}</textarea>
                                                        </div>

                                                        <div class="row">
                                                            <input type="hidden" name="professor_id" value="{{ $specialty->professor_id }}">
                                                        </div>
                                                        <div class="row mt-8">
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">ثبت</button>
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
    <!-- Summernote js  -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>
@endsection


