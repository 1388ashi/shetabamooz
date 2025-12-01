@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست کاربران مسابقه</li>
        </ol>
        <form action="{{ route('admin.game-users.index') }}" method="GET">  
            <input type="hidden" name="game_id" value="{{ request('game_id') }}">  
            <input type="hidden" name="export" value="excel">  
            <button type="submit" class="btn btn-primary">خروجی اکسل</button>  
        </form>
    </div>
    <!--  Page-header closed -->

    <!-- row opened -->
    <div class="row">
        <div class="col-12">
        @include('game::admin.users.filter')
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
                        <form action="{{ route('admin.game-users.changeStatusSelectedUsers') }}" method="post" id="myForm">
                            <input type="hidden" id="output" name="status" value="">
                            @csrf
                            <thead>
                            <tr>
                                <th class="border-top">انتخاب</th>
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class="border-top">@sortablelink('name', 'نام و نام خانوادگی')</th>
                                <th class="border-top">@sortablelink('mobile', 'شماره موبایل')</th>
                                <th class="border-top">مسابقه</th>
                                <th class="border-top">@sortablelink('status', 'وضعیت')</th>
                                <th class="border-top">تاریخ ارسال</th>
                                <th class="border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $i => $user)
                                <tr>
                                    <td><input type="checkbox" class="checkbox toggleCheckbox"
                                        name="ids[]"
                                        value="{{ $user->id }}">
                                    </td>
                                    <td>{{++$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>
                                        @foreach ($user->games as $game)
                                        {{$game->title}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @include('game::admin.users.status', ['status' => $user->status])
                                    </td>
                                    <td>{{verta($user->created_at)->format('Y/m/d H:i')}}</td>
                                    <td>
                                        <button data-toggle="modal" data-original-title="ویرایش" type="button" data-target="#edit-status-{{ $user->id }}" class="btn btn-warning btn-sm text-white">
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
    @include('game::admin.users.edit-status')
    @include('game::admin.users.edit')
    @endsection


