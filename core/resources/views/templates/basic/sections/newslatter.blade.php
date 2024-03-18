@php
    $newsletter = getContent('newslatter.content',true);
@endphp
    <!--=======Newslater-Section Starts Here=======-->
    <div class="subscribe-area pt-100 pb-100" style="background-image: url({{asset('assets/images/frontend/newslatter/'.$newsletter->data_values->image_property)}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-subscribe-box row justify-content-center align-items-center">
                        <div class="subscribe-title text-center">
                            <h1>{{__($newsletter->data_values->heading)}}</h1>
                            <p>{{__($newsletter->data_values->sub_heading)}}</p>
                        </div>
                        <div class="contact-form-box-2 text-center col-lg-7">
                            <form action="" method="POST" id="dreamit-form" class="subscription-form">
                                @csrf
                               <div class="input--group">  
                                    <input type="email" name="email" class="form--control" placeholder="@lang('Enter Email')" id="email">
                                    <button type="submit" id="subscribe" class="btn btn-base rounded-0"> 
                                        <span class="btn-text">@lang('Subscribe')</span> 
                                        <span class="btn-icon"><i class="fas fa-paper-plane"></i></span> 
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=======Newslater-Section Ends Here=======-->


    @push('style')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            .newsletter-section{
                background:#13114a;
            }
        </style>
        
    @endpush


    @push('script')
        <script>
            'use strict';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function(){
                var btn = $('#subscribe');
                $('#subscribe').on('click',function(e){
                    e.preventDefault();
                    var email = $('#email').val();
                    $.ajax({
                        method:'POST',
                        url:"{{route('subscribe')}}",
                        data:{email:email},
                        success:function(response){
                            
                            if(response.fails){
                                iziToast.error({
                                message: response.errorMsg.email,
                                position: "topRight"
                            });
                            }

                            if (response.success) {
                                iziToast.success({
                                message: response.successMsg,
                                position: "topRight",
                            });
                            }
                            
                            if (response.error) {
                                iziToast.error({
                                message: response.errorMsg,
                                position: "topRight"
                            });
                            }
                            
                            
                        }
                    });
                })
            })
        
        
        </script>        
    @endpush