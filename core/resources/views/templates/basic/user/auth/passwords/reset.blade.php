@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="card-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf
                        
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="label-title">{{ __('Forgot Password?') }}</div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label label">{{ __('Password') }}</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control " name="password" required="" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label label">{{ __('Confirm Password') }}</label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                            <a href="{{ route('user.login') }}" class="link-a">@lang('Login Here')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style type="text/css">
        .label-title{
            text-align: center;
            padding: 15px 10px;
            font-weight: 600;
            font-size: 19px;
        }
        .card-custom{
            box-shadow: 0 0 5px #ddd;
            width: 25rem;
            padding: 10px 0;
            margin: 10rem auto;
            border-radius: 10px;
        }
        .link-a{
            padding: 10px;
            font-size: 16px;
            font-weight: 600;
        }
        .label{
            font-weight: 600;
            font-size: 15px;
        }
        .card-custom .form-group input{
            height: calc(2em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
        }
        .card-custom .form-group button{
            padding: 0.575rem 0.75rem;
            font-weight: 600;
        }
        .card-custom .form-group button:focus, .card-custom .form-group button:hover {
          color: #ffffff;
          -webkit-box-shadow: 0 10px 20px rgba(114, 62, 235, 0.4);
                  box-shadow: 0 10px 20px rgba(114, 62, 235, 0.4);
        }
    </style>
@endpush