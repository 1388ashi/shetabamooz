@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}">
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست دسته بندی ها </li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <button type="button" class="btn btn-twitter" data-toggle="modal" data-target="#store-category">
                    ثبت دسته بندی جدید
                    <i class="fa fa-plus"></i>
                </button>
                <div class="modal fade" id="store-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ثبت دسته بندی جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.course-categories.store') }}" method="post" enctype="multipart/form-data" class="save">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="label" class="control-label">عنوان دسته بندی</label> <span
                                                    class="text-danger">&starf;</span>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                                       id="name"
                                                       placeholder="عنوان را اینجا وارد کنید" required>
                                            </div>

{{--                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">--}}
{{--                                                <label for="label" class="control-label">عکس دسته بندی</label> <span--}}
{{--                                                    class="text-danger">&starf;</span>--}}
{{--                                                <input type="file" name="image" value="{{ old('image') }}"--}}
{{--                                                       id="image" required>--}}
{{--                                            </div>--}}

                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="label" class="control-label">وضعیت</label> <span
                                                    class="text-danger">&starf;</span>


                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                    <span class="custom-control-label">فعال</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <button class="btn btn-primary" type="submit">
                                                ثبت و ذخیره
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Page-header closed -->

    <!-- row opened -->
    @include('components.errors')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <!---index header opened-->
                <div class="card-header">
                    <div class="card-title" style="font-size: 16px;font-weight: bold;">
                        لیست همه دسته بندی ها
                        ({{ $categories->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.course-categories.index')}}"
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
                                <th class="wd-20p border-bottom-0"><input type="checkbox" id="check_all"></th>
                                <th class="wd-20p border-bottom-0">@sortablelink('id', 'ردیف')</th>
{{--                                <th class="wd-20p border-bottom-0">@sortablelink('id', 'تصویر')</th>--}}
                                <th class="wd-20p border-bottom-0">@sortablelink('name', 'عنوان')</th>
                                <th class="wd-20p border-bottom-0">تعداد پست ها</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-bottom-0">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" data-id="{{ $category->isDeletable() ? $category->id : '' }}" {{ $category->isDeletable() ? '' : ' disabled' }}>
                                    </td>
                                    <td>{{ $category->id }}</td>
{{--                                    <td><img src="{{ $category->image }}" alt="category-image" class="img-fluid"></td>--}}
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->courses->count() }}</td>
                                    <td>@include('components.status', ['status' => $category->status])</td>
                                    <td>{{verta($category->created_at)->formatDate()}}</td>
                                    <td>
                                        {{-- Edit --}}
                                        <span data-toggle="modal" data-target="#editCategory">
                                        <a href="#" onclick="editCategory(this);validate();" class="btn btn-warning btn-sm text-white" data-target="#editCategory" data-original-title="ویرایش"
                                           data-toggle="tooltip" data-id="{{$category->id}}" data-name="{{$category->name}}" data-status="{{$category->status}}"><i class="fa fa-pencil"></i></a>
                                        </span>                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="حذف" data-placement="top" data-original-name="حذف" onclick="confirmDelete('delete-{{ $category->id }}')"{{ $category->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.course-categories.destroy',$category->id)}}" method="post" id="delete-{{ $category->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ دسته بندی وجود ندارد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--modal here-->


                    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ویرایش دسته بندی</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.course-categories.modalUpdate') }}" method="post" class="save" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                    <label for="label" class="control-label">عنوان دسته بندی</label> <span
                                                        class="text-danger">&starf;</span>
                                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                                           id="name"
                                                           placeholder="عنوان را اینجا وارد کنید" required>

                                                </div>

{{--                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">--}}
{{--                                                    <label for="label" class="control-label">عکس دسته بندی</label> <span--}}
{{--                                                        class="text-danger">&starf;</span>--}}
{{--                                                    <input type="file" name="image" value="{{ old('image') }}"--}}
{{--                                                           id="image">--}}
{{--                                                </div>--}}


                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                    <label for="label" class="control-label">وضعیت</label> <span
                                                        class="text-danger">&starf;</span>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="status1" name="status" >
{{--                                                        {{ $category->status ? ' checked' : '' }}>--}}
                                                        <span class="custom-control-label">فعال</span>
                                                    </label>
                                                </div>

                                                <input type="text" hidden id='status'>

                                                <script type="text/javascript">
                                                    function validate() {
                                                        document.getElementById("status1").checked = document.getElementById('status').value === '1';
                                                    }
                                                </script>
                                                <input name="id" id="id" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <button class="btn btn-primary" type="submit">
                                                    ثبت و ویرایش
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function editCategory(el) {
                            var link = $(el) //refer `a` tag which is clicked
                            var modal = $("#editCategory") //your modal
                            var name = link.data('name')
                            var image = link.data('image')
                            var status = link.data('status')
                            var id = link.data('id')
                            modal.find('#name').val(name);
                            modal.find('#status').val(status);
                            modal.find('#image').val(image);
                            modal.find('#id').val(id);
                        }
                    </script>
                    {{$categories->links()}}

                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
    <!-- row closed -->


@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){
            if(localStorage.getItem("deletedItems")) {
                swal({
                    title: 'موفق شد!',
                    text: 'آیتم هایی که قابل حذف بودند، با موفقیت حذف شدند!',
                    icon: 'success',
                    dangerMode: false
                })
                localStorage.removeItem("deletedItems", true);
            }
        });

        $( function () {
                if ( sessionStorage.reloadAfterPageLoad == true) {
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

    </script>
    @include('core::includes.delete-all-script', [$model_name = 'course-categories'])

@endsection
