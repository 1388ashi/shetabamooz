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
            <li class="breadcrumb-item active" aria-current="page">ویرایش پست</li>
        </ol>
        {{--        <div class="mt-3 mt-lg-0">--}}
        {{--        </div>--}}
    </div>
    <!--  Page-header closed -->

    @include('components.errors')


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات مقاله</h3>
                    </div>
                    <form action="{{ route('admin.posts.update',$post->id) }}" method="post" class="save"
                          id="postForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"  class="control-label">عنوان</label>
                            <span class="text-danger">&starf;</span>
                            <input class="form-control mb-4" placeholder="لطفا عنوان را وارد کنید" name="title" value="{{$post->title}}" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="title"  class="control-label">نویسنده</label>
                            <span class="text-danger">&starf;</span>
                            <input class="form-control mb-4" placeholder="لطفا نام نویسنده را وارد کنید" name="author" value="{{$post->author}}" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="slug"  class="control-label">اسلاگ</label>
                            <input class="form-control mb-4" placeholder="لطفا اسلاگ را وارد کنید" name="slug" type="text" value="{{ $post->slug }}">
                        </div>

                        <div class="form-group">
                            <label for="short_description"  class="control-label">توضیحات کوتاه</label>
                            <span class="text-danger">&starf;</span>
                            <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="short_description" rows="3">{{$post->short_description}}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="description" class="control-label">توضیحات</label>
                            <span class="text-danger">&starf;</span><!--ck4-->
                            @include('components.editorDescription',['name' => 'description','model' => $post])
                        </div>

                        <div class="form-group">
                            <label class="form-label">دسته بندی</label>
                            <select class="form-control custom-select select2 js-example-basic-multiple " multiple name="categories[]" data-placeholder="دسته بندی را انتخاب کنید ...">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"{{ $post->categories->contains('name', $category->name) ? ' selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tags">برچسب ها</label>
                                    <select name="tags[]" id="tags" class="form-control select2 w-100" multiple data-placeholder="برچسب ها را اینجا وارد کنید">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->name }}"{{ $post->tags->contains('name', $tag->name) ? ' selected' : '' }}>{{ $tag->name }}</option>
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
                                    <div style="width: 200px" class="img">
                                        @if($post->image)
                                            <img src="{{$post->image}}" alt="image" class="img-fluid">
                                        @endif
                                    </div>
                                    <br><br>
                                    <span class="text-danger" style="font-size: 12px">(اندازه پیشنهادی برای عکس 180*250پیکسل است)</span>
                                    <input class="form-control" type="file" id="image" name="image">
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
                                           value="{{$post->published_at}}" aria-describedby="publishDate">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">وضعیت نمایش</label>
                                    <span class="text-danger">&starf;</span>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status"
                                            {{ $post->status ? ' checked' : '' }}
                                        >
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>

                        <h3 class="card-title">اطلاعات سئو</h3>
                        <div class="seo">
                            <div class="heading">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="slug" class="control-label">نامک (slug)</label>
                                            <input type="text" name="slug" value="{{ old('slug',$post->slug) }}"
                                                   class="form-control" id="slug"
                                                   placeholder="نامک را اینجا وارد کنید...">
                                            <span class="text-info">افزودن نامک برای SEO مفید است.</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="image_alt" class="control-label">الت تصویر</label>
                                            <input type="text" name="image_alt" value="{{ old('image_alt',$post->image_alt) }}"
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
                                                      rows="2">{{ old('meta_title',$post->meta_title) }}</textarea>
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
                                                      rows="3">{{ old('meta_description',$post->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="canonical_tag" class="control-label">تگ canonical</label>
                                            <input type="text" class="form-control" name="canonical_tag" value="{{ old('canonical_tag',$post->canonical_tag) }}" placeholder="در صورت نیاز تگ canonicalرا وارد کنید">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p class="control-label">متا ربات<span class="text-danger">&starf;</span></p>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="meta_robots"
                                                {{ $post->meta_robots ? ' checked' : '' }}
                                            >
                                            <span class="custom-control-label">فعال</span>
                                        </label>
                                    </div>
                                </div>

                                <hr>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <div class="text-center">
                                    <button class="btn btn-warning" type="submit">ثبت و بروزرسانی</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
    <script src="{{asset('assets\PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js')}}" type="text/javascript"></script>
    <script>

        var $postDate = new Date({{date('Y-m-d', strtotime($post->published_at))}});

        $('#publishDate').MdPersianDateTimePicker({
            targetDateSelector: '#publishDateInput',
            inLine: true,
            englishNumber: true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'date6-7-range',
            selectedDate: new Date($postDate),
            selectedDateToShow: new Date($postDate),

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

    </script>
@endsection
