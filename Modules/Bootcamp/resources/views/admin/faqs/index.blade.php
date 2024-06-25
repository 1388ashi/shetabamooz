@extends('layouts.admin.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}">
    <link rel="stylesheet" href="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست سوالات</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.faqs.create',['course' => request()->route('course')])}}" class="btn btn-twitter">
                    ثبت سوال جدید
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <!--  Page-header closed -->

    <!--advance search-->
    <form method="get" action="{{route('admin.faqs-list',request()->route('course'))}}"
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
{{--                                    <div class="col-md-5">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="form-label">دسته بندی</label>--}}
{{--                                            <select class="form-control custom-select select2 js-example-basic-multiple " multiple name="categoryIds[]" data-placeholder="دسته بندی را انتخاب کنید ...">--}}
{{--                                                @foreach($categories as $category)--}}
{{--                                                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col">
                                        <div class="form-group">
                                            <p class="form-label">وضعیت </p>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status" value="1">
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
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه سوالات ({{ $faqs->total() }})
                    </div>
                    <div class="row">
                        <div class="col">
                            <!--search-->
                        </div>
                    </div>
                    <br>
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
                <!---aa-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="wd-20p border-bottom-0" style="width: 5%;"><input type="checkbox" id="check_all"></th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('id', 'ردیف')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('question','پرسش')</th>
{{--                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('answer','پاسخ')</th>--}}
{{--                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('category_id','دسته بندی')</th>--}}
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('course_id','دوره')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('status','وضعیت')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($faqs as $faq)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$faq->id}}"></td>
                                    <td>{{$faq->id}}</td>
                                    <td><p>{{ Str::limit($faq->question, 30)}}</p></td>
{{--                                    <td><p>{{ Str::limit($faqs->answer, 30) }}</p></td>--}}
{{--                                    <td>@include('components.category', ['category' => optional($faqs->category)->name])</td>--}}
                                    <td>@include('components.course', ['course' => $faq->course->title])</td>

                                    <td>@include('components.status', ['status' => $faq->status])</td>

                                    <td>
                                        {{-- show --}}
                                        <a href="{{route('admin.faqs.show',$faq->id)}}" data-original-title="نمایش" data-toggle="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        {{-- eidt --}}
                                        <a href="{{route('admin.faqs.edit',$faq->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-original-title="حذف" data-toggle="tooltip"
                                                onclick="confirmDelete('delete-{{ $faq->id }}')"{{ $faq->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.faqs.destroy',$faq->id)}}"
                                              method="post" id="delete-{{ $faq->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ سوالی ای  وجود ندارد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        {{$faqs->links()}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.js')}}"></script>
    <script src="{{asset('assets\plugins\sweet-alert\sweetalert.min.js')}}"></script>
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
                                    url: '{{ route('admin.faqs.multipleDelete') }}' + '?_token=' + '{{ csrf_token() }}',
                                    type: 'DELETE',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) { //1
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

            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });
        });
    </script>

@endsection
