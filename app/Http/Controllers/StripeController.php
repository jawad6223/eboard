<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Models\subscription_package;
use App\Models\subscription_transaction;
use App\Models\branch_card;
use App\Models\branch;

use  Carbon\Carbon;

use Session;
use Stripe;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
        $card =branch_card::where('branch_id',$id)->first();
   

        $package = subscription_package::all();
        return view('branch.stripe',compact('package','id','card'));
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
     
        $package = subscription_package::where('id',$request->package_id)->first();
        $package1 = $package->months;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $check =Stripe\Charge::create ([
                "amount" => $package->price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);

        $mytime =    $mytime = Carbon::today()->format('Y-m-d'); 
        $newDate = date('Y-m-d', strtotime($mytime. ' + ' .$request->recurrent_charges . ' months'));
        $branch  =branch::find($request->branch_id);
       

if ($check->status == "succeeded"){
     

        subscription_transaction::create([
'branch_id' =>$request->branch_id,
'branch_email' => $branch->email,
'transaction_id' =>$check->id,
'payment_method' =>'Stripe',
'amount' => $check->amount/100
        ]);

        if($request->has('card_save')){
             $mytime = Carbon::today()->addDays(90)->format('y-m-d');  
            $check_card =0;
            $check_card = branch_card::where('branch_id',$request->branch_id)->count();
            if($check_card == 0){
        branch_card::create([
'branch_id' =>$request->branch_id,
'card_name' =>$request->card_name,
'cvc' =>$request->cvc,
'card_number'=>$request->card_number,
'expiration_month'=>$request->expiration_month,
'expiration_year'=>$request->expiration_year,

        ]);
        
         branch::where('id',$request->branch_id)->update([
      'status' =>1,
        'subscription_expiry'=>$mytime
        
    ]);
    }
    else{
         $mytime = Carbon::today()->addDays(90)->format('y-m-d');  
        branch_card::where('branch_id',$request->branch_id)->update([
            'branch_id' =>$request->branch_id,
            'card_name' =>$request->card_name,
            'card_number'=>$request->card_number,
            'expiration_month'=>$request->expiration_month,
            'expiration_year'=>$request->expiration_year
                    ]);
                    
                        branch::where('id',$request->branch_id)->update([
      'status' =>1,
        'subscription_expiry'=>$mytime
     
    ]);
    }
    }
 
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
    else{
        Session::flash('success', 'Something Wrong');
    }
}
}