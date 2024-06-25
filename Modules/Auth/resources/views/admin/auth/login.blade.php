@extends('auth::admin.auth.master')

@section('content')
    <div class="page login-bg">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-lg-5">
                                <div class="card">
                                    <div class="p-4 pt-6 text-center">
                                        <h1 class="mb-2">ورود</h1>
                                        <p class="text-muted">از طریق فرم زیر می توانید به داشبورد پشتیبانی شتاب وارد شوید.</p>
                                    </div>
                                    <form class="card-body pt-3" id="login" name="login" method="post" action="{{ route('admin.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="mobile">نام کاربری</label>
                                            <input class="form-control @error('mobile') is-invalid @enderror" id="mobile" type="tel" name="mobile" value="{{ old('mobile') }}" autofocus required>
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">کلمه عبور</label>
                                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="password" minlength="3" required>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember" value="1"{{ old('remember') ? ' checked' : '' }}>
                                                <span class="custom-control-label">مرا به خاطر بسپار</span>
                                            </label>
                                        </div>
                                        <div class="submit">
                                            <button class="btn btn-primary btn-block" type="submit">ورود</button>
                                        </div>
                                    </form>
{{--                                    <div class="card-body border-top-0 pb-6 pt-2">--}}
{{--                                        <div class="text-center">--}}
{{--                                            <span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-facebook-line"></i></span>--}}
{{--                                            <span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-instagram-line"></i></span>--}}
{{--                                            <span class="avatar brround mr-3 bg-primary-transparent text-primary"><i class="ri-twitter-line"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
