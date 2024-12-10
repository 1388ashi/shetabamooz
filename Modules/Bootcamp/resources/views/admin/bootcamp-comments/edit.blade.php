@foreach($bootcampComments as $bootcampComment)
    <div class="modal fade mt-5" tabindex="-1" id="edit-bootcamp-comment-{{ $bootcampComment->id }}" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('admin.bootcamps.comments.update', $bootcampComment->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ویرایش وضعیت {{$bootcampComment->name}}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">وضعیت</label>
                        <select class="select2" name="status">
                            <option value="accepted" @selected($bootcampComment->status == 'accepted')>تایید بشود</option>
                            <option value="rejected" @selected($bootcampComment->status == 'rejected')>رد بشود</option>
                            <option value="rejected" @selected($bootcampComment->status == 'pending')>در حال بررسی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">پاسخ</label>
                        <textarea class="form-control" name="admin_description" cols="30" rows="3">{{$bootcampComment->admin_description}}</textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button  class="btn btn-warning text-right item-right">به روزرسانی</button>
                    <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">برگشت</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
