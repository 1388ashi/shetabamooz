@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                لیست مسابقات </li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.games.create')}}" class="btn btn-twitter">
                    ثبت مسابقه جدید
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">لیست
                        همه مسابقه ها ({{ $games->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.games.index')}}"
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
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse" style="margin: 5px;"><i
                                class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen" style="margin: 5px;"><i
                                class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove" style="margin: 5px;"><i class="fe fe-x"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class=" border-top" >@sortablelink('title', 'عنوان')</th>
                                <th class=" border-top" >تصویر</th>
                                <th class=" border-top" >@sortablelink('status', 'وضعیت')</th>
                                <th class=" border-top">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-top" >عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($games as $game)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($game->title, 30) }}</td>
                                    <td class="text-center">
                                        @if ($game->image['url'])
                                        <a href="{{ $game->image['url'] }}" target="_blanck">
                                            <div class="bg-light pb-1 pt-1 img-holder img-show w-100" style="max-height: 50px;border-radius: 4px;">
                                                <img src="{{ $game->image['url'] }}" style="height: 40px;"  alt="{{ $game->image['name'] }}">
                                            </div>
                                        </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>@include('components.status', ['status' => $game->status])</td>
                                    <td>{{ $game->getJalaliCreatedAt() }}</td>
                                    <td>

                                        {{-- <form id="send-sms-form" class="d-none" action="{{route('admin.games.index')}}" method="get">
                                            <input type="hidden" name="send_sms" value="1">
                                            <input type="hidden" name="game_id" value="1">
                                        </form>

                                        <button
                                            onclick="$('#send-sms-form').submit()"
                                            type="button"
                                            class="btn btn-info btn-sm text-white"
                                            data-toggle="tooltip"
                                            title="ارسال sms نظرسنجی"
                                            data-original-title="ارسال sms نظرسنجی">
                                            <i class="fa fa-comment"></i>
                                        </button>    --}}

                                        {{-- <a href="{{route('admin.game-users.index',[$game->id])}}"
                                            class="btn btn-secondary btn-sm text-white" data-toggle="tooltip"
                                            data-original-title="نمایش کابران">
                                             <i class="fa fa-users" data-original-title="mdi-account"></i>
                                         </a> --}}
                                        <button type="button" class="btn btn-secondary btn-sm text-white"
                                            data-toggle="modal"
                                            title="جوایز"
                                            data-target="#edit-gift-{{ $game->id }}">
                                                <i class="fa fa-gift" aria-hidden="true" data-toggle="tooltip"
                                                data-original-title="جوایز"></i>
                                            </button>

                                        {{-- <a href="{{ route('admin.games.show', [$game->id]) }}"
                                            class="btn btn-primary btn-sm text-white" data-toggle="tooltip"
                                            data-original-title="نمایش"><i class="fa fa-eye"></i></a> --}}

                                        {{-- Edit --}}
                                        <a href="{{route('admin.games.edit',[$game->id])}}"
                                           class="btn btn-warning btn-sm text-white" data-toggle="tooltip"
                                           data-original-title="ویرایش"><i class="fa fa-pencil"></i></a>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip"
                                                data-original-title="حذف"
                                                onclick="confirmDelete('delete-{{ $game->id }}')"{{ $game->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.games.destroy',[$game->id])}}"
                                              method="post" id="delete-{{ $game->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر
                                                هیچ مسابقه ای
                                                یافت نشد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        {{ $games->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- table-wrapper -->
            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
    @include('game::admin.gifts.index')
@endsection

@section('scripts')
{{--    @include('core::includes.dates-script')--}}
{{--    @include('core::includes.delete-all-script', [$route = 'admin.courses.multipleDelete'])--}}
@endsection
