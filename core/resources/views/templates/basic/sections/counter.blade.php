@php
    $content =  getContent('counter.content',true);
    $elements = getContent('counter.element');

@endphp


    <!--=======Counter-Section Starts Here=======-->
    <section class="counter-section bg--img" style="background-image: url(https://preview.wstacks.com/changehub/assets/presets/default/images/counter-bg.png)">
        <div class="container pt-2 pb-2">
            <div class="row">
                @foreach($elements as $element )
                    <div class="col-lg-4 col-sm-6">
                        <div class="counter-item">
                            <div class="counter-header">
                                <h4 class="title odometer" data-odometer-final="{{$element->data_values->counter_digit}}">0</h4>
                                <h4 class="title">@lang('k')</h4>
                            </div>
                            <div class="counter-content">
                                <h6 class="subtitle">{{__($element->data_values->title)}}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--=======Counter-Section Ends Here=======-->

    @push('style')
        <style type="text/css">
            /*counter-section*/
            .counter-section {
                background: hsl(224 100% 54%);
            }
            .counter-section {
                padding: 10px 0px;
            }
            .process-card {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .count-number-wraper {
                display: flex;
                align-items: end;
            }
            .count-number-wraper span {
                color: hsl(0 0% 100%);
                font-size: 60px;
            }
            .odometer.odometer-auto-theme .odometer-digit .odometer-digit-spacer{
                display: inline-block;
                vertical-align: middle;
                visibility: hidden;
            }
            .counter-item .counter-header{
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
            }
            .counter-header h4 {
                color: #fff !important;
                font-size: 45px;
                font-weight: 600;
                word-spacing: -10px;
            }
            .counter-content{
                text-align: center;
            }
            .counter-content h6 {
                color: #fff;
                font-size: 18px;
                font-weight: 600;
            }
            .count-number-wraper h6 {
                color: hsl(0 0% 100%);
                font-size: 60px !important;
            }
            .process-card .subtitle2 {
                text-align: center;
                color: hsl(0 0% 100% / 0.7);
                padding: 0px 74px;
            }
            @media (max-width: 1399px) {
                .process-card .subtitle2 {
                    text-align: center;
                    color: hsl(0 0% 100% / 0.7);
                    padding: 0px 28px;
                }
            }
        </style>
    @endpush