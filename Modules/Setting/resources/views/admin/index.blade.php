@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">تنظیمات</li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">

            </div>
        </div>
    </div>
    <!--  Page-header closed -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @foreach($groups->chunk(4) as $chunk)
                    <div class="row">
                        @foreach($chunk as $group => $options)
                            <div class="col-md-12 col-xl-3 col-lg-6">
                                <div class="mb-3">
                                    <div class="card bg-{{ $options['bg'] }} mb-lg-0">
                                        <div class="card-body text-center text-white">
                                            <i class="fe fe-{{ $options['icon'] }} fs-50 "></i>
                                            <h3 class="font-weight-bold mt-4">{{ $options['title'] }}</h3>
                                            <p class="mt-3 mb-5">{{ $options['summary'] }}</p>
{{--                                            @can('edit settings')--}}
                                                <a class="btn btn-white mx-1 btn-pill"
                                                   href="{{ route('admin.settings.edit', [$group]) }}">ویرایش</a>
{{--                                            @endcan--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
