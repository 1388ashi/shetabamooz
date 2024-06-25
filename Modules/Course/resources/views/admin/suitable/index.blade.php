@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" href="{{asset('assets\plugins\sweet-alert\jquery.sweet-modal.min.css')}}}">
@endsection

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست سوییتیبل ها </li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <button type="button" class="btn btn-twitter" data-toggle="modal" data-target="#store-suitable">
                    ثبت سوییتیبل جدید
                    <i class="fa fa-plus"></i>
                </button>
                <div class="modal fade" id="store-suitable" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ثبت سوییتیبل جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.suitables.store') }}" method="post" class="save">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="label" class="control-label">عنوان سوییتیبل</label> <span
                                                    class="text-danger">&starf;</span>
                                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                                       id="title"
                                                       placeholder="عنوان را اینجا وارد کنید" required>
                                            </div>


                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="label" class="control-label">وضعیت</label> <span
                                                    class="text-danger">&starf;</span>

                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="status" value="1" checked>
                                                    <span class="custom-control-label">فعال</span>
                                                </label>
                                            </div>

                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="label" class="control-label">مناسب/نامناسب</label> <span
                                                    class="text-danger">&starf;</span>

                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="like" value="1" checked>
                                                    <span class="custom-control-label">مناسب</span>
                                                </label>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="category" class="control-label">دوره</label>
                                                    <span class="text-danger">&starf;</span>
                                                    <select name="course" id="course" class="form-control">
                                                        @foreach($courses as $course)
                                                            <option value="{{ $course->id }}">
                                                                {{ $course->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                        لیست همه سوییتیبل ها
                        ({{ $suitables->total() }})
                    </div>
                    <!--search-->
                    <form method="get" id='basicSearch' action="{{route('admin.suitables.index')}}"
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
                                <th class="wd-20p border-bottom-0">@sortablelink('title', 'عنوان')</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('status', 'وضعیت')</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('like', 'مناسب')</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('like', 'دوره')</th>
                                <th class="wd-25p border-bottom-0">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-bottom-0">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($suitables as $suitable)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" data-id="{{ $suitable->isDeletable() ? $suitable->id : '' }}" {{ $suitable->isDeletable() ? '' : ' disabled' }}>
                                    </td>
                                    <td>{{ $suitable->id }}</td>
                                    <td>{{ $suitable->title }}</td>
                                    <td>@include('components.status', ['status' => $suitable->status])</td>
                                    <td>@include('components.like',['like' => $suitable->like ])</td>
                                    <td>{{$suitable->course->title}}</td>
                                    <td>{{verta($suitable->created_at)->formatDate()}}</td>
                                    <td>
                                        {{-- Edit --}}
                                        <span data-toggle="modal" data-target="#editsuitable">
                                        <a href="#" onclick="editsuitable(this);validate();" class="btn btn-warning btn-sm text-white" data-target="#editsuitable" data-original-title="ویرایش"
                                           data-toggle="tooltip" data-id="{{$suitable->id}}" data-title="{{$suitable->title}}" data-course="{{$suitable->course_id}}" data-like="{{$suitable->like}}" data-status="{{$suitable->status}}"><i class="fa fa-pencil"></i></a>
                                        </span>
                                        {{-- Delete --}}
                                        <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="حذف" data-placement="top" data-original-name="حذف" onclick="confirmDelete('delete-{{ $suitable->id }}')"{{ $suitable->isDeletable() ? '' : ' disabled' }}>
                                            <i class="fa fa-trash-o"></i></button>
                                        <form action="{{route('admin.suitables.destroy',$suitable->id)}}" method="post" id="delete-{{ $suitable->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر هیچ سوییتیبل وجود ندارد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--modal here-->


                    <div class="modal fade" id="editsuitable" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ویرایش سوییتیبل</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.suitables.modalUpdate') }}" method="post" class="save" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                    <label for="label" class="control-label">عنوان سوییتیبل</label> <span
                                                        class="text-danger">&starf;</span>
                                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                                           id="title"
                                                           placeholder="عنوان را اینجا وارد کنید" required>

                                                </div>



                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                    <label for="label" class="control-label">وضعیت</label> <span
                                                        class="text-danger">&starf;</span>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="status1" name="status" >
                                                        <span class="custom-control-label">فعال</span>
                                                    </label>
                                                </div>



                                                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                    <label for="label" class="control-label">مناسب/نامناسب</label> <span
                                                        class="text-danger">&starf;</span>

                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="like" id="like1" >
                                                        <span class="custom-control-label">مناسب</span>
                                                    </label>
                                                </div>

{{--                                                <div class="col-sm-6">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="category" class="control-label">دوره</label>--}}
{{--                                                        <span class="text-danger">&starf;</span>--}}
{{--                                                        <select name="course" id="course1" class="form-control">--}}
{{--                                                            @foreach($courses as $course)--}}
{{--                                                                <option value="{{ $course->id }}"--}}
{{--                                                                    @if(isset($suitable))--}}
{{--                                                                        @if($course->id == old('course_id'))--}}
{{--                                                                            selected--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}
{{--                                                                >--}}
{{--                                                                    {{ $course->title }}--}}
{{--                                                                </option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}


                                                <input type="text" hidden id='status'>
                                                <input type="text" hidden id='like'>

                                                <script type="text/javascript">
                                                    function validate() {
                                                        document.getElementById("status1").checked = document.getElementById('status').value === '1';
                                                        document.getElementById("like1").checked = document.getElementById('like1').value === '1';
                                                        document.getElementById("course1").checked = document.getElementById('course1').value === '1';
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
                        function editsuitable(el) {
                            var link = $(el) //refer `a` tag which is clicked
                            var modal = $("#editsuitable") //your modal
                            var title = link.data('title')
                            var like = link.data('like')
                            var status = link.data('status')
                            var course=link.data('course_id')
                            var id = link.data('id')
                            modal.find('#title').val(title);
                            modal.find('#status').val(status);
                            modal.find('#like1').val(like);
                            modal.find('#course1').val(course)
                            modal.find('#id').val(id);
                        }
                    </script>
                    {{$suitables->links()}}

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
    @include('core::includes.delete-all-script',[$route = 'admin.suitables.multipleDelete'])

@endsection
