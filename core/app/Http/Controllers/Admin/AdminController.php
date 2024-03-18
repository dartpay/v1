<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Exchange;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\AdminNotification;
use App\Lib\CurlRequest;
use App\Rules\FileTypeValidate;
use App\Models\UserLogin;
use App\Models\Withdrawal;
use App\Constants\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        $page_title = 'Dashboard';

        // User Info
        $widget['total_users'] = User::count();
        $widget['verified_users'] = User::where('status', 1)->count();
        $widget['email_verified_users'] = User::where('ev', 1)->count();
        $widget['sms_verified_users'] = User::where('sv', 1)->count();

        // Monthly Deposit & Withdraw Report Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);

        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount * rate END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();


        $depositsMonth->map(function ($aaa) use ($report) {
            $report['months']->push($aaa->months);
            $report['deposit_month_amount']->push(getAmount($aaa->depositAmount));
        });

        $withdrawalMonth = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN get_amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();
        $withdrawalMonth->map(function ($bb) use ($report) {
            $report['withdraw_month_amount']->push(getAmount($bb->withdrawAmount));
        });


        // Withdraw Graph
        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->select(array(DB::Raw('sum(get_amount)   as totalAmount'), DB::Raw('DATE(created_at) day')))
            ->groupBy('day')->get();
        $withdrawals['per_day'] = collect([]);
        $withdrawals['per_day_amount'] = collect([]);
        $withdrawal->map(function ($a) use ($withdrawals) {
            $withdrawals['per_day']->push(date('d M', strtotime($a->day)));
            $withdrawals['per_day_amount']->push($a->totalAmount + 0);
        });


        // user Browsing, Country, Operating Log
        $user_login_data = UserLogin::whereDate('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);


        $payment['payment_method'] = Gateway::count();
        $payment['total_exchange_amount'] = Exchange::selectRaw('sum(get_amount * buy_rate) as total_exchange')->where('status', 1)->first()->total_exchange;

        $payment['total_deposit_charge'] = Exchange::selectRaw('sum(charge * buy_rate) as total_charge')->where('status', 1)->first()->total_charge;
        $payment['total_deposit_pending'] = Exchange::selectRaw('sum(get_amount * buy_rate) as pending_exchange')->where('status', 0)->first()->pending_exchange;

        $paymentWithdraw['withdraw_method'] = Currency::count();
        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status', 1)->sum('get_amount');
        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::selectRaw('sum(charge * rate) as total_withdraw_charge')->where('status', 1)->first()->total_withdraw_charge;
        $paymentWithdraw['total_withdraw_pending'] = Withdrawal::where('status', 2)->count();


        $latestUser = User::latest()->limit(6)->get();

        $currency['total_currency'] = Currency::latest()->get()->count();
        $currency['total_exchange'] = Exchange::latest()->get()->count();
        $currency['approved_exchange'] = Exchange::latest()->where('status', 1)->count();
        $currency['refunded_exchange'] = Exchange::latest()->where('status', 3)->count();

        return view('admin.dashboard', compact('page_title', 'widget', 'report', 'withdrawals', 'chart', 'payment', 'paymentWithdraw', 'latestUser', 'currency'));
    }

    public function notifications() {
        $notifications = AdminNotification::orderBy('id', 'desc')->with('user')->paginate(getPaginate());
        $page_title = 'Notifications';
        $emptyMessage  = 'Data not found';
        return view('admin.notifications', compact('page_title', 'notifications','emptyMessage'));
    }


    public function notificationRead($id) {
        $notification = AdminNotification::findOrFail($id);
        $notification->is_read  = Status::YES;
        $notification->save();
        $url = $notification->click_url;
        if ($url == '#') {
            $url = url()->previous();
        }
        return redirect($url);
    }

    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $user = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = uploadImage($request->image, imagePath()['profile']['admin']['path'], imagePath()['profile']['admin']['size'], $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('admin.profile')->withNotify($notify);
    }


    public function password()
    {
        $page_title = 'Password Setting';
        $admin = Auth::guard('admin')->user();
        return view('admin.password', compact('page_title', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password Do not match !!'];
            return back()->withErrors(['Invalid old password.']);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password Changed Successfully.'];
        return redirect()->route('admin.password')->withNotify($notify);
    }


    public function refferUser(User $user)
    {
        $page_title = 'Reffer Users';
        $empty_message = 'No user found';
        $users = User::where('ref_by', $user->id)->latest()->paginate(getPaginate());
        return view('admin.users.list', compact('page_title', 'empty_message', 'users'));
    }
    public function readAll() {
        AdminNotification::where('is_read', Status::NO)->update([
            'is_read' => Status::YES
        ]);

        $notify[] = ['success', 'Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function downloadAttachment($fileHash) {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = GeneralSetting::first();
        $title = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

}
