<div class="modal fade" id="changeStatus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title font-weight-bolder">تغییر وضعیت</p>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="form-group">
                        <select class="form-control status2" id="status2" required>
                            <option value="">- انتخاب کنید -</option>
                            <option value="accepted">حاضر در مسابقه</option>
                            <option value="rejected">ثبت نام نمیکند</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="submitButton" type="submit" class="btn btn-primary text-right item-right">ثبت</button>
                <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">برگشت</button>
            </div>
        </div>
    </div>
</div>