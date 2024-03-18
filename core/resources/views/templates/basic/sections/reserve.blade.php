@php
    $currencys = App\Models\Currency::where('available_for_sell',1)->where('available_for_buy',1)->where('show_rate',1)->latest()->take(3)->get();
    $reserve = getContent('reserve.content',true);
@endphp



@push('script')
    <script>
        'use strict'
        $(function(){
            $('.custom-button').on('click',function(){
                var item = $(this).data('item');
                $.ajax({
                    method:'GET',
                    url:"{{route('load')}}",
                    data:{items:item},
                    success:function(response){
                       $('#loadMore').html(response);
                       
                    }
                })  
            })
        })
    </script>
@endpush
