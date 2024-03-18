@extends($activeTemplate.'layouts.frontend')
@php
    $socials = getContent('social_icon.element',false);

@endphp


@section('content')
    <!--=======Blog-Section Starts Here=======-->
    <div class="container">
        <div class="row align-items-center justify-content-center pt-100 mt-5" >
            <div class="col-lg-12 text-center" >
                <div class="banner-content" >
                    <h2 class="title">@lang('Blog Details')</h2>
                    <div class="breadcrumb-area" >
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('Blog Details')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-details-section py-60">
        <div class="container">
            <div class="row pt-4 gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details ">
                        <div class="blog-v-item">
                            <div class="blog-item__thumb">
                                <img src="{{getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image)}}" alt="lang('blog-details')">
                            </div>
                            <div class="blog-item__content pt-3">
                                <ul class="text-list inline d-flex">
                                    <li class="text-list__item"> 
                                        <span class="text-list__item-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        {{$blog->created_at->format('d M Y, H:i A')}}
                                    </li>
                                    <li class="text-list__item"> 
                                        <span class="text-list__item-icon">
                                            <i class="far fa-user"></i>
                                        </span>
                                        @lang('Created By Admin')
                                    </li>
                                    <li class="text-list__item"> 
                                        <span class="text-list__item-icon">
                                            <i class="far fa-user"></i>
                                        </span>
                                        @lang('Total View :'.' '. $blog->clicks)
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-details__content wyg">
                            <h3 class="blog-details__title">
                                {{$blog->data_values->title}}
                            </h3>

                            <?= $blog->data_values->description_nic ?>

                            <h5 class="mb-2 mt-5">@lang('Like this post? share it your social network')</h5>
                            
                            <ul class="list list--row social-list justify-content-start ml-0">
                                @foreach($socials as $social)
                                    @if($social->data_values->title == 'facebook')
                                    <li>
                                        <a target="_blank" class="t-link social-list__icon" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}">
                                            <i class="lab la-facebook-f"></i>
                                        </a>

                                    </li>
                                    @elseif($social->data_values->title == 'twitter')
                                    <li>
                                        <a target="_blank" class="t-link social-list__icon {{$social->data_values->title}}" href="https://twitter.com/intent/tweet?text={{ __(@$blog->data_values->title) }}%0A{{ url()->current() }}">
                                            @php
                                                echo $social->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                    @elseif($social->data_values->title == 'linkdin')
                                    <li>
                                        <a target="_blank" class="t-link social-list__icon {{$social->data_values->title}}" href="{{$social->data_values->url.'shareArticle?mini=true&amp;url='.urlencode(url()->current())}}">
                                            @php
                                                echo $social->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="blog-sidebar__title">@lang('Latest Topics')</h5>
                            @foreach ($blogs as $blog)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('blog.details', ['id' => $blog->id, 'slug' => slug(@$blog->data_values->title)]) }}">
                                            <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->blog_image) }}" alt="blog-image">
                                        </a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title">
                                            <a href="{{ route('blog.details', ['id' => $blog->id, 'slug' => slug(@$blog->data_values->title)]) }}">
                                                {{ strLimit(@$blog->data_values->title, 50) }}
                                            </a>
                                        </h6>
                                        <span class="latest-blog__date">{{ showDateTime($blog->created_at, 'M Y, H:i A') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=======Blog-Section Ends Here=======-->
    @push('fb-comment')
        @php echo loadFbComment() @endphp
    @endpush
@endsection

@push('style')
    <style>
        .blog-image-thumb {
            width: 70px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .exchange-nav .navbar .navbar-nav .nav-item .nav-link{
            color: #000;
        }
        .dropdown button{
            color: #000;
        }
        .black-logo{
            display: block !important;
        }
        .white-logo{
            display: none;
        }
    </style>
@endpush
