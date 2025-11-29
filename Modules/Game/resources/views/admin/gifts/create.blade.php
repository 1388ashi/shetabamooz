@extends('layouts.admin.master')

@section('content')
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i> داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.games.index') }}">لیست مسابقه ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ثبت جایزه جدید</li>
        </ol>
    </div>
    <!--  Page-header closed -->

    @include('components.errors')

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات جایزه بازی {{ $game->title }} </h3>
                </div>
                <form action="{{ route('admin.game-gifts.store') }}" method="post" class="save" enctype="multipart/form-data"
                        id="articleForm">
                        @csrf
                    <div class="card-body">
                        <div class="heading">
                            <div class="row">
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="control-label">عنوان</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="form-control" id="title"
                                            placeholder="عنوان را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gift" class="control-label">جایزه</label>
                                        <span class="text-danger">&starf;</span>
                                        <input type="text" name="gift" value="{{ old('gift') }}"
                                            class="form-control" id="gift"
                                            placeholder="جایزه را اینجا وارد کنید..." required autofocus>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">ثبت</button>
                                        <a class="btn btn-outline-warning" href="{{ route('admin.games.index') }}">برگشت</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
