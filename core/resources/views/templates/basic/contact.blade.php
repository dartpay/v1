@extends($activeTemplate.'layouts.frontend')
@php
    $contact = getContent('contact_us.content',true)
@endphp
@section('content')
    <div class="page-title pt-100">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row align-items-center justify-content-center pt-100 mt-0" style="height: auto !important;">
                        <div class="col-lg-12 text-center" style="height: auto !important;">
                            <div class="banner-content" style="height: auto !important;">
                                <h2 class="title">{{ __($page_title) }}</h2>
                                <div class="breadcrumb-area" style="height: auto !important;">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ __($page_title) }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=======Contact-Section Starts Here=======-->
    <section class="contact-form-area style-two pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-form-thumb wow fadeInRight animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                        <img src="{{asset('assets/images/frontend/contact_us/'.$contact->data_values->image_property)}}" alt="@lang('contact')">
                        <div class="form-inner-thumb bounce-animate3">
                            <img src="{{asset('assets/images/frontend/contact_us/'.$contact->data_values->button_image)}}" alt="@lang('contact')">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row">
                        <div class="contact-form-box wow fadeInLeft animated" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                             <div class="contact-form-title">
                                <h3>{{$contact->data_values->title}}</h3>
                             </div> 
                            <form class="contact-form" id="contact_form" method="post" action="">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                                        <label for="name">@lang('Your Name')<span>*</span></label>
                                        <input type="text" name="name" class="form--control" value="{{ old('name') }}" placeholder="@lang('Your Name')" required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                                        <label>@lang('Email')<span>*</span></label>
                                        <input type="email" name="email" class="form--control" placeholder="@lang('Enter E-Mail')"  value="{{old('email')}}" required>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 form-group">
                                        <label>@lang('Subject')<span>*</span></label>
                                        <input type="text" name="subject" class="form--control" placeholder="@lang('Write your subject')" value="{{old('subject')}}" required>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 form-group">
                                        <label>@lang('Your Message')<span>*</span></label>
                                        <textarea class="form--control" name="message" placeholder="@lang('Write your message')" required>{{old('message')}}</textarea>
                                    </div>
                                </div>
                                <div class="from-box">
                                    <input class="btn btn--base" type="submit" value="Send Message">
                                </div>
                            </form>
                            <div id="status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="contact-info-list mt-5">
                <li class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon bg--base text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-map-marked-alt"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Our Address')</h4>
                        <p class="mt-3">{{$contact->data_values->address}}</p>
                    </div>
                </li><!-- single-info end -->
                <li class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon bg--base text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-envelope"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Email Address')</h4>
                        <p class="mt-3">
                            <a href="mailto:{{$contact->data_values->email_address}}" class="text--secondary">
                                {{$contact->data_values->email_address}}
                            </a>
                        </p>
                    </div>
                </li><!-- single-info end -->
                <li class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon bg--base text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-phone-volume"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Phone Number')</h4>
                        <p class="mt-3"><a href="tel:{{$contact->data_values->contact_number}}" class="text--secondary">{{$contact->data_values->contact_number}}</a></p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!--=======Contact-Section Ends Here=======-->
@endsection
