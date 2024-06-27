@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.bootcamps.index') }}"><i
                            class="fe fe-life-buoy ml-1"></i>
                    لیست بوت کمپ ها</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.bootcamps.show', $bootcamp->id) }}"><i
                            class="fe fe-life-buoy ml-1"></i>
                    نمایش بوت کمپ</a></li>
            <li class="breadcrumb-item active" aria-current="page">لیست سرفصل های بوت کمپ</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                @can('create headlines')
                    @include('bootcamp::admin.bootcamp.includes._create-headline-modal', compact('bootcamp'))
                @endcan
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
                    <div class="card-title">سرفصل های بوت کمپ - <span class="text-info"><a
                            href="{{ route('admin.bootcamps.show', $bootcamp->id) }}">{{ $bootcamp->title }}</a></span>
                    </div>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                    class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                    class="fe fe-maximize"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <!-- table-wrapper -->

                @foreach($headlines as $headline)
                    @can('edit headlines')
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
                                        <form action="{{ route('admin.headlines.update', $headline->id) }}"
                                              method="post"
                                              class="save">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="title{{ $headline->id }}" class="control-label">عنوان
                                                            <span class="text-danger">&starf;</span></label>
                                                        <input type="text" class="form-control" name="title"
                                                               id="title{{ $headline->id }}"
                                                               placeholder="عنوان را اینجا وارد کنید"
                                                               value="{{ old('title', $headline->title) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="description"  class="control-label">توضیحات</label>
                                                        <span class="text-danger">&starf;</span>
                                                        <textarea class="form-control" id="description" placeholder="توضیحات خود را وارد کنید" name="description" required>{{ old('description', $headline->description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

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
                    @endcan

                    @can('delete headlines')
                        <form action="{{ route('admin.headlines.destroy', $headline->id) }}" method="post"
                              id="delete-{{ $headline->id }}" style="display: none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endcan
                @endforeach

            </div>
            <!-- section-wrapper -->
        </div>
    </div>
    <!-- row closed -->
@endsection


@section('scripts')
    <script>
    </script>
@endsection
