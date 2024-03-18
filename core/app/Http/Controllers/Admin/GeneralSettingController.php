<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralSetting;
use Image;
use App\Models\Frontend;
use App\Constants\Status;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general = GeneralSetting::first();
        $page_title = 'General Settings';
        return view('admin.setting.general_setting', compact('page_title', 'general'));
    }

    public function systemConfiguration()
    {

        $page_title = 'System Configuration';
        return view('admin.setting.configuration', compact('page_title'));
    }


    public function systemConfigurationSubmit(Request $request)
    {
        $general                  = GeneralSetting::first();
        $general->kv              = $request->kv ? Status::YES : Status::NO;
        $general->ev              = $request->ev ? Status::YES : Status::NO;
        $general->en              = $request->en ? Status::YES : Status::NO;
        $general->sv              = $request->sv ? Status::YES : Status::NO;
        $general->sn              = $request->sn ? Status::YES : Status::NO;
        $general->force_ssl       = $request->force_ssl ? Status::YES : Status::NO;
        $general->secure_password = $request->secure_password ? Status::ENABLE : Status::DISABLE;
        $general->registration    = $request->registration ? Status::ENABLE : Status::DISABLE;
        $general->agree           = $request->agree ?  Status::ENABLE : Status::DISABLE;
        $general->multi_language  = $request->multi_language  ? Status::YES : Status::NO;
        $general->save();
        $notify[] = ['success', 'System configuration updated successfully'];
        return back()->withNotify($notify);
    }
    
    public function cookie()
    {
        $page_title = 'GDPR Cookie';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        return view('admin.setting.cookie', compact('page_title', 'cookie'));
    }

    public function cookieSubmit(Request $request)
    {

        $request->validate([
            'short_desc'  => 'required|string|max:255',
            'description' => 'required',
        ]);
        $cookie              = Frontend::where('data_keys', 'cookie.data')->firstOrFail();
        $cookie->data_values = [
            'short_desc'  => $request->short_desc,
            'description' => $request->description,
            'status'      => $request->status ? Status::ENABLE : Status::DISABLE,
        ];
        $cookie->save();
        $notify[] = ['success', 'Cookie policy updated successfully'];
        return back()->withNotify($notify);
    }
    
    public function socialiteCredentials()
    {
        $page_title = 'Social Login Credentials';
        return view('admin.setting.social_credential', compact('page_title'));
    }

    public function updateSocialiteCredentialStatus($key)
    {
        $general = GeneralSetting::first();
        $credentials = $general->socialite_credentials;
        try {
            $credentials->$key->status = $credentials->$key->status == Status::ENABLE ? Status::DISABLE : Status::ENABLE;
        } catch (\Throwable $th) {
            abort(404);
        }

        $general->socialite_credentials = $credentials;
        $general->save();

        $notify[] = ['success', 'Status changed successfully'];
        return back()->withNotify($notify);
    }

    public function updateSocialiteCredential(Request $request, $key)
    {
        $general = GeneralSetting::first();
        $credentials = $general->socialite_credentials;
        try {
            @$credentials->$key->client_id = $request->client_id;
            @$credentials->$key->client_secret = $request->client_secret;
        } catch (\Throwable $th) {
            abort(404);
        }
        $general->socialite_credentials = $credentials;
        $general->save();

        $notify[] = ['success', ucfirst($key) . ' credential updated successfully'];
        return back()->withNotify($notify);
    }

    
    public function update(Request $request)
    {
        $validation_rule = [
            'base_color' => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],
        ];
        $validator = Validator::make($request->all(), $validation_rule, []);
        $validator->validate();
        $general_setting = GeneralSetting::first();
        $request->merge(['ev' => isset($request->ev) ? 1 : 0]);
        $request->merge(['en' => isset($request->en) ? 1 : 0]);
        $request->merge(['sv' => isset($request->sv) ? 1 : 0]);
        $request->merge(['sn' => isset($request->sn) ? 1 : 0]);
        $request->merge(['registration' => isset($request->registration) ? 1 : 0]);
        $general_setting->update($request->only(['sitename', 'cur_text', 'cur_sym', 'ev', 'en', 'sv', 'sn', 'registration', 'base_color','email_from','location','phone','working_hour']));
        $notify[] = ['success', 'General Setting has been updated.'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $page_title = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo'      => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'logo_dark' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon'   => ['image', new FileTypeValidate(['png'])],
        ]);

        $path = getFilePath('logoIcon') . "/" . activeTemplateName();

        if ($request->hasFile('logo')) {
            try {


                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }
        if ($request->hasFile('logo_dark')) {
            try {

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo_dark)->save($path . '/logo_dark.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }

    public function maintenanceMode()
    {
        $page_title   = 'Maintenance Mode';
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();
        return view('admin.setting.maintenance', compact('page_title', 'maintenance'));
    }

    public function maintenanceModeSubmit(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'heading'     => 'required',
            'image'       => 'image|mimes:jpg,jpeg,png',
        ]);

        $general                   = GeneralSetting::first();
        $general->maintenance_mode = $request->status ? Status::ENABLE : Status::DISABLE;
        $general->save();

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->firstOrFail();


        if ($request->hasFile('image')) {
            try {
                $path      = getFilePath('maintenance');
                $size      = getFileSize('maintenance');
                $imageName = fileUploader($request->image, $path, $size, @$maintenance->data_values->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $dataValues  = [
            'description' => $request->description,
            'image'       => @$imageName ?? @$maintenance->data_values->image,
            'heading'     => $request->heading,
        ];
        $maintenance->data_values = $dataValues;
        $maintenance->save();

        $notify[] = ['success', 'Maintenance mode updated successfully'];
        return back()->withNotify($notify);
    }
}
