@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.courses.index') }}">لیست دوره ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت دوره جدید</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات دوره</h3>
                </div>
                <form action="{{ route('admin.courses.store') }}" method="post" class="save" enctype="multipart/form-data"
                      id="articleForm">
                    @csrf
                    <div class="card-body">
                        <div class="heading">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title" class="control-label">عنوان دوره</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                               class="form-control" id="title"
                                               placeholder="عنوان را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="slug" class="control-label">تعداد جلسات</label>
                                        <input type="text" name="sections" value="{{ old('sections') }}"
                                               class="form-control" id="sections"
                                               placeholder="تعداد فصل را اینجا وارد کنید..." required>
                                        <span class="text-info">لطفا تعداد جلسات دوره را وارد کنید.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="slug" class="control-label">زمان دوره</label>
                                        <input type="number" name="time" value="{{ old('time') }}"
                                               class="form-control" id="sections"
                                               placeholder="زمان دوره را وارد کنید..." required>
                                        <span class="text-info">لطفا زمان دوره(ساعت) را وارد کنید.</span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="level" class="control-label">سطح</label>
                                        <span class="text-danger">&starf;</span>
                                        <select class="form-control" name="level" aria-label=".form-control example">
                                            @foreach($levels as $level)
                                                <option value="{{$level}}">
                                                    {{\Modules\Course\App\Models\Course::getLevelLabelAttribute($level)}}
                                                </option>
                                            @endforeach
                                        </select>

                                        <span class="text-info">لطفا سطح دوره را وارد کنید.</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="professor_id" class="control-label">استاد</label>
                                        <span class="text-danger">&starf;</span>
                                        <select class="form-control" name="professor_id" aria-label=".form-control example">
                                            @foreach($professors as $professor)
                                                <option value="{{$professor->id}}">
                                                    {{ $professor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image"
                                               class="control-label">تصویر</label>
                                        <span
                                            class="text-danger">&starf;</span>
                                        <input type="file" name="image" value="{{ old('image') }}"
                                               class="form-control"
                                               id="image" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div
                                        class="form-group">
                                        <label for="price" class="control-label">قیمت (تومان)</label>
                                        <input type="text" name="price" value="{{ old('price') }}"
                                               class="form-control comma" id="price"
                                               placeholder="قیمت را اینجا وارد کنید...">
                                        <span class="text-info">اگر قیمت را وارد نکنید دوره رایگان می باشد.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div
                                        class="form-group">
                                        <label for="discount" class="control-label">تخفیف (تومان)</label>
                                        <input type="text" name="discount" value="{{ old('discount') }}"
                                               class="form-control comma" id="discount"
                                               placeholder="تخفیف را اینجا وارد کنید...">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">دسته بندی</label>
                                        <select class="form-control custom-select select2 js-example-basic-multiple" name="category_id" data-placeholder="دسته بندی را انتخاب کنید ...">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="properties" class="control-label">ویژگی ها</label>
                                        <select name="properties[]" id="properties" class="form-control select2 w-100" multiple data-placeholder="ویژگی ها را اینجا وارد کنید">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="short_description"  class="control-label">توضیحات کوتاه</label>
                                        <span class="text-danger">&starf;</span>
                                        <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="short_description" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div
                                        class="form-group">
                                        <label for="description"
                                               class="control-label">توضیحات</label>
                                        @include('components.editor',['name' => 'description','required' => 'true'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <p class="form-label">وضعیت نمایش <span class="text-danger">&starf;</span></p>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                        <span class="custom-control-label">فعال</span>
                                    </label>
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
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>

        $('#properties').select2({
            minimumResultsForSearch: '',
            tags: true
        });

    </script>
@endsection
