 @php
    
    $banner = getContent('banner.content',true);
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    $content = getContent('notice_bar.content', true);
    
@endphp

@extends($activeTemplate.'layouts.frontend')
@section('content')

    <!--=======Banner-Section Ends Here=======-->
    <div id="home" class="home-area" data-select2-id="select2-data-home">
        <div class="d-table" data-select2-id="select2-data-16-rccs">
            <div class="d-table-cell" data-select2-id="select2-data-15-ur19">
                <div class="container">
                    <div class="row align-items-center pb-215">
                        <div class="col-lg-6 col-md-12 promo-header">
                            <div class="main-banner-content">
                                <h1>{{ __($banner->data_values->heading) }}</h1>
                                <p>{{ __($banner->data_values->sub_heading) }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12" data-select2-id="select2-data-12-9vvp">
                            <div class="promo-main" data-select2-id="select2-data-11-z335">
                                <div class="m-exchange-widget-block" data-select2-id="select2-data-10-1afj">
                                    <form method="POST" action="{{ route('user.exchange') }}" class="m-exchange-fix m-exchange__form js-exchange-form-initial exchange-form" autocomplete="off" data-select2-id="select2-data-9-15h7" id="exchange-form">
                                        @csrf
                                        <div class="m-exchange-body" data-select2-id="select2-data-8-etiv">
                                            <div class="m-exchange__block m-js-exchange-block d-flex sendData" data-select2-id="select2-data-7-ml42">
                                                <label class="m-exchange__label">
                                                    <span class="m-exchange__label-text select-none">@lang('You Send')</span>
                                                    <span class="m-exchange__field">
                                                        <input  type="number" step="any" name="send_amount" id="sending_amount"  required onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" inputmode="decimal" placeholder="0.00" class="m-target m-exchange__input js-onlyNumbers m-js-exchange-input m-js-exchange-from" value="">
                                                    </span>
                                                </label>
                                                <div class="m-exchange__select flex-grow-1" data-select2-id="select2-data-6-q799">
                                                    <div class="select-thumb">
                                                        <img src="https://money-exchange-sefina.com/assets/images/send_currency.png" class="select-thumb__img send-image">
                                                    </div>
                                                    <select class="select-bar" name="send" id="send" style="display: none;">
                                                        <option value="" disabled="" selected="">@lang('Select Currency')</option>
                                                        @foreach ($currencys_sell as $currency)
                                                            <option data-image="{{asset(getImage(imagePath()['currency']['path'].'/'.$currency->currency_image))}}"  data-min="{{ $currency->min_exchange }}" data-max="{{ $currency->max_exchange }}" data-buy="{{ $currency->buy_at }}" data-sell="{{ $currency->sell_at }}" data-currency="{{ $currency->cur_sym }}" value="{{ $currency->id }}" data-reserve="{{ $currency->reserve }}">
                                                                {{ $currency->name }} {{$currency->cur_sym}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="limit-alert d-none" id="currency-limit"></span>
                                            <div class="mt-3"></div>
                                            <div class="m-exchange__block m-js-exchange-block d-flex receiveData" data-select2-id="select2-data-23-v1ia">
                                                <label class="m-exchange__label">
                                                    <span class="m-exchange__label-text select-none">@lang('You Get')</span>
                                                    <span class="m-exchange__field">
                                                        <input type="number" step="any" name="receive_amount" id="receiving_amount" min="0" inputmode="decimal" placeholder="0.00" class="m-target m-exchange__input js-onlyNumbers m-js-exchange-input m-js-exchange-from" value="">
                                                    </span>
                                                </label>
                                                <div class="m-exchange__select flex-grow-1" data-select2-id="select2-data-22-4isg">
                                                    <div class="select-thumb">
                                                        <img src="https://money-exchange-sefina.com/assets/images/send_currency.png" class="select-thumb__img received-image">
                                                    </div>
                                                    <select class="select-bar" name="receive" id="receive" style="display: none;">
                                                        <option value="" disabled="" selected="" class="wrap">@lang('Select Currency')</option>
                                                        @foreach ($currencys_buy as $currency)
                                                            <option data-image="{{asset(getImage(imagePath()['currency']['path'].'/'.$currency->currency_image))}}"  data-min="{{ $currency->min_exchange }}" data-max="{{ $currency->max_exchange }}" data-sell="{{ $currency->sell_at }}" data-buy="{{ $currency->buy_at }}" data-currency="{{ $currency->cur_sym }}" value="{{ $currency->id }}" data-reserve="{{ $currency->reserve }}">
                                                                {{ $currency->name }} {{$currency->cur_sym}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="limit-alert d-none" id="currency-limit-received"></span>
                                            <div class="m-exchange__button-wrapper"> 
                                                <button type="submit" class="m-exchange-button m-js-exchange-button"> @lang('Exchange') </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-2 mt-4">
            <div class="row">
                <div class="col-lg-8 last-trnx">
                    <div class="custom-widget">
                        <h5 class="title mb-3">@lang('Latest Exchanges')</h5>
                        <div class="card custom--card">
                            <table class="table table--responsive--lg mb-0 table--md fs--13px">
                                <thead>
                                    <tr>
                                        <th>@lang('User')</th>
                                        <th>@lang('Sent')</th>
                                        <th>@lang('Received')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($accpted_exchange as $exchange)
                                    <tr>
                                        <td data-label="User">{{$exchange->user->username}}</td>
                                        <td data-label="Sent">
                                            <div class="table-content text-start">
                                                <div class="thumb ms-0">
                                                    <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_from_getway->currency_image)))}}" class="thumb">
                                                </div>
                                                <span class="mt-2 text-start">{{__($exchange->payment_from_getway->name)}}</span>
                                            </div>
                                        </td>
                                        <td data-label="Received">
                                            <div class="table-content text-center">
                                                <div class="thumb">
                                                    <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_to_getway->currency_image)))}}">
                                                </div>
                                                <span class="mt-2">{{__($exchange->payment_to_getway->name)}}</span>
                                            </div>
                                        </td>
                                        <td data-label="Amount">
                                            <div class="amount">
                                                {{$exchange->get_amount}} {{$exchange->payment_from_getway->cur_sym}}
                                                <i class="las la-arrow-right text--base"></i>
                                                {{$exchange->send_amount}} {{$exchange->payment_to_getway->cur_sym}}
                                            </div>
                                        </td>
                                        <td data-label="Date">
                                            <div>
                                                <span class="d-block">{{$exchange->created_at->format('d-m-y H:i A', strtotime($exchange->created_at))}}</span>
                                                <span class="text--base">{{ Carbon\Carbon::parse($exchange->created_at)->diffForHumans()}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 rate-payment pr-0">
                    <div class="col-lg-12 p-0">
                        <div class="card custom--card p-3">
                            <h5 class="card-title mb-3">@lang('Exchange Rates Now')</h5>
                            <div class="custom--card__inner card custom--card">
                                <div class="card-body p-0">
                                    <table class="table custom--table shadow-none">
                                        <thead>
                                            <tr>
                                                <th>@lang('Currency')</th>
                                                <th>@lang('Buy At')</th>
                                                <th>@lang('Sell At')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($currencys_sell as $currency)
                                            <tr>
                                                <td data-label="Currency">
                                                    <div>
                                                        <span class="thumb ms-0">
                                                            <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.$currency->currency_image))}}">
                                                        </span>
                                                        <span class="currency-name">{{ $currency->name }}</span>
                                                    </div>
                                                </td> 
                                                <td data-label="Buy At">{{ number_format($currency->buy_at,2) }}</td>
                                                <td data-label="Sell At">{{ number_format($currency->sell_at,2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($sections->secs != null)
            @foreach (json_decode($sections->secs) as $sec)
                @include($activeTemplate.'sections.'.$sec)
            @endforeach
        @endif

        @php
        $footer_content = getContent('footer.content',true);
        $socials = getContent('footer.element',false);
        @endphp
    <!--=======Footer-Section Ends Here=======-->
    <!--=======Banner-Section Ends Here=======-->

@endsection




@push('script')
    <script>
        "use strict";
        (function($) {
            $('.cookie-btn').on('click', function(e) {
                $.ajax({
                    url: `{{ route('cookie.accept') }}`,
                    type: "GET",
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        if (response.success) {
                            notify('success', response.message);
                            $('.cookies-card').remove();
                        }
                    },
                });
            });
        })(jQuery);
    </script>
@endpush

@push('script')

<script src="{{ asset($activeTemplateTrue . 'js/homesection.js') }}"></script>

@endpush


@push('style')
    <style>
        .limit-alert {
            padding: 8px 10px;
            border-radius: 0px 0px;
            display: block;
            width: 100%;
            color: #F44336;
            font-weight: 600;
            font-family: system-ui;
            font-size: 15px;
        }
        .exchange-nav .navbar .navbar-nav .nav-item a,.nav-item a{
            color: #fff !important;
        }
        .langSel .current{
            color: #fff !important;
        }
        .navbar-area.is-sticky .exchange-nav .navbar .navbar-nav .nav-item a,.navbar-area.is-sticky .nav-item a{
            color: #000 !important;
        }
        .langSel:after{
            border-bottom: 2px solid #fff !important;
            border-right: 2px solid #fff !important;
        }
        .navbar-area.is-sticky .langSel .current{
            color: #000 !important;
        }
        .navbar-area.is-sticky .langSel:after{
            border-bottom: 2px solid #000 !important;
            border-right: 2px solid #000 !important;
        }
        .black-logo{
            display: none;
        }
        .navbar-area.is-sticky .black-logo{
            display: block;
        }
        .navbar-area.is-sticky .white-logo{
            display: none;
        }
    </style>
@endpush

