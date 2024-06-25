@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.settings.index') }}">لیست
                    تنظیمات</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش تنظیمات</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            @can('create settings')
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-setting">
                    ثبت کلید جدید
                    <i class="fa fa-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="create-setting" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ثبت کلید جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.settings.store', $group) }}" class="save" method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name" class="control-label">نام کلید <span class="text-danger">&starf;</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="نام کلید را به انگلیسی اینجا وارد کنید" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="label" class="control-label">نام قابل خواندن <span class="text-danger">&starf;</span></label>
                                                <input type="text" class="form-control" name="label" id="label" placeholder="نام قابل خواندن را به فارسی اینجا وارد کنید" value="{{ old('label') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="type" class="control-label">نوع کلید</label>
                                                <span class="text-danger">&starf;</span>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option class="text-muted">-- نوع کلید مورد نظر را انتخاب کنید --</option>
                                                    @foreach($types as $key => $value)
                                                        <option value="{{ $key }}" @selected($key == old('type'))>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="text-center">
                                                <button class="btn btn-pink" type="submit">ثبت و ذخیره</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
    <!--  Page-header closed -->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>ویرایش تنظیمات - {{ $group }}</h4>
                </div>
                <div class="card-body">

{{--                    @include('core::includes.validation-errors')--}}

                    <form action="{{ route('admin.settings.update') }}" class="save" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            @foreach($settingTypes as $type => $settings)
                                @if($type == \Modules\Setting\App\Models\Setting::TYPE_TEXT or $type == \Modules\Setting\App\Models\Setting::TYPE_NUMBER)
                                    @foreach($settings as $setting)
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <input type="{{ $type }}" name="{{ $setting->name }}"
                                                       id="{{ $setting->name }}" @if($type == 'number') min="0"
                                                       @endif value="{{ $setting->value }}" class="form-control">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($type == \Modules\Setting\App\Models\Setting::TYPE_IMAGE || $type == \Modules\Setting\App\Models\Setting::TYPE_VIDEO)
                                    @foreach($settings as $setting)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <input type="file" name="{{ $setting->name }}" id="{{ $setting->name }}"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @if($setting->value)
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete('delete-{{ $setting->id }}')">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <br>
                                                @if($type == \Modules\Setting\App\Models\Setting::TYPE_IMAGE)
                                                <figure class="figure">
                                                    <img src="{{ $setting->file['url'] }}" class="img-thumbnail"
                                                         width="50" height="50" alt="{{ $setting->label }}">
                                                    <figcaption
                                                        class="figure-caption text-xs-right">{{ $setting->label }}</figcaption>
                                                </figure>
                                                @elseif($type == \Modules\Setting\App\Models\Setting::TYPE_VIDEO)
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ $setting->file['url'] }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                                @if($type == \Modules\Setting\App\Models\Setting::TYPE_TEXTAREA)
                                    @foreach($settings as $setting)
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <textarea
                                                    class="form-control summernote"
                                                    name="{{ $setting->name }}"
                                                    id="{{ $setting->name }}">{!! $setting->value !!}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($type == \Modules\Setting\App\Models\Setting::TYPE_BOOLEAN)
                                    @foreach($settings as $setting)
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="{{ $setting->name }}">{{ $setting->label }}</label>
                                                <!---->
                                                <input type="checkbox" class="form-check-input" name="{{ $setting->name }}" value="1"
                                                    {{ $setting->value == 1 ? ' checked' : '' }}
                                                >
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">به روزرسانی</button>
                        </div>
                    </form>

                    @foreach($settingTypes as $type => $settings)
                        @if($type == \Modules\Setting\App\Models\Setting::TYPE_IMAGE)
                            @foreach($settings as $setting)
                                <form action="{{ route('admin.settings.deleteFile', [$setting->id]) }}"
                                      id="delete-{{ $setting->id }}" method="post" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')
    <script>
        $(function (e) {
            $('.summernote').summernote({
                placeholder: 'لطفا متن مورد نظر را در این قسمت بنویسید',
                tabsize: 3,
                height: 300
            });
        });
    </script>
@endsection
