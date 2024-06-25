@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.style.css')}}" />
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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.index') }}">لیست پستها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت پست جدید</li>
        </ol>
        {{--        <div class="mt-3 mt-lg-0">--}}
        {{--        </div>--}}
    </div>
    <!--  Page-header closed -->

    @include('components.errors')
    <form action="{{ route('admin.posts.store') }}" method="post" class="save"
          id="postForm" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات پست</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"  class="control-label">عنوان</label>
                            <span class="text-danger">&starf;</span>
                            <input class="form-control mb-4" placeholder="لطفا عنوان خود را وارد کنید" name="title" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="title"  class="control-label">نویسنده</label>
                            <span class="text-danger">&starf;</span>
                            <input class="form-control mb-4" placeholder="لطفا نام نویسنده را وارد کنید" name="author" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="slug"  class="control-label">اسلاگ</label>
                            <input class="form-control mb-4" placeholder="لطفا اسلاگ را وارد کنید" name="slug" type="text">
                        </div>

                        <div class="form-group">
                            <label for="short_description"  class="control-label">توضیحات کوتاه</label>
                            <span class="text-danger">&starf;</span>
                            <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="short_description" rows="3" required></textarea>
                        </div>


                        <div class="form-group">
                            <label for="body" class="control-label">توضیحات</label>
                            <span class="text-danger">&starf;</span>
                            <!--ck4-->
                            @include('components.editor',['name' => 'description','required' => 'true'])
                        </div>

                        <div class="form-group">
                            <label class="form-label">دسته بندی</label>
                            <select class="form-control custom-select select2 js-example-basic-multiple " multiple name="categories[]" data-placeholder="دسته بندی را انتخاب کنید ...">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <select name="tags[]" id="tags" class="form-control select2 w-100" multiple data-placeholder="برچسب ها را اینجا وارد کنید">
                                        @foreach($tags as $tag)
                                            <option
                                                value="{{ $tag }}">{{ $tag }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="image" class="control-label">عکس</label>
                                    <span class="text-danger">&starf;</span>
                                    <br>
                                    <span class="text-danger" style="font-size: 12px">(اندازه پیشنهادی برای عکس 180*250پیکسل است)</span>
                                    <input class="form-control" type="file" id="image" name="image" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="meta_description" class="control-label">تاریخ انتشار</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text cursor-pointer" id="publishDate"></span>
                                    </div>
                                    <input type="text" id="publishDateInput" name="published_at" hidden aria-label="publishDate"
                                           aria-describedby="publishDate">
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
                        <div class="seo">
                            <div class="heading">
                                <h3 class="card-title">اطلاعات سئو</h3>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="slug" class="control-label">نامک (slug)</label>
                                            <input type="text" name="slug" value="{{ old('slug') }}"
                                                   class="form-control" id="slug"
                                                   placeholder="نامک را اینجا وارد کنید...">
                                            <span class="text-info">افزودن نامک برای SEO مفید است.</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="image_alt" class="control-label">الت تصویر</label>
                                            <input type="text" name="image_alt" value="{{ old('image_alt') }}"
                                                   class="form-control" id="image_alt"
                                                   placeholder="الت تصویر را اینجا وارد کنید...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="meta_title" class="control-label">عنوان متا</label>
                                            <textarea class="form-control"
                                                      placeholder="لطفا متن خود را وارد کنید"
                                                      name="meta_title"
                                                      rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="meta_description" class="control-label">توضیحات متا</label>
                                            <textarea class="form-control"
                                                      placeholder="لطفا متن خود را وارد کنید"
                                                      name="meta_description"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="canonical_tag" class="control-label">تگ canonical</label>
                                            <input type="text" class="form-control" name="canonical_tag" value="{{ old('canonical_tag') }}" placeholder="در صورت نیاز تگ canonicalرا وارد کنید">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p class="control-label">متا ربات<span class="text-danger">&starf;</span></p>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="meta_robots" value="1" checked>
                                            <span class="custom-control-label">فعال</span>
                                        </label>
                                    </div>
                                </div>

                                <hr>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">ثبت</button>
                                            <button class="btn btn-danger" type="reset">پاک کردن فرم</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    <!-- row closed -->
    </form>
@endsection

@section('scripts')
    <script src="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js')}}" type="text/javascript"></script>

    <script>
        $('#publishDate').MdPersianDateTimePicker({
            targetDateSelector: '#publishDateInput',
            inLine: true,
            englishNumber: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd HH:mm:ss',
            textFormat: 'yyyy-MM-dd HH:mm:ss',
            groupId: 'date6-7-range'
        });

        //add summernote
        $(function(e) {
            $('.summernote').summernote({
                placeholder: "متن را اینجا وارد کنید...",
                tabsize: 3,
                height: 300
            });
        });
        //select2
        $(document).ready(function () {
            $('.select2').select2({
                minimumResultsForSearch: Infinity,
                tags: true
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder:'دسته بندی (ها) را انتخاب کنید',
                closeOnSelect:false,
            });
        });

        function resetForm() {
            let $date = document.getElementById("publishDateInput").value;
            document.getElementById("postForm").reset();
            document.getElementById("publishDateInput").value = $date;
        }

    </script>
@endsection
