@if($bootcampComment->status == 'pending')
<span title="وضعیت" class="badge badge-primary ">جدید</span>
@elseif($bootcampComment->status == 'accepted')
<span title="وضعیت" class="badge badge-success ">تایید شده</span>
@else
<span title="وضعیت" class="badge badge-danger ">رد شده</span>
@endif
