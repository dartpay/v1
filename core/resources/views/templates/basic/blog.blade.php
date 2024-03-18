@extends($activeTemplate . 'layouts.frontend')

@php

    $blog = getContent('blog.content',true);

    $blogs = getContent('blog.element',false);

@endphp
    
@section('content')

    <!--=======BLog-Section Starts Here=======-->
    <div class="container">
    	<div class="row align-items-center justify-content-center pt-100 mt-5" style="height: auto !important;">
            <div class="col-lg-12 text-center" style="height: auto !important;">
                <div class="banner-content" style="height: auto !important;">
                    <h2 class="title">{{trans($page_title)}}</h2>
                    <div class="breadcrumb-area" style="height: auto !important;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans($page_title)}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-section ptb-80">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                @foreach($blogs as $blog)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image)}}" alt="@lang('blog')">
                        </div>
                        <div class="blog-content">
                            <div class="blog-info">
                                <div class="author">
                                    <span>@lang('Super Admin')</span>
                                </div>
                                <div class="date">
                                    <span>{{$blog->created_at->format('M d, Y')}}</span>
                                </div>
                            </div>
                            <h3 class="title">
                                <a href="{{route('blog.details',['id'=>$blog->id,'slug'=>slug($blog->data_values->title)])}}">
                                    {{__($blog->data_values->title)}}
                                </a>
                            </h3>
                            <div class="blog-btn">
                                <a href="{{route('blog.details',['id'=>$blog->id,'slug'=>slug($blog->data_values->title)])}}" class="custom-btn">
                                    Read More <i class="las la-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    @if(request()->is('/'))
                        @if($loop->iteration >= 3 )
                            @break
                        @endif
                    @endif

                @endforeach
            </div>
        </div>
    </section>
    <!--=======BLog-Section Ends Here=======-->

@endsection
    @push('style')
        <style>
            .nowrap{
                white-space: nowrap;
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