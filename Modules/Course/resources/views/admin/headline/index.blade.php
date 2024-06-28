@extends('layouts.admin.master')
@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}"><i
                            class="fe fe-life-buoy ml-1"></i>
                    لیست دوره ها</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.courses.show', $course->id) }}"><i
                            class="fe fe-life-buoy ml-1"></i>
                    نمایش دوره</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست سرفصل های دوره</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                    @include('course::admin.headline.create-headline-modal', compact('course'))
            </div>
        </div>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">سرفصل های دوره - <span class="text-info"><a
                            href="{{ route('admin.courses.show', $course->id) }}">{{ $course->title }}</a></span>
                    </div>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                    class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                    class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">@sortablelink('id', 'ردیف')</th>
                                <th class=" border-top" >@sortablelink('title', 'عنوان')</th>
                                <th class=" border-top" >@sortablelink('descrition', 'توضیحات')</th>
                                <th class=" border-top">@sortablelink('created_at', 'تاریخ ثبت')</th>
                                <th class="wd-10p border-top" >عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($headlines as $i => $headline)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ Str::limit($headline->title, 30) }}</td>
                                    <td>{{ Str::limit($headline->description, 30) }}</td>
                                    <td>{{ verta($headline->created_at) }}</td>
                                    <td class="text-center">
                                        <button  class="btn btn-warning btn-sm mr-3"
                                           data-toggle="modal" data-target="#edit-{{ $headline->id }}">
                                           <i class="fa fa-pencil"></i>
                                        </button>
                                        <button  class="btn btn-danger btn-sm mr-3"
                                        onclick="confirmDelete('delete-{{ $headline->id }}')" ><i
                                                 class="fa fa-trash text-white"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        <p class="text-danger"><strong>در حال حاضر
                                                هیچ سر فصلی
                                                یافت نشد!</strong></p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        </div>
                </div>
                <!-- table-wrapper -->

                @foreach($headlines as $headline)
                        <!-- Modal -->
                        <div class="modal fade" id="edit-{{ $headline->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="modelTitleId"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">ویرایش سرفصل : {{ $headline->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.course-headlines.update', $headline->id) }}"
                                              method="post"
                                              class="save">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title{{ $headline->id }}" class="control-label">عنوان
                                                            <span class="text-danger">&starf;</span></label>
                                                            <input type="text" class="form-control" name="title"
                                                            id="title{{ $headline->id }}"
                                                            placeholder="عنوان را اینجا وارد کنید"
                                                               value="{{ old('title', $headline->title) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description"  class="control-label">توضیحات</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <textarea class="form-control" id="description" placeholder="توضیحات خود را وارد کنید" name="description" required>{{ old('description', $headline->description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="course_id" value="{{ $course->id  }}">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-center">
                                                        <button class="btn btn-warning" type="submit">به روزرسانی
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.course-headlines.destroy', $headline->id) }}" method="post"
                              id="delete-{{ $headline->id }}" style="display: none">
                            @csrf
                            @method('DELETE')
                        </form>
                @endforeach

            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/sortable.min.js') }}"></script>
    <script>
        let el = document.getElementById('tree1');
        let sortable = Sortable.create(el);
    </script>
@endsection
