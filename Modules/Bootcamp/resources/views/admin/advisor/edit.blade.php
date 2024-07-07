@foreach($advisors as $advisor)
    <div class="modal fade mt-5" tabindex="-1" id="edit-menu-{{ $advisor->id }}" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('admin.advisors.update', $advisor->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">ویرایش وضعیت {{$advisor->name}}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="select2" name="status">
                            <option value="accepted" @selected($advisor->status == 'accepted')>تماس گرفته شده</option>
                        </select>
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
