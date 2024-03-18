@php
   
    $content = getContent('faq.content',true);
    $elements = getContent('faq.element',false);
@endphp


    <!--=======Faq-Section Starts Here=======-->
    <section class="faq-section bg--img" style="background-image: url(https://preview.wstacks.com/changehub/assets/presets/default/images/faq-bg.png)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9">
                    <div class="section-content">
                        <h2 class="title mb-2 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            {{__($content->data_values->heading)}}    
                        </h2>
                        <p class="subtitle wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                            {{__($content->data_values->sub_heading)}}    
                        </p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 gy-4 justify-content-center">
                <div class="col-xl-6 d-none d-xl-block">
                    <div class="faq-left-side wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                        <div class="faq-section-thumb">
                            <img src="{{getImage('assets/images/frontend/faq/'.$content->data_values->faq_image)}}" alt="@lang('faq')">
                        </div>
                    </div>
                </div>
                <!-- < faq -->
                <div class="col-xl-6 col-lg-12">
                    <div class="accordion custom--accordion accordion-flush" id="accordionExample">
                        @foreach($elements as $element)
                            <div class="accordion-item"> 
                                <h2 class="accordion-header" id="heading0">
                                    <button class="accordion-button {{$loop->iteration == 1 ? ' ' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="{{$loop->iteration == 1 ? 'true' : 'false'}}" aria-controls="#collapse{{ $loop->iteration }}">
                                        {{__($element->data_values->question)}}
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse {{$loop->iteration == 1 ? ' show' : ''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            {{ __($element->data_values->answer) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=======Faq-Section Ends Here=======-->

    @push('style')
        <style type="text/css">
            button:focus{
                outline: none !important;
            }
        </style>
    @endpush