@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container pt-100 pb-100">
        <div class="row gy-4">
            @if ($user->referrer)
                <div class="col-md-12">
                    <h5 class="">@lang('You are referred by') <span class="text--base">{{ @$user->referrer->fullname }}</span></h5>
                </div>
            @endif
            <div class="col-md-12 mb-4">
                <div class="input-group">
                    <span class="input-group-text bg--base text-white custom-li">@lang('Referral Link')</span>
                    <input type="text" class="form-control form--control bg-white referralURL" value="{{ route('user.refer.register', auth()->user()->username) }}" readonly>
                    <button type="button" class="input-group-text custom-btn text--base bg-white" id="copyBoard"><i class="la la-copy"></i></button>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="text-start"> @lang('Users Referred By Me')</h5>
                    </div>
                    <div class="card-body">
                        @if ($user->allReferrals->count() > 0 && $maxLevel > 0)
                            <div class="treeview-container">
                                <ul class="treeview">
                                    <li class="items-expanded"> {{ $user->fullname }} ( {{ $user->username }} )
                                        @include($activeTemplate . 'partials.under_tree', ['user' => $user, 'layer' => 0, 'isFirst' => true])
                                    </li>
                                </ul>
                            </div>
                        @else
                            @lang('No referee yet.')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link type="text/css" href="{{ asset('assets/global/css/jquery.treeView.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/jquery.treeView.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.treeview').treeView();
            $('#copyBoard').click(function() {
                document.execCommand("copy");
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .copied::after {
            background-color: #{{ $general->base_color }};
        }
        .form--control{
            border: 0;
            border-top: 1px solid #ced4da !important;
            border-bottom: 1px solid #ced4da !important;
            box-shadow: none !important;
        }
        .custom-li{
            border-radius: 5px 0px 0px 5px;
            font-weight: 600;
            font-size: 15px;
        }
        .custom-btn{
            color: #4663ee !important;
            border-radius: 0px 5px 5px 0px;
            outline: none;
        }
        .card-body{
            padding: 1rem 1.5rem;
        }
        .referralURL{
            font-size: 15px;
            font-weight: 600;
        }
        .copyInput {
            display: inline-block;
            line-height: 50px;
            position: absolute;
            top: 0;
            right: 0;
            width: 40px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            -webkit-transition: all .3s;
            -o-transition: all .3s;
            transition: all .3s;
          }
        .copied::after {
            position: absolute;
            top: 8px;
            right: 12%;
            width: 100px;
            display: block;
            content: "COPIED";
            font-size: 1em;
            padding: 5px 5px;
            color: #fff;
            z-index: 9999;
            font-size: 12px;
            font-weight: 600;
            background-color: #FF7000;
            border-radius: 3px;
            opacity: 0;
            will-change: opacity, transform;
            animation: showcopied 1.5s ease;
        }
        .copied::after {
            background-color: #FF6B31;
        }
        @keyframes showcopied {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            50% {
                opacity: 0.7;
                transform: translateX(40%);
            }
            70% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
            }
        }
    </style>
@endpush
