@php
    
    $footer_content = getContent('footer.content',true);
    $socials = getContent('footer.element',false);
    $policyPages = getContent('policy.element', false, null, true);

@endphp
<!--=======Footer-Section Starts Here=======-->
<!--=======Footer-Section Starts Here=======-->
<footer class="footer-area bg--img">
    <div class="footer-bottom-bgpppp"></div>
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-4 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <a href="{{ route('home') }}" class="footer-logo-normal" id="footer-logo-normal"> 
                                <img src="{{ siteLogo('dark') }}" alt="@lang('footer')">
                            </a>
                        </div>
                        <p class="footer-item__desc wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                          {{ __($footer_content->data_values->details) }}
                        </p>
                        <ul class="social-list wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                          @foreach ($socials as $social)
                            <li class="social-list__item">
                                <a href="{{ $social->data_values->url }}"
                                    class="{{ strtolower($social->data_values->icon_title) }} social-list__link">
                                    <?= $social->data_values->feature_icon ?>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Support')</h5>
                        <ul class="footer-menu">
                            @foreach ($pages as $k => $data)
                                <li class="footer-menu__item">
                                    <a href="{{ route('pages', [$data->slug]) }}" class="footer-menu__link">{{ __($data->name) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">Company Links</h5>
                        <ul class="footer-menu">
                            @foreach ($policyPages as $policy)
                                <li class="footer-menu__item">
                                    <a href="{{ route('policy', [$policy->id,slug($policy->data_values->title)]) }}" class="footer-menu__link" target="_blank">{{ __($policy->data_values->title) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">Contact Us</h5>
                        <div class="footer-contact-info mb-3">
                          <p><a href="tel:{{trans($general->phone)}}">{{trans($general->phone)}}</a> </p>
                        </div>
                        <div class="footer-contact-info mb-3">
                          <p><a href="mailto:{{trans($general->email_from)}}">{{trans($general->email_from)}}</a></p>
                        </div>
                        <div class="footer-contact-info">
                          <p>{{trans($general->location)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bottom Footer -->
        <div class="bottom-footer py-3">
            <div class="container">
                <div class="row text-center gy-2">
                    <div class="col-lg-12">
                        <div class="bottom-footer-text"> <p>{{ __(@$footer_content->data_values->copyright) }}</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div1>

    <!--=======Footer-Section Ends Here=======-->
<!--=======Footer-Section Ends Here=======-->