<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Oreder_summery;
use App\Models\Order_detail;
use App\Mail\EmailOffer;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(strpos(url()->previous(),"blogs"))
        {
            return redirect(url()->previous());
        }
        if(strpos(url()->previous(),"product/details")){
            return redirect(url()->previous());
        }
        $users=User::count();
        $admins=User::where('role',2)->count();
        $customers=User::where('role',1)->count();
        return view('home',compact('users','admins','customers'));
    }
    public function email_offer()
    {
        $customers = User::where('role',1)->get();
        return view('emailoffer',compact('customers'));
    }
    public function single_email_offer($id)
    {
        Mail::to(User::find($id)->email)->send(new EmailOffer());
        return back();
    }
    public function check_email_offer(Request $request)
    {   
        foreach($request->check as $id)
        {     
            Mail::to(User::find($id)->email)->send(new EmailOffer());
        }
        return back();
    }

    public function location()
    {
        $countries=Country::get(['id','name','status']);
        return view('backend.location.index',compact('countries'));
    }
    public function location_update(Request $request)
    {
        Country::where('status','active')->update([
            'status'=>'deactive',
        ]);
        
       foreach($request->countries as $country_id){
             Country::find($country_id)->update([
                'status'=> 'active',
            ]);
        }
        return back();
    }
    public function my_orders()
    {
        $order_summeries= Oreder_summery::where('user_id',Auth::id())->get();
        return view('myorder.index',compact('order_summeries'));
    }

    public function invoice_download()
    {
        $pdf = Pdf::loadView('pdf.invoice');
        return $pdf->download('invoice.pdf');
    }

    public function myorder_details($order_id)
    {
        $order_summery = Oreder_summery::find($order_id);
        $order_details=Order_detail::where('order_summery_id',$order_id)->get();
        $user_id=Oreder_summery::find($order_id)->user_id;  
        if($user_id == Auth::id()){
            return view('myorder.details',compact('order_summery','order_details'));
        }else{
            abort(404);
        }
    }

    public function all_orders()
    {
        $all_orders = Oreder_summery::all();
        return view('backend.orders.index',compact('all_orders'));
    }
    
    public function order_details($order_id)
    {
        $order_summery = Oreder_summery::find($order_id);
        $order_details=Order_detail::where('order_summery_id',$order_id)->get();
        return view('backend.orders.details',compact('order_summery','order_details'));
    }

    public function mark_delivered($order_id)
    {
        Oreder_summery::find($order_id)->update([
            'delivered'=>1
       ]);
       return back();
    }

    public function rating(Request $request, $id)
    {
        $request->except('_token');
        $product_id = Order_detail::find($id)->product_id;

        Rating::insert([
            'user_id'=> Auth::id(),
            'product_id'=>$product_id,
            'order_details_id'=>$id,
            'review'=>$request->review,
            'rating'=>$request->rate,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    } 

}
