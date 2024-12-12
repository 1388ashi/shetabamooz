@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست کاربران بوت کمپ</li>
        </ol>
        <form action="{{ route('admin.users.index') }}" method="GET">  
            <input type="hidden" name="bootcamp_id" value="{{ request('bootcamp_id') }}">  
            <input type="hidden" name="export" value="excel">  
            <button type="submit" class="btn btn-primary">خروجی اکسل</button>  
        </form>
    </div>
    <!--  Page-header closed -->
<!------->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">
        @include('bootcamp::admin.users.filter')
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه کاربران ({{ $users->total() }})
                    </div>
                </div>
                <!---index header closed-->
                <div class="card-body">
                    <div id="buttonsRow" class="hidden mb-3">
                        <button type="button" class="btn btn-sm mr-2 btn-warning" data-target="#changeStatus" data-toggle="modal">تغییر وضعیت</button>
                    </div>
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <form action="{{ route('admin.bootcamp-users.changeStatusSelectedUsers') }}" method="post" id="myForm">
                            <thead>
                            <tr>
                                <th class="wd-20p" style="width: 5%;"><input type="checkbox" id="check_all"></th>
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class="border-top">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="border-top">@sortablelink('mobile', 'شماره موبایل')</th>
                                <th class="border-top">بوت کمپ</th>
                                <th class="border-top">@sortablelink('status', 'وضعیت')</th>
                                <th class="border-top">تاریخ ارسال</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $i => $user)
                                <tr>
                                    <td><input type="checkbox" class="checkbox toggleCheckbox"
                                        value="{{ $user->id }}">
                                    </td>
                                    <td>{{++$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>
                                        @foreach ($user->bootcamps as $bootcamp)
                                        {{$bootcamp->title}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @include('bootcamp::admin.users.status', ['status' => $user->status])
                                    </td>
                                    <td>{{verta($user->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" data-target="#edit-menu-{{ $user->id }}"  class="btn btn-warning btn-sm text-white">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ کاربری وجود ندارد</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </form>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <div class="modal fade" id="changeStatus">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">تغییر وضعیت</p>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <select class="form-control status2" id="status2" required>
                                <option value="">- انتخاب کنید -</option>
                                <option value="present">حاضر در بوتکمپ</option>
                                <option value="absent">غایب در بوتکمپ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="submitButton" type="submit" class="btn btn-primary text-right item-right">ثبت</button>
                    <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">برگشت</button>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    @include('bootcamp::admin.users.edit')
    @endsection
    @section('scripts')

    @include('order::admin.includes.filter-form-scripts')
    @include('order::admin.includes.index-scripts')

    <script>
        
        $('#status2').select2({
            placeholder: 'انتخاب وضعیت'
        });

        document.getElementById('submitButton').addEventListener('click', function() {
            document.getElementById('myForm').submit();
        });


        $('.status-btn').on('click', function() {
            $('.status-btn').removeClass('test').addClass('inactive');
            $(this).removeClass('inactive').addClass('test');
        });

        $(document).ready(function() {

            const statusSelectBox = $('#status2');
            const $outputInput = $('#output');
            const checkAll = $('#check_all');

            statusSelectBox.on('change', function() {
                let selectedValue = statusSelectBox.val();
                $outputInput.val(selectedValue);
                console.log('Selected value: ' + selectedValue);
            });

            checkAll.on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").attr('checked', true);
                } else {
                    $(".checkbox").attr('checked', false);
                }
            });

            checkAll.click(() => {
                $('#buttonsRow').toggleClass('hidden');
                $('#buttonsRow').toggleClass('add');
            });

            $('.toggleCheckbox').on('click', function() {
                const anyChecked = $('.toggleCheckbox:checked').length > 0;

                if (anyChecked) {
                    $('#buttonsRow').removeClass('hidden').addClass('add');
                } else {
                    $('#buttonsRow').addClass('hidden').removeClass('add');
                }
            });
        });

        document.querySelectorAll('.status-btn').forEach(item => {
            item.addEventListener('click', event => {
                document.querySelectorAll('.test').forEach(link => {
                    $(selector).hasClass(className);
                    link.classList.add('inactive');
                });
                item.classList.remove('inactive');
            });
        });

    </script>
@endsection
