@php

    $content = getContent('feature.content',true);
    $elements = getContent('feature.element',false);
@endphp

<!--=======Feature-Section Starts Here=======-->
<section class="features ptb-60 bg_img-2">
    <div class="container mx-auto">
        <div class="text-content">
            <h4>{{__($content->data_values->heading)}}</h4>
            <h3>{{__($content->data_values->sub_heading)}}</h3>
        </div>
        <div class="row g-3 pt-40">
            @foreach($elements as $element )
                <div class="col-lg-4 col-md-6 col-12 aos-init" data-aos="zoom-in">
                    <div class="card">
                        <div class="d-flex">
                            <div class="thumb feature-thumb">
                                @php
                                    echo $element->data_values->feature_icon;
                                @endphp
                            </div>
                            <div>
                                <h3>{{__($element->data_values->title)}}</h3>
                                <p>{{__($element->data_values->description)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--=======Feature-Section Ends Here=======-->
@push('script')
    <script type="text/javascript">
        
        'use strict';
        
        AOS.init({ duration: 1200, });

    </script>
@endpush