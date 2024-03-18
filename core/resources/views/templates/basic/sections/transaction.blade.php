@php
    $content = getContent('transaction.content',true);

@endphp   
<!--=======Transaction-Section Starts Here=======-->
    <section class="transaction-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-header">
                       
                    <h3 class="title">{{__($content->data_values->heading)}}</h3>
                        <p>
                            {{__($content->data_values->sub_heading)}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card custom--card">
                <div class="card-body p-0">
                    <table class="table custom--table table-responsive--md">
                        <thead>
                            <tr>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Sent')</th>
                                <th scope="col">@lang('Received')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($accpted_exchange as $exchange)
                            <tr>
                                <td data-input="@lang('Exchanger')">
                                    <div class="exchanger"> 
                                        <div class="content">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-start" data-input="@lang('From')">
                                    <span class="thumb">
                                        <img class="table-currency-img" src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_from_getway->currency_image)))}}">
                                    </span>
                                    {{__($exchange->payment_from_getway->name)}}
                                </td>
                                <td class="text-start" data-input="@lang('To')">
                                    <span class="thumb">
                                        <img src="{{asset(getImage(imagePath()['currency']['path'].'/'.__($exchange->payment_to_getway->currency_image)))}}" class="table-currency-img">
                                    </span>
                                    <span>
                                        {{__($exchange->payment_to_getway->name)}}
                                    </span>
                                </td>
                                <td data-input="@lang('Amount')">
                                    {{$exchange->get_amount}} {{$exchange->payment_from_getway->cur_sym}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    {{$exchange->send_amount}} {{$exchange->payment_to_getway->cur_sym}}
                                </td>
                                <td data-input="@lang('Time')">
                                    <div>
                                        <span class="d-block">{{$exchange->created_at->format('d-m-y H:i A', strtotime($exchange->created_at))}}</span>
                                        <span>{{ Carbon\Carbon::parse($exchange->created_at)->diffForHumans()}}</span>
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
    </section>
    <!--=======Transaction-Section Ends Here=======-->

    @push('style')
        <style>
            .nowrap {
                white-space: nowrap;
            }
        </style>
    @endpush