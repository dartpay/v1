@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container pt-100 pb-100">
    <div class="row mb-2 justify-content-end gy-4">
        <div class="col-lg-4">
            <form class="mb-3">
                <div class="input-group">
                    <input name="search" value="{{ request()->search ?? '' }}" type="text" class="form--control form-control" placeholder="@lang('Search by Transaction ID')">
                    <button type="submit" class="btn btn--base input-group-text border-none-redus"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="card custom--card">
                <div class="card-body p-0">
                    <table class="table custom--table table-responsive--md">
                        <thead>
                            <tr>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Receiving Method')</th>
                                <th>@lang('Send Amount')</th>
                                <th>@lang('Rate')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Receivable')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdraws as $withdraw)
                                <tr>
                                    <td>{{ __($withdraw->trx) }}</td>
                                    <td>{{ __($withdraw->method->name) }}</td>
                                    <td>{{ getAmount($withdraw->get_amount)}} {{ __($general->cur_text) }} </td>
                                    <td>{{ getAmount($withdraw->rate) }} {{ __($withdraw->method->cur_sym) }}</td>
                                    <td>{{ getAmount($withdraw->charge) }} {{ __($withdraw->method->cur_sym) }}</td>
                                    <td>{{ getAmount($withdraw->final_amount) }} {{ __($withdraw->method->cur_sym) }}</td>
                                    <td data-input="@lang('Status')">
                                        @if ($withdraw->status == 2)
                                            <span class="badge badge-warning">@lang('Pending')</span>
                                        @elseif($withdraw->status == 1)
                                            <span class="badge badge-success">@lang('Completed')</span>
                                            
                                        @elseif($withdraw->status == 3)
                                            <span class="badge badge-danger">@lang('Rejected')</span>
                                           
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('user.withdraw.details',$withdraw->trx) }}" class="btn btn--base-outline btn-sm btn btn-primary btn-sm approveBtn">
                                            <i class="fa fa-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('style')

    <style>

        .approveBtn{
            width: 43px;
            height: 40px;
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #3fcc71;
            border-color: #454d55;
        }
        
        .modal-header .close {
            padding: 1rem 1rem;
            margin: -1rem -1rem;
        }
        
        .modal-header{
            background: #0a0925;
        }
        .modal-header .modal-title {
            color: #fff;
        }
        .modal .btn {
            height: 40px;
        }

        .withdraw_log {
            width: 100%;
            overflow-y: auto;
        }
        .withdraw_log .transaction-table td {
            min-width: 130px;
        }

        .time-deg{
            min-width:170px;
            font-size:14px
        }
        .border-none-redus{
            border-radius: 0 5px 5px 0;
        }
        input:focus{box-shadow: none !important;}
    </style>

@endpush
