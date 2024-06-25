@foreach($groups as $group)
    <option value="{{ $group->id }}"{{ $group->hasChildren() > 0 ? ' disabled' : '' }} {{ old('group_id', $groupId ?? null) == $group->id ? ' selected' : '' }}>
        {{ str_repeat(' - ', $depth) . $group->title }}
    </option>
    @php
        $depth++;
    @endphp
    @if($group->hasChildren() > 0)
        @include('core::includes.groups', ['groups' => $group->children])
    @endif
@endforeach
