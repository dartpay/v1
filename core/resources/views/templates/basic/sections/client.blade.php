    @php
        $content= getContent('client.content',true);
        $client= getContent('client.element',false);

       
    @endphp
    <!--=======Client-Section Starts Here=======-->


    <section class="client_section ptb-60 overflow-hidden" >
        <div class="container mx-auto client">
            <div class="row">
                <div class="col-12 my-auto">
                    <div class="text-content text-center">
                        <h4>{{__($content->data_values->heading)}}</h4>
                        <h3>{{__($content->data_values->sub_heading)}}</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="client-slider mt-2">
                        <div class="swiper-wrapper mb-5">
                            @foreach ($client as $cli)
                            <div class="swiper-slide">
                                <div class="d-flex flex-wrap card" data-aos="zoom-in">
                                    <div class="client-content">
                                        <p>
                                            {{ $cli->data_values->description }}
                                        </p>
                                    </div>
                                    <div class="client-thumb d-flex mt-5">
                                        <div class="mr-3">
                                            <img src="{{asset('assets/images/frontend/client/'.$cli->data_values->image)}}" alt="client">
                                        </div>
                                        <div>
                                            <h3>{{ $cli->data_values->name }}</h3>
                                            <p class="sub">{{ $cli->data_values->type_client }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('style')
        <style type="text/css">
            /*client*/
            .client {
                overflow: hidden;
            }
            .client .client-slider .card {
                background-color: #ffffff;
                -webkit-box-shadow: 0px 0px 35px -1px rgba(219, 219, 219, 0.57);
                box-shadow: 0px 0px 35px -1px rgba(219, 219, 219, 0.57);
                margin-top: 30px;
                margin-left: 10px;
                margin-right: 10px;
                padding: 30px;
                border: none;
                border-radius: 10px;
            }
            .client .client-slider .client-content p {
                margin-top: 15px;
            }
            .client .swiper-container-horizontal > .swiper-pagination-bullets, .client .swiper-pagination-custom, .client .swiper-pagination-fraction {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }
            .swiper-pagination {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                margin-top: 60px;
            }
            .swiper-pagination .swiper-pagination-bullet {
                height: 10px;
                width: 10px;
                border-radius: 50%;
                background-color: rgba(114, 62, 235, 0.2);
                opacity: 1;
            }
            .swiper-pagination .swiper-pagination-bullet-active {
                background-color: #723eeb;
                width: 25px;
                border-radius: 10px;
            }
            .swiper-notification {
                display: none;
            }
            .client .client-slider .client-thumb img {
                width: 60px;
                height: 60px;
                border-radius: 999px;
            }
            .client .client-slider h3{
                font-size: 20px;
                clear: both;
                line-height: 1.3em;
                color: #000000;
                -webkit-font-smoothing: antialiased;
                font-family: "Outfit", sans-serif;
                font-weight: 600;
            }
            .client .client-slider p {
                line-height: 1.7em;
                margin-bottom: 0px;
            }
        </style>
    @endpush
    <!--=======Client-Section Ends Here=======-->