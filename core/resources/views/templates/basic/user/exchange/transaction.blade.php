@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="container padding-top padding-bottom">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card section-bg">
                    <div class="card-header">
                        <h5 class="title text-white text-center m-0">@lang('Transaction Verify')</h5>
                    </div>
                    <div class="card-body section-bg">
                        <p>@lang('This exchange is done manually by an operator.')</p>

                        <p>{{ $exchange->payment_from_getway->name }} {{ $exchange->get_amount }}
                            {{ $exchange->payment_from_getway->cur_sym }} To {{ $exchange->payment_to_getway->name }}
                            {{ $exchange->send_amount }} {{ $exchange->payment_to_getway->cur_sym }}
                        </p>

                        <p><?= $currency->receving_details ?></p>
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        @foreach (json_decode($currency->user_proof) as $proof)
                                                          @if ($proof->type == 'file')


                                                                <div class="image-show">
                                                                    <img src="" alt="" id="image" class="img-fluid w-100" >
                                                                </div>

                                                            <div class="custom-file mb-3">

                                                                <div>
                                                                <input type="{{ $proof->type }}" class="custom-file-input" id="customFile" name="{{ str_replace(' ', '_', strtolower($proof->field_name)) }}" placeholder="{{ $proof->field_name }}" {{ $proof->validation }}>
                                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                                </div>
                                                                
                                                            </div>

                                                            @continue

                                                          @endif
                                                            <div class="form-group mt-4">
                                                                <label for="">{{ trans(strtoupper($proof->field_name)) }}</label>
                                                                <input type="{{ $proof->type }}" name="{{ str_replace(' ', '_', strtolower($proof->field_name)) }}" class="form-control" placeholder="{{ $proof->field_name }}" {{ $proof->validation }}>
                                                            </div>
                                                        @endforeach

                                                        
                                                            

                                                        <div class="form-group m-0">
                                                            <input type="submit" value="Exchange Request" class="bg_theme">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


@endsection

@push('style')

                        <style>
                           .custom-file{
                               width: 30%;
                           }


                           .image-show{
                                width: 30%;
                                height: 200px;
                                background: dimgray;
                                margin-bottom: 20px;
                           }

                           .form-group input{
                       
                        -webkit-border-radius: 0;
                        -moz-border-radius: 0;
                        border-radius: 0;
                        height: 60px;
                        padding: 0 25px;
                        color: #ffffff;
                        font-size: 20px;
                        background: #fff;
                    }
                    

                    .table{
                        color: #ffffff;
                    }


                 
                           
                        </style>
                            
@endpush


@push('script')
                            <script>
                                'use strict';
                                    $(".custom-file-input").on("change", function() {
                                    var fileName = $(this).val().split("\\").pop();
                                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                    });

                                     function showImagePreview(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function (e) {
                                                    $('#image').attr('src', e.target.result);
                                                }

                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }

                                    $("#customFile").on('change' , function(){
                                    showImagePreview(this);
                                    });
                        </script>
@endpush
