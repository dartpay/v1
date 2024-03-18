<?php

namespace App\Http\Controllers\Admin;

use App\Models\CommissionLog;
use App\Models\Currency;
use App\Models\Exchange;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Refferal;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function index()
    {
        $page_title = 'Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user')->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange',compact('page_title','empty_message','exchanges'));
    }

    public function details(Exchange $exchange)
    {
        $page_title = 'Exchange';
        return view('admin.exchange.details',compact('page_title','exchange'));
    }

    public function cancle(Request $request,Exchange $exchange)
    {
       $request->validate([
            'reasonOf_Cancle' => 'required|max:500'
       ]);  

        $exchange->cancle_reason = $request->reasonOf_Cancle;
        $exchange->status = 3;
        $exchange->save();

        notify($exchange->user, 'CANCEL_EXCHANGE', [
           'exchange' => $exchange->exchange_id,
           'reason' => $exchange->cancle_reason
        ]);

        $notify[] = ['success', 'cancle this transaction'];
        return back()->withNotify($notify);
    }      


    public function approved(Exchange $exchange, Request $request)
    {
        $request->validate([
            'transaction'=>'required'
        ]);


        $currency = Currency::latest()->get()->map(function($item) use ($exchange){

            if(strtolower($item->name) ==  strtolower($exchange->payment_to_getway->name)){
                return $item;
            }
        })->reject(function($item){
            return empty($item);
        })->first();

        $currencyAdd = Currency::latest()->get()->map(function ($item) use ($exchange) {
            if (strtolower($item->name) ==  strtolower($exchange->payment_from_getway->name)) {
                return $item;
            }
        })->reject(function ($item) {
            return empty($item);
        })->first();

        // reffereal commission
        
        $user = User::find($exchange->user_id);
        
        $this->levelCommision($user->id,$exchange->buy_rate, $exchange->get_amount,'commission for Exchange',$exchange->exchange_id);
        

        $amountsub = $currency->reserve - $exchange->send_amount;
        $currency->reserve = $amountsub;
        $currency->save();

        $currencyAdd->reserve = $currencyAdd->reserve +  $exchange->get_amount;
        $currencyAdd->save();

        $exchange->status = 2;
        $exchange->admin_trnx_no = $request->transaction;
        $exchange->save();

        notify($exchange->user, 'APPROVED_EXCHANGE', [
            'exchange' => $exchange->exchange_id,
            'method' => $exchange->payment_from_getway->name,
            'currency'  => $exchange->payment_to_getway->cur_sym,
            'amount' => $exchange->send_amount,
        ]);

        $notify[] = ['success', 'Approved Transaction Successfully'];
        return back()->withNotify($notify);
    }

    public function refund(Exchange $exchange, Request $request)
    {
        
        $request->validate([
            'reasonOf_refund' => 'required|max:200'
        ]);
        
        $exchange->refund_amount = $exchange->get_amount;
        $exchange->refund_reason = $request->reasonOf_refund;
        $exchange->status = 4;
        $exchange->save();

        notify($exchange->user, 'EXCHANGE_REFUND', [
            'exchange' => $exchange->exchange_id,
            'currency'  => $exchange->payment_from_getway->cur_sym,
            'amount' => $exchange->refund_amount,
            'method' => $exchange->payment_from_getway->name,
            'reason' => $exchange->refund_reason
        ]);

        $notify[] = ['success', 'Refund Transaction Successfully'];
        return back()->withNotify($notify);
    }


    public function approvedExchange()
    {
        $page_title = 'Approved Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user')->where('status',2)->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }


    public function pendingExchange()
    {
        $page_title = 'Pending Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user', 'payment_from_getway', 'payment_to_getway')->where('status', 0)->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }

    public function proccessingExchange()
    {
        $page_title = 'Pending Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user', 'payment_from_getway', 'payment_to_getway')->where('status', 1)->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }

    public function refundedExchange()
    {
        $page_title = 'Refunded Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user')->where('status', 4)->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }

    public function canceledExchange()
    {
        $page_title = 'Canceled Exchange';
        $empty_message = 'No Exchange Found';
        $exchanges = Exchange::where('user_id','!=', null)->with('user')->where('status', 3)->latest()->paginate(getPaginate());
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }


    public function search(Request $request)
    {

        if (!$request->search) {
            $notify[] = ['error', 'invalid request'];
            return back()->withNotify($notify);
        }
        $searchItem = Currency::where('name','LIKE','%'.$request->search.'%')->pluck('id')->toArray();
      
        $exchanges =   Exchange::whereIn('payment_from',$searchItem)
                                ->orWhereIn('payment_to',$searchItem)
                                ->paginate(getPaginate());

        $page_title = "All Currency";
        $empty_message = 'No Result Found for the search ' . $request->search;

        if($exchanges->count() <= 0 ){
            $notify[] = ['error', $empty_message];
            return back()->withNotify($notify);
        }
        return view('admin.exchange.allexchange', compact('page_title', 'empty_message', 'exchanges'));
    }


    protected function levelCommision($id, $buy_rate, $amountSendByUser, $commissionType = '',$trx)
    {
        $usr = $id;
        $i = 1;
        $amount = $amountSendByUser * $buy_rate;
        
        $level = Refferal::count();
        $gnl = GeneralSetting::first();

        while ($usr != "" || $usr != "0" || $i < $level) {
            $me = User::find($usr);
            $refer = User::find($me->ref_by);
            if ($refer == "") {
                break;
            }
            $comission = Refferal::where('level', $i)->first();
            if ($comission == null) {
                break;
            }

            $com = ($amount * $comission->percent) / 100;

            $referWallet = User::where('id', $refer->id)->first();
            $new_bal = getAmount($referWallet->balance + $com);
            $referWallet->balance = $new_bal;
            $referWallet->save();

            Transaction::create([
                'user_id' => $refer->id,
                'amount' => getAmount($com),
                'charge' => 0,
                'trx_type' => '+',
                'remark' => 'commission',
                'details' => $i . '  level Referral Commission',
                'trx' => $trx,
                'post_balance' => $new_bal,
            ]);

            CommissionLog::create([
                'user_id' => $refer->id,
                'who' => $id,
                'level' => $i . ' level Referral Commission',
                'amount' => getAmount($com),
                'main_amo' => $new_bal,
                'title' => $commissionType,
                'trx' => $trx,
            ]);

            notify($refer, 'REFERRAL_COMMISSION', [
                'amount' =>  getAmount($com),
                'post_balance' => $new_bal,
                'trx' => $trx,
                'level' => $i . ' level Referral Commission',
                'currency' => $gnl->cur_text
            ]);
            
            $usr = $refer->id;
            $i++;
        }
        return 0;
    }
}
