@if($user->status == 'new')
<span title="وضعیت" class="badge badge-primary ">جدید</span>
@elseif($user->status == 'accepted')
<span title="وضعیت" class="badge badge-success ">ثبت نام شده</span>
@else
<span title="وضعیت" class="badge badge-danger ">ثبت نام نمیکند</span>
@endif
