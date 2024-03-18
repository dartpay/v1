<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\CommissionLog;
use App\Models\NotificationLog;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction()
    {
        $page_title = 'Transaction Logs';
        $transactions = Transaction::with('user')->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Transactions Search - ' . $search;
        $empty_message = 'No transactions.';

        $transactions = Transaction::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('username', 'like',"%$search%");
        })->orWhere('trx', $search)->orderBy('id','desc')->paginate(getPaginate());

        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function loginHistory(Request $request) {
        $login_logs = UserLogin::orderBy('id', 'desc')->with('user');
        $page_title = 'User Login History';
        $empty_message = 'No search result found.';
        $login_logs = UserLogin::orderBy('id', 'desc')->searchable(['user:username'])->with('user')->paginate(getPaginate());
        return view('admin.reports.logins', compact('page_title', 'login_logs','empty_message'));
    }

    public function loginIpHistory($ip)
    {
        $page_title = 'Login By - ' . $ip;
        $login_logs = UserLogin::where('user_ip',$ip)->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No users login found.';
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function notificationHistory(Request $request) {
        $page_title = 'Notification History';
        $emptyMessage = 'Data not found';
        $logs  = NotificationLog::orderBy('id', 'desc')->searchable(['user:username'])->with('user')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('page_title', 'logs','emptyMessage'));
    }

    public function emailDetails($id) {
        $page_title = 'Email Details';
        $emptyMessage = 'Data not found';
        $email = NotificationLog::findOrFail($id);
        return view('admin.reports.email_details', compact('page_title', 'email','emptyMessage'));
    }
    public function referralCommission() {
        $page_title = 'Referral Commissions';
        $emptyMessage = 'Data not found';
        $commissions = CommissionLog::orderBy('id', 'desc')->with('reffer', 'user')->paginate(getPaginate());
        return view('admin.reports.referral_commission', compact('page_title', 'commissions','emptyMessage'));
    }
}
