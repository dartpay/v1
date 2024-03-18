    @php

        $blog = getContent('blog.content',true);

        $blogs = getContent('blog.element',false);
    @endphp

    <!--=======BLog-Section Starts Here=======-->
    <section class="blog-section pt-150 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-7 text-center">
                    <div class="section-header">
                        <span class="section-sub-title"><span class="gradient-text">{{trans($blog->data_values->heading)}}</span></span>
                        <h2 class="section-title">{{trans($blog->data_values->sub_heading)}}</h2>
                    </div>
                </div>
            </div>
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

    @push('style')
        <style>
            .nowrap{
                white-space: nowrap;
            }
        </style>
    @endpush