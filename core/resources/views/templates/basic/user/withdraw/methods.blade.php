@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container pt-100 pb-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom--card">
                    <div class="text-center card-header">
                        <h5>@lang('Withdraw Balance')</h5>
                        <span style="font-weight: 600">@lang('Your Current Balance Is: ') {{ showAmount(auth()->user()->balance) }} {{ __($general->cur_text) }}</span>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="formResubmit" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label required" for="currency">@lang('Select Method for Withdraw')</label>
                                <select name="currency" id="currency" class="form--control form-control" required="">
                                    <option value="" selected="" disabled="">@lang('Select Withdraw Method')</option>
                                    @foreach ($currencys as $currency)
                                        <option value="{{ $currency->id }}"
                                            data-url="{{ route('user.withdraw.ajax', $currency->id) }}">
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="d-flex justify-content-between mt-3 d-none min_max">
                                    <div class="min"></div>
                                    <div class="max"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 col-lg-6 form-group">
                                    <label class="form-label required">@lang('Send Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="send" class="form--control form-control" id="send" required="">
                                        <span class="input-group-text bg--base text-white border-0">
                                            {{$general->cur_sym}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 form-group">
                                    <label class="form-label required">@lang('Get Amount')</label>
                                    <div class="input-group">
                                        <input type="text" name="get_amount" class="form--control form-control" id="getAmount" required="" readonly="">
                                        <span class="input-group-text bg--base text-white border-0" id="basic-addon2"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="user_input form-group"> </div>
                            <button type="submit" class="btn btn--base w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalConfirm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdraw Balance')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger p-3">@lang('Are you sure all information is correct')?</p>
                </div>
                <div class="modal-footer d-flex">
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary confirmed">@lang('Withdraw')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('style')
    <style type="text/css">
        .bg--base{
            border-radius: 0 5px 5px 0;
        }
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .min,.max{
            font-weight: 600;
            font-size: 14px;
        }
        .form-group label{
            font-weight: 600;
            text-transform: capitalize;
        }
        .form--control{
            height: 55px;
        }
    </style>
@endpush
@push('script')
    <script>
        "use strict"
        $(document).ready(function() {
            
            $('#currency').on('change', function() {
                $('.user_input').empty();
                $('.min_max').removeClass('d-none');

                $('input[name=send]').val('');
                $('input[name=get_amount]').val('');

                var value = $(this).val();
                if(value == ''){
                    $('.min_max').addClass('d-none');
                   
                   return 0;
                }
                var url = $(this).find('option:selected').data('url');
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        currency: value
                    },
                    success: function(response) {
                        
                        $('.min').text("Min Exchange: " + response.min + '.00'+ " {{ $general->cur_sym }} ");
                        $('.max').text("Max Exchange: " + response.max + '.00' + " {{ $general->cur_sym }}");
                        $('#basic-addon2').text(response.cur_sym)
                        var length = response.user_input.length;
                      
                        for (let index = 0; index < length; index++) {
                            $('.user_input').append(`
                                
                            <div class="form-group">
                                <label for="">${response.user_input[index].field_name}</label>
                                <input class="form-control form--control" type="${response.user_input[index].type}" placeholder="${response.user_input[index].field_name}" name="wallet_info[${response.user_input[index].field_name.toLowerCase().replace(/\s/g,'_')}]" ${response.user_input[index].validation}
                                >
                            </div>`);
                        }
                    }
                });
            });




            $('#send').on('keyup paste',function() {
                
                var inputFieldValue = $(this).val();
                var optionValue = $('#currency').find('option:selected').val();

                $.ajax({
                    method:'GET',
                    url:"{{route('user.withdraw.ajax.amount')}}",
                    data:{inputValue:inputFieldValue, option:optionValue},
                    success:function(response){
                        if(response < 0){
                            $('#getAmount').val(0);
                            return 0;
                        }
                        var value = parseFloat(response).toFixed(2);
                        $('#getAmount').val(value);
                    }
                })
            });

            $('#submitForm').on('click',function(e){
                e.preventDefault();
                $('#modalConfirm').modal('show');
            });

            $('.confirmed').on('click',function(){
                $('#formResubmit').submit();
                $(this).attr('disabled','true');
            });
        });

    </script>

@endpush
