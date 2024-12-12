@if($user->status == 'new')
<span title="وضعیت" class="badge badge-primary ">جدید</span>
@else
@elseif($user->status == 'absent')
<span title="وضعیت" class="badge badge-success ">غایب</span>
@else
@elseif($user->status == 'present')
<span title="وضعیت" class="badge badge-success ">حاضر</span>
@else
<span title="وضعیت" class="badge badge-danger ">ثبت نام نمیکند</span>
@endif
