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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.comments.index') }}">لیست کامنتها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت کامنت جدید</li>
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
                        <form action="{{ route('admin.comments.store') }}" method="post" class="save"
                              id="commentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="profile-log-switch">
                                        <!-- Row-->
                                        <div class="row">
                                            <div class="col-xl-12 ">
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label">نام و نام خانوادگی</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <input type="text" name="name" id="name" class="form-control" value="" placeholder="لطفا نام خود را وارد کنید" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="control-label">موبایل</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="لطفا موبایل خود را وارد کنید" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="short_description" class="control-label">متن</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="body" rows="3" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="post_id" class="control-label">متعلق به پست</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <div class="form-group">
                                                            <select class="form-control" id="exampleFormControlSelect1" name="post_id" class="post_id">
                                                                @foreach($posts as $post)
                                                                    <option value="{{$post->id}}">{{$post->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="status" class="control-label">وضعیت نمایش</label>
                                                            <span class="text-danger">&starf;</span>
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                                <span class="custom-control-label">فعال</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-8">
                                                    <div class="col">
                                                        <div class="text-center">
                                                            <button class="btn btn-primary" type="submit">ثبت</button>
                                                            <button class="btn btn-danger" onclick="resetForm()" type="button">ریست فرم</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <!-- End Row -->
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
    <script>
        function resetForm() {
            document.getElementById("commentForm").reset();
        }

    </script>
@endsection
