@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb align-items-baseline">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست برچسب ها </li>
        </ol>
        {{-- <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <a href="{{ route('admin.place.create') }}" class="btn btn-twitter">
                    ثبت برچسب جدید <i class="fa fa-plus align-middle"></i>
                </a>
            </div>
        </div> --}}
    </div>
    <!--  Page-header closed -->
{{--    <form method="get" id='basicSearch' action="{{ route('admin.tags.index') }}" autocomplete="off"--}}
{{--    onblur="document.form1.input.value = this.value;">--}}
{{--    <div class="row">--}}
{{--        <div class="col-xl-12 col-md-12 col-lg-12">--}}
{{--            --}}{{-- <div class="card card-collapsed"> --}}
{{--            <div class="card">--}}
{{--                <div class="card-header  border-0">--}}
{{--                    <div class="card-title" data-toggle="card-collapse" style="font-size: 16px;font-weight: bold;">--}}
{{--                        جستجوی پیشرفته</div>--}}
{{--                    <div class="card-options">--}}
{{--                        <a href="#" class="card-options-collapse" data-toggle="card-collapse" style="margin: 5px;"><i--}}
{{--                                class="fe fe-chevron-up"></i></a>--}}
{{--                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"--}}
{{--                            style="margin: 5px;"><i class="fe fe-maximize"></i></a>--}}
{{--                        <a href="#" class="card-options-remove" data-toggle="card-remove" style="margin: 5px;"><i--}}
{{--                                class="fe fe-x"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="align-items-end row col-6">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="search" name="keyword" class="form-control header-search"--}}
{{--                                    placeholder="جستجو..." aria-label="Search" tabindex="55">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-12 row align-items-end">--}}
{{--                            <div class="form-group col-5">--}}
{{--                                <label for="status"> دسته تگ ها </label>--}}
{{--                                <select class="form-control" name="tag_type" id="view_select">--}}
{{--                                    <option value="">مهم نیست</option>--}}
{{--                                    <option value="{{$tagTypes[0]}}">بلاگ</option>--}}
{{--                                    <option value="{{$tagTypes[1]}}">دوره </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-7">--}}
{{--                                <div class="form-group">--}}
{{--                                    <button type="submit" class="btn btn-primary btn-block">جستجو</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row align-items-end">--}}
{{--                        --}}{{-- <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="status">وضعیت بررسی</label>--}}
{{--                                <select class="form-control" name="check_select" id="check_select" class="toggles_date_picker" data-target="{{$contact_settings['date_subjects']['check']}}">--}}
{{--                                    <option value="">تمامی وضعیت ها</option>--}}
{{--                                    <option value="1">بررسی شده</option>--}}
{{--                                    <option value="2">بررسی نشده</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div> --}}
{{--                        --}}{{-- @include(--}}
{{--                            'contact::admin.components.date_range_picker',--}}
{{--                            [--}}
{{--                                'type' => 'check',--}}
{{--                                'classes' => '',--}}
{{--                                'input_name_prefix' => $contact_settings['date_subjects']['check'],--}}

{{--                            ]--}}
{{--                        ) --}}
{{--                    </div>--}}
{{--                    --}}{{-- <div class="row align-items-end"> --}}
{{--                        --}}{{-- <div class="col-3">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="status">وضعیت مشاهده</label>--}}
{{--                                <select class="form-control" name="view_select" id="view_select">--}}
{{--                                    <option value="">تمامی وضعیت ها</option>--}}
{{--                                    <option value="1">مشاهده شده</option>--}}
{{--                                    <option value="2">مشاهده نشده</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div> --}}
{{--                        --}}{{-- @include(--}}
{{--                            'contact::admin.components.date_range_picker',--}}
{{--                            [--}}
{{--                                'type' => 'view',--}}
{{--                                'classes' => '',--}}
{{--                                'input_name_prefix' => $contact_settings['date_subjects']['view'],--}}

{{--                            ] --}}
{{--                        --}}{{-- ) --}}
{{--                    --}}{{-- </div> --}}


{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}
    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">لیست همه برچسب ها
                        ({{ $tags->total() }})</div>

                        <form method="get" id='basicSearch' action="{{route('admin.tags.index')}}"
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
                <div class="card-body">
                    <div class="table-responsive table-sm col-7">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th class="wd-20p border-bottom-0" style="width: 5px;"><input type="checkbox"
                                        id="check_all"></th>
                                    <th> @sortablelink('id','شناسه')</th>
                                    <th> @sortablelink('name','عنوان')</th>
                                    <th> @sortablelink('type','دسته برچسب')</th>
                                    {{-- <th> تعداد استفاده</th> --}}
                                    {{-- <th class="wd-25p border-bottom-0"> @sortablelink('address','ادرس')</th> --}}
                                    {{-- <th class="wd-25p border-bottom-0" style="width: 7%;">@sortablelink('status',
                                        'وضعیت')
                                    </th> --}}

                                    <th>عملیات ها</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkbox"
                                                   data-id="{{$tag->id}}">
                                        </td>
                                        <td>{{ $tag->id }}</td>
                                        <td class="tdnowrap">{{ $tag->name }}</td>
                                        <td class="tdnowrap">{{ $tag->type }}</td>
                                        {{-- <td class="tdnowrap">{{ $tag->title }}</td> --}}
                                        {{-- <td class="tdnowrap" style="width: 20%">{{ $tag->address }}</td> --}}




                                        <td>

                                            {{-- Delete --}}
                                            <button class="btn btn-danger btn-sm text-white" type="button" form="delete-{{$tag->id}}"
                                                onclick="confirmDelete('delete-{{ $tag->id }}')"><i
                                                    class="fa fa-trash-o"></i></button>
                                            <form action="{{ route('admin.tags.destroy', [$tag->id]) }}" method="POST"
                                                id="delete-{{ $tag->id }}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-danger"><strong>در حال حاضر هیچ برچسبی ثبت نشده است</strong>
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        {{ $tags->links() }}

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
<script type="text/javascript">
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

    @include('core::includes.delete-all-script', [$route = 'admin.tags.multipleDelete'])

</script>
@endsection
