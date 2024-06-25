@extends('layouts.admin.master')

@section('styles')
{{--    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.style.css')}}">--}}
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
            <li class="breadcrumb-item active" aria-current="page">لیست نظرات</li>
        </ol>
{{--        <div class="mt-3 mt-lg-0">--}}
{{--            <div class="d-flex align-items-center flex-wrap text-nowrap">--}}
{{--                <a href="{{ route('admin.comments.create')}}" class="btn btn-twitter">--}}
{{--                    ثبت نظر جدید--}}
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
                        لیست همه نظرات ({{ $comments->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.comments.index')}}"
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
                                <th class="wd-25p border-bottom-0" style="width: 10%;">ردیف</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('mobile', 'تلفن همراه')</th>
{{--                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('type', 'نوع')</th>--}}
                                <th class="wd-25p border-bottom-0" style="width: 10%;">دوره</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="infinite-scroll">
                            @forelse($comments as $i =>$comment)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$comment->id}}"></td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->mobile }}</td>
{{--                                    <td>{{\Modules\Course\App\Models\CourseComment::getPositionLabelAttribute($comment->type)}}</td>--}}
                                    <td>

                                       @if($comment->course)
                                           {{ $comment->course->title }}
                                       @endif
                                    </td>
                                    <td>{{ verta($comment->created_at)->formatDate() }}</td>
                                    <td>
                                        <a href="{{route('admin.comments.show',$comment->id)}}" data-original-title="نمایش" data-toggle="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('admin.comments.edit',$comment->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-original-title="حذف" data-toggle="tooltip"
                                                onclick="confirmDelete('delete-{{ $comment->id }}')"{{ $comment->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.comments.destroy',$comment->id)}}"
                                              method="post" id="delete-{{ $comment->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ نظری وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    {{$comments->links()}}
    <!-- row closed -->
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

@endsection

@section('scripts')


    <script src="{{asset('assets\plugins\sweet-alert\sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <!--datetime pecker-->

    <script type="text/javascript">

        //////
        $(document).ready(function () {
            if (localStorage.getItem("deletedItems")) {
                swal({
                    title: 'موفق شد!',
                    text: 'آیتم هایی که قابل حذف بودند، با موفقیت حذف شدند!',
                    icon: 'success',
                    dangerMode: false
                })
                localStorage.removeItem("deletedItems", true);
            }
        });

        $(function () {
                if (sessionStorage.reloadAfterPageLoad == true) {
                    swal({
                        title: 'موفق شد!',
                        text: 'آیتم هایی که قابل حذف بودند، با موفقیت حذف شدند!',
                        icon: 'success',
                        dangerMode: false
                    })
                    sessionStorage.reloadAfterPageLoad = false;
                }
            }
        );
        $(document).ready(function () {
            $('#check_all').on('click', function (e) {
                if ($('#check_all').is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });
            $('.checkbox').on('click', function () {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#check_all').prop('checked', true);
                } else {
                    $('#check_all').prop('checked', false);
                }
            });
            $('.delete-all').on('click', function (e) {
                var idsArr = [];
                $(".checkbox:checked").each(function () {
                    idsArr.push($(this).attr('data-id'));
                });
                if (idsArr.length <= 0) {
                    swal({
                        title: 'انتخاب نکردید!',
                        text: 'لطفاً حداقل یک مورد را برای حذف انتخاب کنید',
                        icon: 'warning',
                        dangerMode: true
                    })
                } else {
                    swal({
                        title: 'آیا مطمئن هستید؟',
                        text: 'بعد از حذف این آیتم دیگر قابل بازیابی نخواهد بود!',
                        icon: 'warning',
                        buttons: ["انصراف", "حذف کن"],
                        dangerMode: true
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                var strIds = idsArr.join(",");
                                $.ajax({
                                    url: '{{ route('admin.comments.multipleDelete') }}' + '?_token=' + '{{ csrf_token() }}',
                                    type: 'DELETE',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) {
                                            $(".checkbox:checked").each(function () {
                                                $(this).parents("tr").remove();
                                            });
                                            localStorage.setItem("deletedItems", true);
                                            location.reload();
                                        } else {
                                            swal({
                                                title: 'مشکل!',
                                                text: 'مشکلی در اجرای عملیات رخ داده است. مجدداً تلاش کنید.',
                                                icon: 'warning',
                                                dangerMode: true
                                            })
                                        }
                                    },

                                    error: function (data) {
                                        localStorage.setItem("deletedItems", true);
                                        location.reload();
                                    }
                                });
                            }
                        });
                }
            });
        });
    </script>

@endsection
