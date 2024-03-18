<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use Closure;
use App\Models\GeneralSetting;
use Illuminate\Http\RedirectResponse;

class MaintenanceMode
{
    public function handle($request, Closure $next)
    {
        $general = GeneralSetting::first();
        if ($general->maintenance_mode == Status::ENABLE) {

            if ($request->is('api/*')) {
                $notify[] = 'Our application is currently in maintenance mode';
                return response()->json([
                    'remark'=>'maintenance_mode',
                    'status'=>'error',
                    'message'=>['error'=>$notify]
                ]);
            }else{
                return redirect()->route('maintenance');
            }
        }
        return $next($request);
    }
}
