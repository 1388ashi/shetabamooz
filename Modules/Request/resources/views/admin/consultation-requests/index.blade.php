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
            <li class="breadcrumb-item active" aria-current="page">لیست درخواست های مشاوره</li>
        </ol>
{{--        <div class="mt-3 mt-lg-0">--}}
{{--            <div class="d-flex align-items-center flex-wrap text-nowrap">--}}
{{--                <a href="{{ route('admin.requests.create')}}" class="btn btn-twitter">--}}
{{--                    ثبت درخواست جدید--}}
{{--                    <i class="fa fa-plus"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه درخواست های مشاوره ({{ $requests->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.consultation-requests.index')}}"
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
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="wd-25p border-bottom-0" style="width: 10%;">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-10p border-bottom-0" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($requests as $request)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$request->id}}"></td>
                                    <td>{{$request->id}}</td>
                                    <td>{{Str::limit($request->name,30)}}</td>
                                    <td>@include('components.checked',['status' => $request->status])</td>
                                    <td>
                                        <a href="{{route('admin.consultation-requests.show',$request->id)}}" data-original-title="نمایش" data-toggle="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
{{--                                        <a href="{{route('admin.requests.edit',$request->id)}}" data-original-title="ویرایش" data-toggle="tooltip" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>--}}
{{--                                        --}}{{-- Delete --}}
{{--                                        <button class="btn btn-danger btn-sm text-white" data-original-title="حذف" data-toggle="tooltip"--}}
{{--                                                onclick="confirmDelete('delete-{{ $request->id }}')"{{ $request->isDeletable() ? '' : ' disabled' }}>--}}
{{--                                            <i class="fa fa-trash-o"></i></button>--}}
{{--                                        <form action="{{route('admin.requests.destroy',$request->id)}}"--}}
{{--                                              method="post" id="delete-{{ $request->id }}" style="display: none">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ درخواستی وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$requests->links()}}
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


    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @include('core::includes.delete-all-script', [$model_name = 'consultation-requests'])

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


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.closest('form').submit();
                }
            });
        });
    </script>

@endsection
