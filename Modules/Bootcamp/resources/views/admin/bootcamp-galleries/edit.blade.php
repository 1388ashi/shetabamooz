@foreach ($bootcampGalleries as $gallery)
<div class="modal fade"  id="edit-galleries-{{$gallery->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.bootcamp-galleries.update',$gallery->id)}}" class="save" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ثبت رسانه‌ی جدید</p>
                <button  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">بوتکمپ<span class="text-danger">&starf;</span></label>
                        <select class="form-control select2" name="bootcamp_id">
                            <option value="" selected>-- بوتکمپ را انتخاب کنید --</option>
                            @foreach ($bootcamps as $bootcamp)
                                <option value="{{$bootcamp->id}}" @selected($gallery->id == $bootcamp->id)>{{$bootcamp->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ویدیوها</label>
                        <input class="form-control" type="file" name="videos[]" multiple="multiple">
                    </div>
                    <div class="form-group">
                        <label class="control-label">گالری تصویر</label>
                        <input type="file" name="galleries[]" class="form-control" multiple="multiple">
                    </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button  class="btn btn-primary  text-right item-right">ثبت</button>
                <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">برگشت</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach