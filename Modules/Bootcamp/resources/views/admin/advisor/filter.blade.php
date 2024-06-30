<div class="card ">
    <div class="card-header">
        <div class="card-title">فیلتر ها</div>
        <div class="card-options">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                    class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
            <form action="{{ route("admin.advisors.index") }}">
                <div class="row">
                    <div class="col-6 col-lg-6 form-group">
                        <label class="font-weight-bold">نام:</label>
                        <input type="text" name="name" value="{{ request("name") }}" placeholder="نام را انتخاب کنید" class="form-control" />
                    </div>
                    <div class="col-6 col-lg-6 form-group">
                        <div class="form-group">
                            <label class="font-weight-bold">وضعیت :</label>
                            <select name="status" class="form-control">
                                <option value="">همه</option>
                                <option value="new" @selected(request("status") == "new")>جدید</option>
                                <option value="accepted" @selected(request("status") == "accepted")>ثبت نام میکند</option>
                                <option value="rejected" @selected(request("status") == "rejected")>ثبت نام نمیکند</option>
                            </select>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-9">
                            <button class="col-12 btn btn-primary align-self-center">جستجو</button>
                        </div>
                        <div class="col-3">
                            <a href="{{route('admin.advisors.index')}}" class="col-12 btn btn-danger align-self-center">حذف فیلتر ها<i
                                class="fa fa-close"
                                aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
