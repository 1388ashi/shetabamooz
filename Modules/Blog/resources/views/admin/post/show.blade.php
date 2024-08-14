@extends('layouts.admin.master')

@section('content')
    <style>
        .text-bold{
            font-weight: bold;
        }
        p{
            font-size: 16px;
        }
        .p__title{
            margin: 0 0 50px 0 ;
        }
        .rtl{
            direction: rtl;
            text-align: right;
        }
        .ltr{
            direction: ltr;
            text-align: left;
        }
    </style>
    <!--  Page-header opened -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.posts.index') }}">لیست پستها</a></li>
            <li class="breadcrumb-item active" aria-current="page">مشاهده پست</li>
        </ol>
    </div>
    <!--  Page-header closed -->
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h5 class="card-title text-bold">جزئیات پست</h5>
            </div>
            <div class="card-body p-30">
                <div class="row">
                    <div class="col-6">
                        <div class="img" style="height: 200px">
                            <img src="{{$post->image}}" height="80%" alt="post">
                        </div>
                    </div>

                    <div class="col-6">
                        <span class="text-bold">عنوان:</span>
                        <span>{{$post->title}}</span>
                        <br>
                        <br>

                        <span class="text-bold">نویسنده:</span>
                        <span>{{$post->author}}</span>
                        <br>
                        <br>

                        <span class="text-bold">وضعیت نمایش:</span>
                        <span class="text-bold">@include('components.status', ['status' =>Modules\Blog\App\Models\Post::getStatus($post->status) ])</span>
                        <br>
                        <br>
                        {{-- <span class="text-bold">تاریخ انتشار:</span>
                        <span>@include('components.time',['time' => verta($post->created_at)->formatDate()])</span> --}}
                    </div>

                    <div class="col-12">
                        <p class="text-bold">توضیحات کوتاه:</p>
                        <p>{{ $post->short_description }}</p>
                    </div>

                    <div class="col-12">
                        <p class="text-bold">توضیحات :</p>
                        <p>{!! $post->description !!}</p>
                    </div>

                    <hr>
                    <br><br>
                    <div class="col-12">
                        <p class="text-bold">عنوان متا:</p>
                        <p>{{$post->meta_title}}</p>
                    </div>
                    <hr>
                    <div class="col-12">
                        <p class="text-bold">جزییات متا:</p>
                        <p>{{$post->meta_description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="category-show">
                            <p class="text-bold">دسته بندی ها:</p>
                            @foreach($categories as $category)
                                <span class="category-item">{{$category->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-bold">برچسب های ثبت شده:</h5>
                        <p>@if($post->tags->count() > 0) {{ implode(',', $post->tags->pluck('name')->all()) }} @endif</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

@endsection
