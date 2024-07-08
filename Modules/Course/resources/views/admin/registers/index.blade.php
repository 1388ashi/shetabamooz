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
            <li class="breadcrumb-item active" aria-current="page">لیست کاربران دوره</li>
        </ol>
    </div>
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header border-0">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه کاربران دوره ({{ $registers->total() }})
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="wd-1p border-top" style="width: 10%;">ردیف</th>
                                <th class="wd-25p border-top" style="width: 10%;">نام و نام خانوادگی</th>
                                <th class="wd-25p border-top" style="width: 10%;">شماره تماس</th>
                                <th class="wd-25p border-top" style="width: 10%;">دوره</th>
                                <th class="wd-25p border-top" style="width: 10%;">وضعیت</th>
                                <th class="wd-25p border-top" style="width: 10%;">تاریخ ارسال</th>
                                <th class="wd-10p border-top" style="width: 10%;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($registers as $i => $register)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{Str::limit($register->name,30)}}</td>
                                    <td>{{Str::limit($register->mobile,30)}}</td>
                                    <td>{{$register->course->title}}</td>
                                    <td>@include('components.checked',['status' => $register->status])</td>
                                    <td>{{verta($register->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" data-target="#edit-menu-{{ $register->id }}"  class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ  وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$registers->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
    @include('course::admin.registers.edit')
@endsection

@section('scripts')


    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @include('core::includes.delete-all-script', [$model_name = 'cooperation-requests'])

    <!--datetime pecker-->
    <script src="{{asset('assets/PersianDateTimePicker-bs4/dist/jquery.md.bootstrap.datetimepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script type="text/javascript">
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
