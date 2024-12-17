@extends('layouts.admin.master')

@section('styles')
    <!-- Summernote css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- INTERNAL Fancy File Upload css -->
    <link href="{{ asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!-- INTERNAL File Uploads css-->
    <link href="{{ asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.bootcamps.index') }}">لیست بوت کمپ ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش بوت کمپ</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')
    <form action="{{ route('admin.bootcamps.update', [$bootcamp->id]) }}" method="post" class="save"
          id="articleForm" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات بوت کمپ</h3>
                    </div>
                    <div class="card-body">
                        <div class="heading">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="control-label">عنوان بوت کمپ</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="title" value="{{ old('title',$bootcamp->title) }}"
                                               class="form-control" id="title"
                                               placeholder="عنوان را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subtitle" class="control-label">رو تیتر</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="subtitle" value="{{ old('subtitle',$bootcamp->subtitle) }}"
                                               class="form-control" id="sections"
                                               placeholder="رو تیتر را اینجا وارد کنید..." required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">استادان</label><span class="text-danger">&starf;</span>
                                        <select class="form-control" id="properties" name="professors[]" multiple>
                                            @foreach($professors as $professor)
                                            <option  value="{{$professor->id}}"  @selected(in_array($professor->id, old('professors', $bootcamp->professors->pluck('id')->all())))>{{$professor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">تصویر اصلی</label>
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time" class="control-label">مدت زمان</label><span class="text-danger">&starf;</span>
                                        <input type="text" name="time" value="{{ old('time',$bootcamp->time) }}"
                                        class="form-control" id="time"
                                        placeholder="زمان دوره را وارد کنید..." required>
                                        <span class="text-info">لطفا زمان دوره(ساعت) را وارد کنید.</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div
                                        class="form-group">
                                        <label for="price" class="control-label">قیمت (تومان)</label>
                                        <input type="text" name="price" @if (!$bootcamp->price) value="{{ old('price') }}" 
                                            @else value="{{ old('price',number_format($bootcamp->price)) }}"
                                            @endif
                                            class="form-control comma" id="price"
                                            placeholder="قیمت را اینجا وارد کنید...">
                                        <span class="text-info">اگر قیمت را وارد نکنید دوره رایگان می باشد.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label">ویدیو</label>
                                            <input class="form-control" type="file" name="video">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div
                                    class="form-group">
                                        <label for="discount" class="control-label">تخفیف (تومان)</label>
                                        <input type="text" name="discount" value="{{ old('discount',number_format($bootcamp->discount)) }}"
                                        class="form-control comma" id="discount"
                                        placeholder="تخفیف را اینجا وارد کنید...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contacts" class="control-label">مخاطبین</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="contacts" value="{{ old('contacts',$bootcamp->contacts) }}"
                                            class="form-control" id="contacts"
                                            placeholder="مخاطبین را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gifts" class="control-label">هدایا</label>
                                        <input type="text" name="gifts" value="{{ old('gifts',$bootcamp->gifts) }}"
                                            class="form-control" id="gifts"
                                            placeholder="هدایا را اینجا وارد کنید...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="control-label">نوع آموزش</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="type" value="{{ old('type',$bootcamp->type) }}"
                                        class="form-control" id="contacts"
                                        placeholder="نوع آموزش را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from_published_at_show" class="control-label">زمان برگزاری</label>
                                        <input class="form-control fc-datepicker" id="from_published_at_show" type="text"
                                            autocomplete="off" placeholder="زمان برگزاری را انتخاب کنید" />
                                        <input name="published_at" id="from_published_at_hide" type="hidden"
                                            value="{{ old('published_at', $bootcamp->published_at) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eventplace" class="control-label">محل برگزاری</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="eventplace" value="{{ old('eventplace',$bootcamp->eventplace) }}"
                                        class="form-control" id="contacts"
                                        placeholder="محل برگزاری را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="support" class="control-label">پشتیبانی</label>
                                        <input type="text" name="support" value="{{ old('support',$bootcamp->support) }}"
                                            class="form-control" id="support"
                                            placeholder="پشتیبانی را اینجا وارد کنید...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="catering" class="control-label">پذیرایی</label>
                                        <input type="text" name="catering" value="{{ old('catering',$bootcamp->catering) }}"
                                            class="form-control" id="catering"
                                            placeholder="پذیرایی را اینجا وارد کنید...">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="short_description"  class="control-label">توضیحات کوتاه</label>
                                        <span class="text-danger">&starf;</span>
                                        <textarea class="form-control" placeholder="لطفا متن خود را وارد کنید" name="summary" required>{{ old('summary',$bootcamp->summary) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="prerequisite" class="control-label">پیش نیاز</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="prerequisite"  value="{{ old('prerequisite',$bootcamp->prerequisite) }}"
                                        class="form-control" id="prerequisite"
                                        placeholder="پیش نیاز را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div
                                        class="form-group">
                                        <label for="description" class="control-label">توضیحات</label> <span class="text-danger">&starf;</span>
                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                                <textarea class="ckeditor form-control" id="ckEditor" name="description">{!! old('description',$bootcamp->description) !!}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">از ساعت تا ساعت</label><span class="text-danger">&starf;</span>
                                        <input class="form-control" type="text" name="fromhours" value="{{ old('fromhours',$bootcamp->fromhours) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">لینک ویدیو</label>
                                        <input class="form-control" type="text" name="link_video"  value="{{ old('link_video',$bootcamp->link_video) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="control-label">ظرفیت هنرجویان</label><span class="text-danger">&starf;</span>
                                        <input class="form-control" type="number" name="count_users"  value="{{ old('count_users',$bootcamp->count_users) }}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="label" class="control-label"> وضعیت: </label>
                                        <label class="custom-control custom-checkbox">
                                          <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            name="status"
                                            id="status"
                                            value="1"
                                            {{ old('status', $bootcamp->status) == 1 ? 'checked' : null }}
                                          />
                                          <span class="custom-control-label">فعال</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                    <label for="label" class="control-label">در حال ثبت نام: </label>
                                        <label class="custom-control custom-checkbox">
                                          <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            name="is_registers"
                                            id="is_registers"
                                            value="1"
                                            {{ old('is_registers', $bootcamp->is_registers) == 1 ? 'checked' : null }}
                                          />
                                          <span class="custom-control-label">فعال</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                    <label for="label" class="control-label"> برگزار شده: </label>
                                        <label class="custom-control custom-checkbox">
                                          <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            name="its_over"
                                            id="its_over"
                                            value="1"
                                            {{ old('its_over', $bootcamp->its_over) == 1 ? 'checked' : null }}
                                          />
                                          <span class="custom-control-label">فعال</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات سئو</h3>
                    </div>
                    <div class="card-body">
                        <div class="heading">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="slug" class="control-label">نامک (slug)</label><span class="text-danger">&starf;</span>
                                        <input type="text" name="slug" value="{{ old('slug',$bootcamp->slug) }}"
                                               class="form-control" id="slug"
                                               placeholder="نامک را اینجا وارد کنید...">
                                        <span class="text-info">افزودن نامک برای SEO مفید است.</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image_alt" class="control-label">الت تصویر</label>
                                        <input type="text" name="image_alt" value="{{ old('image_alt',$bootcamp->image_alt) }}"
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
                                                  rows="2">{{ old('meta_title',$bootcamp->meta_title) }}</textarea>
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
                                                  rows="3">{{ old('meta_description',$bootcamp->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="canonical_tag" class="control-label">تگ canonical</label>
                                        <input type="text" class="form-control" name="canonical_tag" value="{{ old('canonical_tag',$bootcamp->canonical_tag) }}" placeholder="در صورت نیاز تگ canonicalرا وارد کنید">
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="control-label">متا ربات<span class="text-danger">&starf;</span></p>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="meta_robots"
                                            {{ $bootcamp->meta_robots ? ' checked' : '' }}
                                        >
                                        <span class="custom-control-label">فعال</span>
                                    </label>
                                </div>
                            </div>

                            <hr>
                            <div class="row mt-2">
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
        </div>


    </form>
@endsection

@section('scripts')
    @include('bootcamp::admin.bootcamp.date-input-script', [
        'dateInputId' => 'from_published_at_hide',
        'textInputId' => 'from_published_at_show',
    ])
    <!-- INTERNAL File uploads js -->
    <script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
    <!-- Summernote js  -->
    {{-- <script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/lang/summernote-fa-IR.min.js') }}"></script> --}}
    <script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>

        $('#properties').select2({
            minimumResultsForSearch: '',
            tags: true
        });
        // $('#ckEditor').ckeditor();
        let options = {
            filebrowserImageBrowseUrl: '/admin/FileManager?type=Images',
            filebrowserImageUploadUrl: '/admin/FileManager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/FileManager?type=Files',
            filebrowserUploadUrl: '/admin/FileManager/upload?type=Files&_token='
        };
    </script>
@endsection
