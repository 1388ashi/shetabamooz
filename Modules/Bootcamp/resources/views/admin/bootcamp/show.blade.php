@extends('layouts.admin.master')
@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.bootcamps.index') }}">لیست
                    بوت کمپ ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده بوت کمپ</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <a href="{{ route('admin.bootcamps.edit', $bootcamp->id) }}" class="btn btn-warning">
                        ویرایش بوت کمپ
                        <i class="fa fa-edit"></i>
                    </a>
                @include('bootcamp::admin.bootcamp.includes._create-headline-modal', compact('bootcamp'))
            </div>
        </div>
    </div>

    @include('components.errors')

    <!-- Row -->
    <div class="row">
        <div class="col-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h3 class="header p-3">اطلاعات اولیه بوت کمپ</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><b>عنوان: </b>{{ $bootcamp->title }}</li>
                        <li class="list-group-item"><b>قیمت(تومان): </b>{{ $bootcamp->getPrice() }} تومان</li>
                        <li class="list-group-item"><b>  تخفیف(تومان): </b>{{ $bootcamp->discount }}</li>
                        <li class="list-group-item"><b>قیمت با تخفیف : </b>{{number_format($bootcamp->getPriceWithDiscount())}}
                            تومان
                        </li>
                        <li class="list-group-item"><b>مدت زمان بوت کمپ: </b>{{ $bootcamp->time }}ساعت</li>
                        <li class="list-group-item"><b>وضعیت
                                نمایش: </b>@include('components.status', ['status' => $bootcamp->status])</li>
                            <li class="list-group-item"><b>تاریخ برگزاری: </b>{{verta($bootcamp->published_at)->format('Y/m/d H:i')}}</li>
                        <li class="list-group-item"><b>تاریخ ثبت: </b>{{$bootcamp->getJalaliCreatedAt()}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h3 class="header p-3">دسترسی به دیگر اطلاعات بوت کمپ</h3>
                    <div class="row">
                        <div class="col">
                            <p>سرفصل های ثبت شده: {{ $bootcamp->headlines_count }} <a class="btn btn-pink mr-2"
                                                                                    href="{{ route('admin.headlines.index', ['bootcamp_id' => $bootcamp->id]) }}"
                                >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>پرسش متداول های ثبت شده: {{ $bootcamp->faqs_count }} <a class="btn btn-warning mr-2"
                                                                                        href="{{route('admin.faqs-bootcamp',$bootcamp->id)}}"
                                >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h3 class="header p-3">توضیحات</h3>
                    <div>{!! $bootcamp->description !!}</div>
                    <hr>
                    <h3 class="header p-3">عنوان متا</h3>
                    <p>{{ $bootcamp->meta_title }}</p>
                    <hr>
                    <h3 class="header p-3">توضیحات متا</h3>
                    <p>{{ $bootcamp->meta_description }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="header p-3">عکس صفحه اصلی</h3>
                            <img src="{{ $bootcamp->home_image['url'] }}" class="img-fluid rounded-top" alt="{{ $bootcamp->home_image['name'] }}">
                        </div>
                        <div class="col">
                            <h3 class="header p-3">عکس صفحه ثبت نام</h3>
                            <img src="{{ $bootcamp->register_image['url'] }}" class="img-fluid rounded-top" alt="{{ $bootcamp->register_image['name'] }}">
                        </div>
                        <div class="col">
                            <h3 class="header p-3">عکس صفحه داخلی</h3>
                            <img src="{{ $bootcamp->show_image['url'] }}" class="img-fluid rounded-top" alt="{{ $bootcamp->show_image['name'] }}">
                        </div>
                        <div class="col">
                            <h3 class="header p-3">تیزر ویدئویی</h3>
                            @if($bootcamp->teaser_video['url'])
                                <video width="320" height="240" controls>
                                    <source src="{{ $bootcamp->teaser_video['url'] }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($bootcamp->teaser_link)
                                <a href="{{ $bootcamp->teaser_link }}">{{ $bootcamp->teaser_link }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($bootcamp->files->isNotEmpty())
        <div class="row">
            <div class="col">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <h3 class="header p-3">فایل های بوت کمپ</h3>
                        <div class="table-responsive">
                            <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                                <thead>
                                <tr>
                                    <th class="wd-20p border-bottom-0">شناسه</th>
                                    <th class="wd-20p border-bottom-0">نام فایل</th>
                                    <th class="wd-20p border-bottom-0">فرمت</th>
                                    <th class="wd-10p border-bottom-0">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bootcamp->files as $file)
                                    <tr>
                                        <td>{{ $file->id }}</td>
                                        <td>{{ $file->name }}</td>
                                        <td>{{ $file->file['extension'] }}</td>
                                        <td> --}}
                                           {{-- download
                                            <a href="{{ route('admin.files.show', $file->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>

                                                @include('bootcamp::admin.bootcamp.includes._edit-file-modal', compact('file'))

                                            @can('delete files') --}}
                                                {{-- Delete--}}
                                                {{-- <button class="btn btn-danger btn-sm text-white"
                                                        onclick="confirmDelete('delete-{{ $file->id }}')">
                                                    <i class="fa fa-trash-o"></i></button>
                                                <form action="{{ route('admin.files.destroy', $file->id) }}"
                                                      method="post"
                                                      id="delete-{{ $bootcamp->id }}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @can('edit files')
                                @foreach($bootcamp->files as $file) --}}
                                <!-- Modal -->
                                {{-- <div class="modal fade" id="edit-{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ثبت مناسب بوت کمپ - {{ $bootcamp->title }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.files.update', $file->id) }}" method="post" class="save" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="name{{ $file->id }}" class="control-label">نام فایل <span class="text-danger">&starf;</span></label>
                                                                <input type="text" class="form-control" name="name" id="name{{ $file->id }}" placeholder="نام فایل را اینجا وارد کنید" value="{{ old('name', $file->name) }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="file{{ $file->id }}"  class="control-label">فایل</label>
                                                                <input class="form-control" id="file{{ $file->id }}" name="file" type="file">
                                                                <span class="text-muted mt-2">فرمت های مورد قبول: {{ \Modules\bootcamp\App\Models\File::ACCEPTED_MIME_FILES }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="status{{ $file->id }}" class="control-label">وضعیت نمایش</label>
                                                                <span class="text-danger">&starf;</span>
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="status" value="1" @checked(old('status', $file->status))>
                                                                    <span class="custom-control-label">فعال</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="text-center">
                                                                <button class="btn btn-pink" type="submit">به روزرسانی</button>
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
                            @endforeach
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

@endsection
