@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.games.index') }}">لیست مسابقه ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت مسابقه جدید</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات مسابقه</h3>
                </div>
                <form action="{{ route('admin.games.store') }}" method="post" class="save" enctype="multipart/form-data"
                        id="articleForm">
                        @csrf
                    <div class="card-body">
                        <div class="heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="control-label">عنوان مسابقه</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="form-control" id="title"
                                            placeholder="عنوان را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subtitle" class="control-label">رو تیتر</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                                            class="form-control" id="subtitle"
                                            placeholder="رو تیتر را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                               <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prerequisite" class="control-label">پیش نیاز</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="prerequisite" value="{{ old('prerequisite') }}"
                                        class="form-control" id="prerequisite"
                                        placeholder="پیش نیاز را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">تصویر اصلی</label><span class="text-danger">&starf;</span>
                                        <input class="form-control" type="file" name="image" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        <label for="from_published_at_show" class="control-label">زمان برگزاری</label><span class="text-danger">&starf;</span>
                                        <input class="form-control fc-datepicker" id="from_published_at_show" type="text"
                                            autocomplete="off" placeholder="زمان برگزاری را انتخاب کنید" />
                                        <input name="published_at" id="from_published_at_hide" type="hidden"
                                            value="{{ old('published_at') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eventplace" class="control-label">محل برگزاری</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="eventplace" value="{{ old('eventplace') }}"
                                        class="form-control" id="contacts"
                                        placeholder="محل برگزاری را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="summary"  class="control-label">توضیحات کوتاه</label>
                                        <span class="text-danger">&starf;</span>
                                        <textarea class="form-control" id="summary" placeholder="لطفا متن خود را وارد کنید" name="summary" required>{{ old('summary') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="catering" class="control-label">پذیرایی</label>
                                        <input type="text" name="catering" value="{{ old('catering') }}"
                                            class="form-control" id="catering"
                                            placeholder="پذیرایی را اینجا وارد کنید...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div
                                        class="form-group">
                                        <label for="description"
                                                class="control-label">توضیحات</label>
                                                <span class="text-danger">&starf;</span>
                                        @include('components.editor',['name' => 'description','required' => 'true'])
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">از ساعت</label><span class="text-danger">&starf;</span>
                                        <input class="form-control" type="text" name="fromhours" placeholder="ساعت شروع را وارد کنید" value="{{ old('fromhours') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">لینک ویدیو</label>
                                        <input class="form-control" type="text" name="video_link" placeholder="لینک ویدیو را وارد کنید" value="{{ old('video_link') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">ظرفیت نفرات</label><span class="text-danger">&starf;</span>
                                        <input class="form-control" type="number" name="count_users"  placeholder="ظرفیت نفرات را وارد کنید" value="{{ old('count_users') }}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="label" class="control-label"> وضعیت نمایش: </label>
                                    <label class="custom-control custom-checkbox">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        name="status"
                                        value="1"
                                        {{ old('status', 1) == 1 ? 'checked' : null }}
                                        />
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
                                                <label for="slug" class="control-label">نامک (slug)</label><span class="text-danger">&starf;</span>
                                                <input type="text" name="slug" value="{{ old('slug') }}"
                                                       class="form-control" id="slug"
                                                       placeholder="نامک را اینجا وارد کنید..." required>
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
    @include('bootcamp::admin.bootcamp.date-input-script', [
        'dateInputId' => 'from_published_at_hide',
        'textInputId' => 'from_published_at_show',
    ])
@endsection
