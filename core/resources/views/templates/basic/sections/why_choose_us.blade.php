@php
   
    $content = getContent('why_choose_us.content',true);
    $elements = getContent('why_choose_us.element');
@endphp


    <!--======= know_about Starts Here =======-->

    <section class="why-choose-us ptb-60">
        <div class="container mx-auto">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <img src="{{asset('assets/images/frontend/why_choose_us/'.$content->data_values->why_choose_image)}}" alt="image">
                </div>
                <div class="col-lg-6 col-md-12 col-12 my-auto">
                    <div class="text-content">
                        <h4>{{__($content->data_values->name_page)}}</h4>
                        <h3>{{__($content->data_values->heading)}}</h3>
                    </div> 
                    <div>
                        <p></p>
                        <p>{{__($content->data_values->sub_heading)}}</p><p></p>
                    </div>
                    <div class="d-flex mt-5">
                        <div class="mr-4 banner-join-btn">
                            <a href="javascript:void(0)" class="btn--base mb-4 mb-lg-0 mb-md-0">Get Started</a>
                        </div>
                        <div class="video-wrapper mt-0">
                            <a class="video-icon" data-rel="lightcase:myCollection" href="https://youtupe.com">
                                <i class="las la-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--======= know_about Ends Here =======-->