@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card shadow section-bg">
                    <div class="card section-bg border-none">
                        <div class="card-header text-center">
                            <h5 class="text-white">
                                {{ $exchange->payment_from_getway->name.' '. $exchange->payment_from_getway->cur_sym }} 
                                <i class="fas fa-exchange-alt"></i>
                                {{$exchange->payment_to_getway->name.' '.$exchange->payment_to_getway->cur_sym }}
                            </h5>
                        </div>

                        <div class="card-body section-bg ">
                            <div class="row my-4">
                                <div class="col-md-5 bolder">
                                    <span class="float-left">@lang('Exchange ID')</span>
                                    <span class="float-right">{{ $exchange->exchange_id }}</span>
                                </div>

                                <div class="col-md-5 offset-md-2 bolder">
                                    <span class="float-left">@lang('Status')</span>
                                    <span class="float-right text--small badge font-weight-normal 
                                        @if ($exchange->status == 0)
                                            badge-warning
                                        @endif

                                         @if ($exchange->status == 1)
                                            badge-success
                                        @endif
                                        @if ($exchange->status == 2)
                                            badge-success
                                        @endif

                                         @if ($exchange->status == 3)
                                            badge-danger
                                        @endif

                                         @if ($exchange->status == 4)
                                            badge-secondary
                                        @endif
                                        
                                    
                                    "> 
                                        @if ($exchange->status == 0)
                                            @lang('pending')
                                        @endif
                                        @if ($exchange->status == 1)
                                            @lang('Proccessing')
                                        @endif
                                         @if ($exchange->status == 2)
                                            @lang('Approved')
                                        @endif
                                         @if ($exchange->status == 3)
                                            @lang('Canceled')
                                        @endif
                                         @if ($exchange->status == 4)
                                            @lang('Refunded')
                                        @endif
                                        

                                    </span>

                                </div>

                            </div>

                            <hr>

                            <div class="row my-4">
                                <div class="col-md-5 bolder">
                                    <span class="float-left">@lang('User Name')</span>
                                    <span class="float-right">{{ @$exchange->user->username }}</span>
                                </div>

                                <div class="col-md-5 offset-md-2 bolder">
                                    <span class="float-left">@lang('Customer wallet Info')</span>
                                    <span class="float-right">{{ $exchange->email ??  $exchange->wallet_id}}</span>
                                </div>

                            </div>

                            <hr>

                            <div class="row my-4">
                                <div class="col-md-5 bolder">
                                    <span class="float-left">@lang('Send Currency')</span>
                                    <span class="float-right">{{ $exchange->payment_from_getway->name }}</span>
                                </div>

                                <div class="col-md-5 offset-md-2 bolder">
                                    <span class="float-left">@lang('Receive Currency')</span>
                                    <span class="float-right">{{ $exchange->payment_to_getway->name }}</span>
                                </div>

                            </div>

                            <hr>

                            <div class="row my-4">
                                <div class="col-md-5 bolder">
                                    <span class="float-left">@lang('Send Amount')</span>
                                    <span class="float-right">{{ $exchange->get_amount }}
                                        {{ $exchange->payment_from_getway->cur_sym }}</span>
                                </div>

                                <div class="col-md-5 offset-md-2 bolder">
                                    <span class="float-left">@lang('Received Amount')</span>
                                    <span class="float-right">{{ $exchange->send_amount }}
                                        {{ $exchange->payment_to_getway->cur_sym }}</span>
                                </div>

                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('style')
<style>

.badge-warning {
    color: #ffff;
}

</style>
@endpush