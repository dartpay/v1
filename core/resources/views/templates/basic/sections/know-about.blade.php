@php
   
    $content = getContent('know-about.content',true);
    $elements = getContent('know-about.element');
@endphp


    <!--======= know_about Starts Here =======-->

    <section class="know_about-section ptb-80">
        <div class="circle-blur"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img src="https://envato.appdevs.net/escroc/public/frontend/images/site-section/38e9276d-ba8b-4a2f-ac7c-fec5ee591d27.webp" alt="element">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-content">
                        <span class="sub-title gradient-text">{{__($content->data_values->name_page)}}</span>
                        <h2 class="title">{{__($content->data_values->heading)}}</h2>
                        <p>{{__($content->data_values->sub_heading)}}</p>
                        <ul class="about-list">
                            @foreach($elements as $element )
                            <li>
                                @php
                                    echo $element->data_values->know_icon;
                                @endphp
                                {{__($element->data_values->item)}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======= know_about Ends Here =======-->