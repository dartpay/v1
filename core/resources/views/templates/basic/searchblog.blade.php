@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="blog-section padding-top padding-bottom section-bg">
        <div class="container">
            <div class="row justify-content-center ">
                
                    @forelse($blogSearch as $blog)
                        <div class="col-md-6 col-xl-4 col-sm-10">
                            <div class="post-item">
                                <div class="post-thumb c-thumb">
                                    <a href="{{route('blog.details',['id'=>$blog->id,'slug'=>slug($blog->data_values->title)])}}">
                                        <img src="{{getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image,'600x400')}}" alt="blog">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="blog-header">
                                        <h6 class="title">
                                            <a href="{{route('blog.details',['id'=>$blog->id,'slug'=>slug($blog->data_values->title)])}}">
                                                {{$blog->data_values->title}}
                                            </a>
                                        </h6>
                                    </div>
                                    <div class="meta-post">
                                        <div class="date">
                                            <a href="#0">
                                                <i class="far fa-calendar-alt"></i>
                                                {{$blog->created_at->format('M d, Y')}}
                                            </a>
                                        </div>
                                        <div class="comment">
                                            <a href="#0">
                                                <i class="far fa-user"></i>
                                                @lang('Created By Admin')
                                            </a>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                       @php
                                            echo shortDescription($blog->data_values->description_nic,150);
                                        @endphp  
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                   

                @empty

                   
                        <h3 class="text-center text-danger d-block w-100">@lang($empty_message)</h3>
                    
                    
                        <div class="text-center mt-4">
                            <a class="btn btn-success font-weight-bold text-light" href="{{url()->previous()}}">@lang('Back To Previous')</a>
                        </div>
                   

                @endforelse
               
            </div>
        </div>
</section>


@endsection