@extends('backend.layouts.app')

@section('content')
<div class="col-md-4 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img src="/images/logo/stack-logo-dark.png" alt="branding logo">
            </div>
            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                <span>We will send you a new password to your email.</span>
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
                @endif
                <form method="POST" action="/admin/forgot-password" novalidate>
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('E-Mail Address') }}"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block"><i class="ft-unlock"></i> Recover Password</button>
                </form>
            </div>
        </div>
        <div class="card-footer border-0">
            <p class="float-sm-left text-center"><a href="/admin/login" class="card-link">Login</a></p>
        </div>
    </div>
</div>
@endsection
