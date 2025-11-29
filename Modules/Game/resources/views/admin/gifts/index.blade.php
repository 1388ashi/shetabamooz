@foreach($games as $game)
    <div class="modal  fade mt-5" tabindex="-1" id="edit-gift-{{ $game->id }}" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-weight-bolder">لیست جوایز بازی {{ $game->title }} </p>
                    <a href="{{ route('admin.game-gifts.create',$game->id)}}" class="btn btn-twitter text-left item-left">
                        ثبت آیتم جدید
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example-2" class="table table-striped table-bordered text-nowrap text-center">
                            <thead>
                            <tr>
                                <th class="border-top">ردیف</th>
                                <th class=" border-top">عنوان</th>
                                <th class=" border-top">جایزه</th>
                                <th class="wd-10p border-top">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($game->gameGifts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($item->title, 40) }}</td>
                                        <td>{{ Str::limit($item->gift, 40) }}</td>
                                        <td>
                                            <a href="{{route('admin.game-gifts.edit',[ 'game' => $game->id,'gameGift' => $item->id])}}"
                                                class="btn btn-warning btn-sm text-white" data-toggle="tooltip"
                                                data-original-title="ویرایش"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-sm text-white" data-toggle="tooltip"
                                                    data-original-title="حذف"
                                                    onclick="confirmDelete('delete-{{ $item->id }}')">
                                                <i class="fa fa-trash-o"></i></button>
                                            <form action="{{route('admin.game-gifts.destroy',[$item->id])}}"
                                                method="post" id="delete-{{ $item->id }}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-danger">جایزه ای تعریف نشده</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-outline-danger  text-right item-right" data-dismiss="modal">بستن</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach