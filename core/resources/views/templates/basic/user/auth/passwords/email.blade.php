@extends($activeTemplate.'layouts.app')

@section('content')
    <section class="account forgot">
        <div class="account-area">
            <div class="account-wrapper change-form">
                <div class="account-logo">
                    <a class="site-logo" href=""><img src="{{ siteLogo() }}" alt="logo"></a>
                </div>
                <h5 class="title">{{ __('Forgot Password?') }}</h5>
                <p>{{ __('Enter your email and we"ll send you a otp to reset your password.') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="account-form" method="POST" action="{{ route('user.password.email') }}">
                    @csrf
                    <div class="row ml-b-20">
                        <div class="col-xl-12 col-lg-12 form-group">
                            <input type="text" name="value" class="form--control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="{{ __('Email Or Username') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group text-center">
                            <button type="submit" class="btn--base w-100">{{ __('Send Code') }}</button>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="account-item">
                                <label>{{ __('Already Have An Account?') }} <a href="{{route('user.login')}}" class="account-control-btn">{{ __('Login Now') }}</a></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

