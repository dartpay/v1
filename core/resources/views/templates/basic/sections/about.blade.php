@php
    $get = getContent('about.content',true);
@endphp

    <!--=======About-Section Starts Here=======-->
    <section class="overflow-hidden pt-150 pb-40 about-whyChoose">
        <div class="container-xl mx-auto">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 left-content my-auto">
                    <h3>{{trans($get->data_values->heading)}}</h3>
                    <p><?=  trans($get->data_values->description) ?></p>
                </div>
                <div class="col-lg-6 col-md-12 col-12 right-img">
                    <div>
                        <img src="{{getImage('assets/images/frontend/about/'.$get->data_values->about_image)}}" alt="@lang('about')">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=======About-Section Ends Here=======-->