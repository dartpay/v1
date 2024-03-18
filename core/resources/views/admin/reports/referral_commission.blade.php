@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom--card ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('User')</th>
                                    <th>@lang('Commission From')</th>
                                    <th>@lang('Commission Level')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Transaction')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commissions as $commission)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ @$commission->reffer->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $commission->user_id) }}"><span>@</span>{{ @$commission->reffer->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ @$commission->user->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $commission->who) }}"><span>@</span>{{ @$commission->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>{{ __($commission->level) }}</td>
                                        <td>{{ getAmount($commission->amount) }} {{ __($general->cur_text) }}</td>
                                        <td>{{ __($commission->title) }}</td>
                                        <td>{{ $commission->trx }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($commissions->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($commissions) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>

    </div>
@endsection
