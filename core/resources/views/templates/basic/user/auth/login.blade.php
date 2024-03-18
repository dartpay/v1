@extends($activeTemplate.'layouts.frontend')

@php
    $login = getContent('login.content',true)
@endphp

@section('content')

<!--=======Account-Service Starts Here=======-->
    <section class="login pt-140 pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-grid my-auto py-5 login-img">
                    <img src="{{asset('assets/images/frontend/login/'.$login->data_values->image_login)}}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 my-auto">
                    <div class="content">
                        <div class="my-3">
                            <h3 class="pb-2 text-capitalize fw-bold">@lang('Welcome Back')</h3>
                        </div>
                        <form method="POST" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="form-group ">
                                <label for="email_username">@lang('Username Or Email')</label>
                                <input type="text" class="form--control" id="email_username" name="username" placeholder="@lang('Enter Your Email or Username')">
                            </div>
                            <div class="form-group show_hide_password">
                                <label>@lang('Your Password')</label>
                                <input type="password" class="form--control" name="password" placeholder="@lang('Enter Your Password')">
                                <a href="javascript:void(0)" class="show-pass icon field-icon">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </a>
                            </div>
                            @php
                                echo loadReCaptcha();

                            @endphp

                           
                            @include($activeTemplate.'partials.custom-captcha')
                            <div class="forgot-item">
                                <label>
                                    <a href="{{route('user.password.request')}}" class="text--base">@lang('Forgot Password?')</a>
                                </label>
                            </div>
                            <input type="submit" class="btn--base w-100 text-center mt-2" value="Login">
                            @php
                                $credentials = $general->socialite_credentials;
                            @endphp
                            @if (@$credentials->google->status == Status::ENABLE ||
                                @$credentials->facebook->status == Status::ENABLE ||
                                @$credentials->linkedin->status == Status::ENABLE)
                                  <div class="col-12">
                                    <div class="social other-option">
                                        <span class="other-option__text">@lang('OR')</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-3">
                                    @if ($credentials->facebook->status == Status::ENABLE)
                                        <a href="{{ route('user.social.login', 'facebook') }}"
                                            class="btn btn-outline-facebook btn-sm flex-grow-1">
                                            <span class="me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#3668B8" viewBox="0 0 30 30" class="w-6">
                                                    <path d="M15,3C8.373,3,3,8.373,3,15c0,6.016,4.432,10.984,10.206,11.852V18.18h-2.969v-3.154h2.969v-2.099c0-3.475,1.693-5,4.581-5 c1.383,0,2.115,0.103,2.461,0.149v2.753h-1.97c-1.226,0-1.654,1.163-1.654,2.473v1.724h3.593L19.73,18.18h-3.106v8.697 C22.481,26.083,27,21.075,27,15C27,8.373,21.627,3,15,3z"/></svg>
                                               
                                            </span>
                                            @lang('Facebook')
                                        </a>
                                    @endif
                                    @if ($credentials->google->status == Status::ENABLE)
                                        <a href="{{ route('user.social.login', 'google') }}"
                                            class="btn btn-outline-google btn-sm flex-grow-1">
                                            <span class="me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30"class="w-6" fill="#D64937"><path d="M 15.003906 3 C 8.3749062 3 3 8.373 3 15 C 3 21.627 8.3749062 27 15.003906 27 C 25.013906 27 27.269078 17.707 26.330078 13 L 25 13 L 22.732422 13 L 15 13 L 15 17 L 22.738281 17 C 21.848702 20.448251 18.725955 23 15 23 C 10.582 23 7 19.418 7 15 C 7 10.582 10.582 7 15 7 C 17.009 7 18.839141 7.74575 20.244141 8.96875 L 23.085938 6.1289062 C 20.951937 4.1849063 18.116906 3 15.003906 3 z"/></svg>
                                            </span>
                                            @lang('Google')
                                        </a>
                                    @endif
                                    @if ($credentials->linkedin->status == Status::ENABLE)
                                        <a href="{{ route('user.social.login', 'linkedin') }}"
                                            class="btn btn-outline-linkedin btn-sm flex-grow-1">
                                            <span class="me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#0077B7" viewBox="0 0 50 50" class="w-6"> <path d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z"/></svg>
                                            </span>
                                            @lang('Linkedin')
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <p class="d-block text-center mt-3 create-acc">
                                @lang("Don't have an account?")
                                <a href="{{route('user.register')}}">@lang('Register')</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=======Account-Service Ends Here=======-->

@endsection

@push('script')
    <script>
        'use strict';
        
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
