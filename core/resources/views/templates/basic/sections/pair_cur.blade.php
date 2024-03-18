@php
   
    $content = getContent('pair_cur.content',true);
    $elements = getContent('pair_cur.element');
@endphp


    <!--======= pair_cur Starts Here =======-->

    <section class="progress-section bg--img-2" style="background-image: url(https://preview.wstacks.com/changehub/assets/presets/default/images/process-bg.png)">
        <div class="container py-60">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-7">
                    <div class="section-content">
                        <h2 class="title mb-2 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            {{__($content->data_values->heading)}}
                        </h2>
                        <p class="subtitle text-center wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                            {{__($content->data_values->sub_heading)}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mx-0 gy-4">
            	@foreach($elements as $element )
                <div class="col-lg-4">
                    <div class="process-card">
                        <div class="tagg">
                            <h1>{{ $loop->iteration }}</h1>
                        </div>
                        <h6 class="title">{{__($element->data_values->title)}}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--======= pair_cur Ends Here =======-->