@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}">
    <link rel="stylesheet" href="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.style.css')}}">
    <style>
        .text-bold{
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست پستها</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.posts.create')}}" class="btn btn-twitter">
                    ثبت پست جدید
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <!--  Page-header closed -->
<!------->

<!------->
    <!--advance search-->
    <form method="get" action="{{route('admin.posts.index')}}"
          autocomplete="off"
          onblur="document.form1.input.value = this.value;">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12" >
                {{--            <div class="card card-collapsed">--}}
                <div class="card">
                    <div class="card-header  border-0">
                        <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">جستجو پیشرفته</div>
                        <div class="card-options">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse" style="margin: 5px;"><i
                                    class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen" style="margin: 5px;"><i
                                    class="fe fe-maximize"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove" style="margin: 5px;"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <p class="form-label">متن جستجو</p>
                                            <input type="search" name="keyword" class="form-control header-search"
                                                   placeholder="به دنبال چه هستید؟"
                                                   aria-label="Search" tabindex="500">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">دسته بندی</label>
                                            <select class="form-control custom-select select2 js-example-basic-multiple " multiple name="categoryIds[]" data-placeholder="دسته بندی را انتخاب کنید ...">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <p class="form-label">وضعیت </p>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                <span class="custom-control-label">فعال</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">از تاریخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" id="from_date_show" placeholder="تاریخ شروع..." type="text">
                                        <input hidden name="from_date" id="from_date" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">تا تاریخ</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker" id="to_date_show" placeholder="تاریخ پایان..." type="text">
                                        <input hidden name="to_date" id="to_date" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group mt-5">
                                    <button type="submitx" class="btn btn-primary btn-block">جستجو</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end advance Search-->
    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه پستها ({{ $posts->total() }})
                    </div>
                    <!--search-->
{{--//--}}
                    <!---->
                    <div class="card-options">
                        <div class="container-fluid">
                            <button class="btn btn-danger btn-xs delete-all" data-url="">حذف انتخاب شده ها</button>
                        </div>
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0" style="width: 5%;"><input type="checkbox" id="check_all"></th>
                                <th class="wd-1p border-bottom-0" style="width: 10%;">@sortablelink('id', 'شناسه')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('id', 'تصویر')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('title', 'عنوان')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('id', 'تعداد بازدید')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('created_at', 'تاریخ انتشار')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$post->id}}"></td>
                                    <td>{{$post->id}}</td>
                                    <td>
                                        @if($post->image)
                                            <img src="{{$post->image}}" alt="image" class="img-fluid rounded">
                                        @endif
                                    </td>
                                    <td>{{ Str::limit(verta($post->created_at->toDateString()),11,'') }}</td>
                                    <td>{{Str::limit($post->title,30)}}</td>
                                    <td>{{views($post)->unique()->count()}}</td>
                                    <td>{{verta($post->published_at)->formatDate()}}</td>
                                    <td>@include('components.status', ['status' => $post->status])</td>
                                    <td>
                                        <a href="{{route('admin.posts.show',[$post->slug])}}" data-original-title="نمایش" data-toggle="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('admin.posts.edit',$post->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-original-title="حذف" data-toggle="tooltip"
                                                onclick="confirmDelete('delete-{{ $post->id }}')"{{ $post->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.posts.destroy',$post->id)}}"
                                              method="post" id="delete-{{ $post->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ پستی وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$posts->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->

    <hr>
@endsection

@section('scripts')


    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <!--datetime pecker-->
    <script src="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script type="text/javascript">
        var $fromDate = new Date({{request('from_date')}});
        var $toDate = new Date({{request('to_date')}});

        $('#from_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#from_date',
            targetTextSelector: '#from_date_show',
            englishNumber: false,
            fromDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });

        $('#to_date_show').MdPersianDateTimePicker({
            targetDateSelector: '#to_date',
            targetTextSelector: '#to_date_show',
            englishNumber: false,
            toDate:true,
            enableTimePicker: false,
            dateFormat: 'yyyy-MM-dd',
            textFormat: 'yyyy-MM-dd',
            groupId: 'rangeSelector1',
        });


        @include('core::includes.delete-all-script', [$model_name = 'posts'])

    </script>

@endsection
