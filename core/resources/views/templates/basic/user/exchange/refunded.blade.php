@extends($activeTemplate.'layouts.master')
@section('content')


    <div class="dashboard-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-md-12 col-lg-12">
                    <h3 class="text-center mb-3">@lang($page_title)</h3>
<div class="card custom--card">
                        <div class="card-body p-0">
                            <table class="table custom--table table-responsive--md table-new-cok2mm">
                                <thead class="t-header">
                                    <tr>
                                        <th scope="col">@lang('User Exchanger')</th>
                                        <th scope="col">@lang('Sent')</th>
                                        <th scope="col">@lang('Received')</th>
                                        <th scope="col">@lang('Amount')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Date')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exchanges as $exchange)
                                    <tr>
                                        <td data-input="@lang('Exchanger')">
                                            <div class="exchanger"> 
                                                <div class="content pl-0">
                                                    <span>{{$exchange->user->username}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-start" data-input="@lang('From')">
                                            {{ $exchange->payment_from_getway->name }}
                                        </td>
                                        <td class="text-start" data-input="@lang('To')">
                                            <span>
                                                {{ $exchange->payment_to_getway->name }}
                                            </span>
                                        </td>
                                        <td data-input="@lang('Amount')">
                                            {{$exchange->get_amount}} {{$exchange->payment_from_getway->cur_sym}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            {{$exchange->send_amount}} {{$exchange->payment_to_getway->cur_sym}}
                                        </td>
                                        <td data-input="@lang('Status')">
                                            <span class="d-block float-left text--small badge font-weight-normal badge-secondary">@lang('Refund')</span>
                                        </td>
                                        <td data-input="@lang('Time')">
                                            <div>
                                                <span class="d-block">{{$exchange->created_at->format('d-m-y H:i A', strtotime($exchange->created_at))}}</span>
                                                <span>{{ Carbon\Carbon::parse($exchange->created_at)->diffForHumans()}}</span>
                                            </div>
                                        </td>
                                        <td data-input="@lang('Action')">
                                            <a href="{{route('user.exchange.details',$exchange->id)}} " class="details cmn-btn btn-sm" data-from="{{ $exchange->payment_from_getway->name }}" data-to="{{ $exchange->payment_to_getway->name }}" data-reason="{{ $exchange->refund_reason }}"><i class="fas fa-desktop"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="card-footer py-4">
                        {{ $exchanges->links('admin.partials.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" tabindex="-1" role="dialog" id="detailsModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <h5 class="mb-4">@lang('Refund Reason :')</h5>
        <p class="cancle-reason"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>
  </div>
</div>



@endsection

@push('style')
 
    <style>
    
       .thumb img {
            height: 30px;
            width: 30px;
            object-fit: contain;
            border-radius: 50%;
            margin-right: 10px;
        }
        .nowrap {
            white-space: nowrap;
        }

        td a i{
            color:seagreen
        }
        .table-new-cok2mm td{
            vertical-align: middle;
        }
        .custom--card{
            border-top: 0;
            border-radius: 5px;
        }
        .cmn-btn {
            position: relative;
            background: #4d5bed;
            color: white;
            padding: 8px 25px;
            text-transform: capitalize;
            box-shadow: 0px 10px 16px 0px rgba(77, 91, 237, 0.2);
            border-radius: 5px;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            font-weight: 500;
            z-index: 2;
            overflow: hidden;
            -webkit-transition: all ease 0.5s;
            -moz-transition: all ease 0.5s;
            transition: all ease 0.5s;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .cmn-btn {
            background: #6c14c7;
            box-shadow: 0px 10px 16px 0px #6c14c733;
        }
        .cmn-btn:focus, .cmn-btn:hover {
            color: white;
            box-shadow: 0px 10px 26px 0px rgba(77, 91, 237, 0.5);
        }
        .cmn-btn:focus, .cmn-btn:hover {
            color: white;
            box-shadow: 0px 10px 26px 0px #6c14c780;
        }
        .cmn-btn i {
            color: #fff;
        }
        .t-header{
            background-color: #6c14c7;
            font-size: 15px;
            padding: 15px;
            width: 16%;
            background-color: #2985c8;
            font-family: #000;
            font-weight: 500;
            color: #fff;
            vertical-align: middle;
        }
        .t-header th{border: 0;padding: 15px 0.75rem;}
        .t-header th:first-child{
            border-radius: 5px 0px 0 0;
        }
        .t-header th:last-child{
            border-radius: 0 5px 0 0;
        }
        .badge-warning{color: #ffff}
    </style>
@endpush


@push('script')
    <script>
         'use strict';
        $(function(){
           
            
            $('.details').on('click',function(){
                var modal = $('#detailsModal');
                var icon = `<i class="fas fa-exchange-alt"></i>`;

                var title =  $(this).data('from')+ ' ' +icon+ ' ' + $(this).data('to')

                modal.find('.modal-title').html(title);
                modal.find('.cancle-reason').text($(this).data('reason'));

            });
        })
    
    </script>    
@endpush