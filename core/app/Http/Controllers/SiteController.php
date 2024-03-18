<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Exchange;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Models\GeneralSetting;
use App\Constants\Status;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function placeholderImage($size = null)
    {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
    public function cookieAccept()
    {
        $general = GeneralSetting::first();
        Cookie::queue('gdpr_cookie', $general->site_name, 43200);

        return response()->json([
            'success' => true,
            'message' => 'Cookie accepted successfully'
        ]);
    }
    
    public function cookiePolicy()
    {
        $page_title = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        return view($this->activeTemplate . 'cookie', compact('page_title', 'cookie'));
    }

    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }
        $data['currencys'] = Currency::latest()->get();
        $data['currencys_sell'] = Currency::where('available_for_sell', 1)->latest()->get();
        $data['currencys_buy'] = Currency::where('available_for_buy', 1)->latest()->get();
        $data['pending_exchange'] = Exchange::with('payment_from_getway', 'user')->where('status', 0)->latest()->get();
        $data['accpted_exchange'] = Exchange::with('payment_from_getway', 'user')->where('status', 2)->latest()->get();
        $data['page_title'] = 'Home';
        $data['sections'] = Page::where('tempname',$this->activeTemplate)->where('slug','home')->firstOrFail();
        return view($this->activeTemplate . 'home', $data);
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $data['page_title'] = $page->name;
        $data['sections'] = $page;
        return view($this->activeTemplate . 'pages', $data);
    }

    public function policy($id, $slug){
        $policy = Frontend::findOrFail($id)->data_values;

        $page_title = "{$policy->title}";

        return view($this->activeTemplate .'policy',compact('policy','page_title'));
    }


    public function contact()
    {
        $data['page_title'] = "Contact Us";
        return view($this->activeTemplate . 'contact', $data);
    }


    public function contactSubmit(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $imgs = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'attachments' => [
                'sometimes',
                'max:4096',
                function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                    foreach ($imgs as $img) {
                        $ext = strtolower($img->getClientOriginalExtension());
                        if (($img->getSize() / 1000000) > 2) {
                            return $fail("Images MAX  2MB ALLOW!");
                        }
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf images are allowed");
                        }
                    }
                    if (count($imgs) > 5) {
                        return $fail("Maximum 5 images can be uploaded");
                    }
                },
            ],
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket->user_id = auth()->id();
        $ticket->name = $request->name;
        $ticket->email = $request->email;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();



        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $path = imagePath()['ticket']['path'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                try {
                    $attachment = new SupportAttachment();
                    $attachment->support_message_id = $message->id;
                    $attachment->image = uploadImage($image, $path);
                    $attachment->save();
                    
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your ' . $image];
                    return back()->withNotify($notify)->withInput();
                }

            }
        }
        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id)
    {
        $policy    = Frontend::where('id', $id)->firstOrFail();
        $page_title = $policy->data_values->title;
        return view($this->activeTemplate . 'policy', compact('policy', 'page_title'));
    }
    
    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blog()
    {
        $page_title = "Blogs";
        $blogs     = Frontend::where('tempname', GeneralSetting::first()->active_template)->where('data_keys', 'blog.element')->latest()->paginate(getPaginate(12));
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        return view($this->activeTemplate . 'blog', compact('blogs', 'page_title', 'sections'));
    }
    
    public function blogDetails($id,$slug){
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $blog->clicks = $blog->clicks + 1;
        $blog->save();

        $blogs = Frontend::where('data_keys', 'blog.element')->latest()->take(5)->get();

        $page_title = "Blog Details";
        return view($this->activeTemplate . 'blogDetails', compact('blog', 'page_title', 'blogs'));
    }


    public function blogSearch(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        if (!$request->has('search')) {
            $notify[] = ['error', 'Invalid Search'];
            return back()->withNotify($notify);
        }
        $page_title = 'Searched Result';
        $blogSearch = Frontend::where('data_keys', 'blog.element')->where('data_values', 'LIKE', '%' . $request->search . '%')->get();
        $empty_message = 'No Blog Post Found';
        return view(activeTemplate() . 'searchblog', compact('page_title', 'blogSearch', 'empty_message'));
    }

    public function loadMore(Request $request)
    {
        $items = $request->items + (session('items') ?? 3);
        session()->put('items', $items);
        $currencys = Currency::where('available_for_buy', 1)->take($items)->get();
        return view(activeTemplate() . 'sections.reserveItem', compact('currencys'));
    }


    public function maintenance()
    {
        $page_title = 'Maintenance Mode';
        $general = GeneralSetting::first();
        if ($general->maintenance_mode == Status::DISABLE) {
            return redirect()->route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view('partials.maintenance', compact('page_title', 'maintenance'));
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errorMsg' => $validator->getMessageBag()->toArray(), 'fails' => true]);
        }



        $email = Subscriber::where('email', $request->email)->first();

        if (!empty($email)) {

            return response()->json(['errorMsg' => 'You Have Already Subscribed', 'error' => true]);
        }

        Subscriber::create([
            'email' => $request->email
        ]);


        return response()->json(['successMsg' => 'You Subscribed successfully', 'success' => true]);
    }

    public function reserve()
    {
        $page_title = 'Reserve';
        $empty_message = 'No currency Found';
        $currencies = Currency::where('show_rate', 1)->latest()->paginate(getPaginate());

        return view($this->activeTemplate . 'sections.reserve', compact('page_title', 'currencies', 'empty_message'));
    }



}
