@extends('backend.layouts.app')

@section('content')
<div class="col-md-4 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img src="/images/logo/stack-logo-dark.png" alt="branding logo">
            </div>
            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                <span>Login with Stack</span>
            </h6>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if (session('message'))
                    <div class="alert-danger notification">
                         <ul style="list-style: none;text-align: center;">
                            <li>{{ session('message') }}</li>
                        </ul>
                    </div>
                @elseif (session('message-success'))
                    <div class="alert-success notification">
                        <ul style="list-style: none;text-align: center;">
                            <li>{{ session('message-success') }}</li>
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('E-Mail Address') }}"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('Password') }}"
                        required>
                        <div class="form-control-position">
                            <i class="fa fa-key"></i>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                            <fieldset>
                                <input type="checkbox" id="remember-me" class="chk-remember">
                                <label for="remember-me"> Remember Me</label>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="/admin/forgot-password" class="card-link">Forgot Password?</a></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
