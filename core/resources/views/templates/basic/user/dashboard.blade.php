@extends($activeTemplate.'layouts.master')
@section('content')
    @php
        $kyc = getContent('kyc_content.content', true);
    @endphp
    <!-- Dashboard Section -->
    
    <div class="cmn-section style-two pb-100">
        <div class="container">
            <div class="row mb-5">
                @if ($user->kv == 0)
                    <div class="col-12">
                        <div class="alert alert-danger mb-0" role="alert">
                            <h6 class="alert-heading">@lang('KYC Verification')</h6>
                            <p class="py-2">
                                {{ __(@$kyc->data_values->pending_content) }}
                                <a href="{{ route('user.kyc.form') }}" class="fw-bold">@lang('Click here to verify')</a>
                            </p>
                        </div>
                    </div>
                @endif
                @if ($user->kv == 2)
                    <div class="col-12">
                        <div class="alert alert--warning mb-0" role="alert">
                            <h6 class="alert-heading">@lang('KYC Verification Pending')</h6>
                            <p class="py-2">
                                {{ __(@$kyc->data_values->pending_content) }}
                                <a href="{{ route('user.kyc.data') }}" class="text--base fw-bold">@lang('See KYC Data')</a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row cmn-text">
                <a href="javascript:void(0)" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">@lang('Current Balance')</p>
                            <h2 class="text--base font-weight-bold">{{ $general->cur_sym }}= {{ getAmount($current_balance->balance) }}</h2>
                        </div>
                    </div>
                </a>
                <a href="{{route('user.reffer.log')}}" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">REFFERAL COMMISSION</p>
                            <h2 class="text--base font-weight-bold">{{ $general->cur_sym }}= {{ number_format($refferal_bonus,2) }}</h2>
                        </div>
                    </div>
                </a>
                <a href="{{route('user.exchange.cancled')}}" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">@lang('Cancled Exchange')</p>
                            <h2 class="text--base font-weight-bold">{{ $cancel_exchange_count }}</h2>
                        </div>
                    </div>
                </a>
                <a href="{{route('user.exchange.pending')}}" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">@lang('Pending Exchange')</p>
                            <h2 class="text--base font-weight-bold">{{ $pending_exchange_count }}</h2>
                        </div>
                    </div>
                </a>
                <a href="{{route('user.exchange.approved')}}" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">@lang('Approved Exchange')</p>
                            <h2 class="text--base font-weight-bold">{{ $accpted_exchange_count }}</h2>
                        </div>
                    </div>
                </a>
                <a href="{{route('user.exchange.refunded')}}" class="col-lg-4 col-md-12 mb-30">
                    <div class="widget bb--3 border--success b-radius--10 bg--white box--shadow2 p-4">
                        <div class="widget__icon b-radius--rounded bg--success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="widget__content">
                            <p class="text-uppercase text-muted mb-0">@lang('Refunded Exchange')</p>
                            <h2 class="text--base font-weight-bold">{{ $refunded_exchange->count() }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="last-trnx mt-4">
                <h5 class="title mb-3 mt-2">@lang('Your Latest Exchanges')</h5>
                <div class="card custom--card">
                    <div class="card-body p-0">
                        <table class="table table--responsive--lg">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Send')</th>
                                    <th>@lang('Received')</th>
                                    <th>@lang('Exchange ID')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse ($latestExchange as $exchange)
                                <tr>
                                    <td data-label="S.N.">{{ $loop->iteration }}</td>
                                    <td data-label="Send">
                                        <div class="table-content text-center">
                                            <div class="thumb ">
                                                <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_from_getway->currency_image)))}}" class="thumb">
                                            </div>
                                            <span class="mt-2">{{ $exchange->payment_from_getway->name }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Received">
                                        <div class="table-content text-center">
                                            <div class="thumb">
                                                <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_to_getway->currency_image)))}}">
                                            </div>
                                            <span class="mt-2">{{ __($exchange->payment_to_getway->name) }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Exchange ID">
                                        {{ @$exchange->exchange_id }}
                                    </td>
                                    <td data-label="Amount">
                                        <div>
                                            {{ showAmount($exchange->get_amount) }} {{ __(@$exchange->payment_from_getway->cur_sym) }}
                                            <i class="las la-arrow-right text--base"></i>
                                            {{ showAmount($exchange->send_amount) }} {{ __(@$exchange->payment_to_getway->cur_sym) }}
                                        </div>
                                    </td>
                                    <td data-label="Date">
                                        <span class="d-block">{{ showDateTime(@$exchange->created_at) }}</span>
                                        <span class="text--base">{{ diffForHumans(@$exchange->created_at) }}</span>
                                    </td>
                                    <td data-label="Status">
                                        @php echo $exchange->badgeData(); @endphp
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{ __($empty_message) }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Section -->

@endsection


@push('style')
    <style>
        .nowrap {
            white-space: nowrap;
        }
        
    </style>
@endpush
