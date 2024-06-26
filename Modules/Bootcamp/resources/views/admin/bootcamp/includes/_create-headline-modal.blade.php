<a href="#" class="btn btn-indigo mr-2" data-toggle="modal" data-target="#create-headline">
    ثبت سرفصل
    <i class="fa fa-plus"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="create-headline" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ثبت سرفصل دوره - {{ $course->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.headlines.store') }}" method="post" class="save">
                    @csrf

                    <div class="row">
                       <div class="col">
                           <div class="form-group">
                               <label for="title" class="control-label">عنوان <span class="text-danger">&starf;</span></label>
                               <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را اینجا وارد کنید" value="{{ old('title') }}" required>
                           </div>
                       </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button class="btn btn-pink" type="submit">ثبت و ذخیره</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
