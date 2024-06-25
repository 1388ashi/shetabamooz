@extends('layouts.admin.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}"
          xmlns="http://www.w3.org/1999/html">
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
            <li class="breadcrumb-item active" aria-current="page">لیست کامنتها</li>
        </ol>
{{--        <div class="mt-3 mt-lg-0">--}}
{{--            <div class="d-flex align-items-center flex-wrap text-nowrap">--}}
{{--                <a href="{{ route('admin.post-comments.create')}}" class="btn btn-twitter">--}}
{{--                    ثبت کامنت جدید--}}
{{--                    <i class="fa fa-plus"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!--  Page-header closed -->
<!------->

<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه کامنتها ({{ $comments->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.post-comments.index')}}"
                          autocomplete="off"
                          onblur="document.form1.input.value = this.value;" class="form-inline mr-4">
                        <div class="search-element">
                            <input type="search" name="keyword" class="form-control header-search" placeholder="جستجو..."
                                   aria-label="Search" tabindex="55">
                            <button class="btn btn-primary">
                                <i class="feather feather-search"></i>
                            </button>
                        </div>
                    </form>
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
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('name', 'نام کاربر')</th>
{{--                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('email', 'ایمیل کاربر')</th>--}}
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('body', 'متن')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('post_id', 'پست')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($comments as $comment)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$comment->id}}"></td>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->name}}</td>
{{--                                    <td>{{$comment->email}}</td>--}}
                                    <td>{{Str::limit($comment->text,20)}}</td>
                                    <td>@include('components.category', ['category' => $comment->post->title])</td>
                                    <td>
                                        @if($comment->status == '0')
                                            <form action="{{route('admin.post-comments.makeAvailable',$comment->id)}}" method="post" style="display: inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm
                                                @if($comment->status == '1')
                                                    btn disabled
                                                @endif
                                                    "
                                                ><i class="fa fa-check"></i><!--Accept-->
                                                </button>
                                            </form>
                                        @endif
                                        @if($comment->status == '1')
                                            <form action="{{route('admin.post-comments.makeInAvailable',$comment->id)}}" method="post" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm
                                                @if($comment->status == '0')
                                                    btn disabled
                                                @endif
                                                    "
                                                ><i class="fa fa-close"></i><!--UnAccept-->
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{route('admin.post-comments.show',$comment->id)}}" data-original-title="نمایش" data-toggle="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
{{--                                        <a href="{{route('admin.post-comments.edit',$comment->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>--}}
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-original-title="حذف" data-toggle="tooltip"
                                                onclick="confirmDelete('delete-{{ $comment->id }}')"{{ $comment->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.post-comments.destroy',$comment->id)}}"
                                              method="post" id="delete-{{ $comment->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ کامنتی وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$comments->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('scripts')


    <script src="{{asset('assets\plugins\sweet-alert\sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @include('core::includes.delete-all-script', [$model_name = 'post-comments'])


@endsection
