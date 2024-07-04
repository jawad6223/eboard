<?php

namespace App\Http\Controllers;
use  Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\user_sale;
use App\Models\company;
use App\Models\branch;
use App\Models\reward;
use App\Models\branch_user;
use App\Models\reminder;
use App\Models\my_client;

use App\Models\certificate_name;
use App\Models\certificate_organization;
use App\Models\subscription_package;
use App\Models\subscription_transaction;
use App\Models\user_certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 

class apicontroller extends Controller
{
   //Login Function
    function login(request $req){
       
       
        $rules = [
            'email'=> 'required|email',
            'password'=> 'required',
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
    
          $user = user::where('email',$req->email)->first();
       
          if($user )
          {
            if(password_verify($req->password, $user->password)){
                return response()->json(['error'=> false, 'success_msg'=> 'logged in successfully','data'=> $user]);

            }
            else{
                return response()->json(['error'=> true, 'error_msg'=> 'Ivalid Login Credentials']);

            }
          }
          else{
            return response()->json(['error'=> true, 'error_msg'=> 'Email does not exist try again']);

          }


    }
    
    // Forget
   public function forget(request $req)
 {
     
     $rules = [
            'email'=> 'required|email',
            
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
      
    
        $user = user::where('email', $req->email)->first();

        if ($user) {
            
           $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
            $user->password = bcrypt(implode($pass));
            $user->save();
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $req->email;
            $from = 'info@eboard.org';
            $subject = 'Eboard System Password Reset';
            $message = '<h2 style="color:#040d50">Eboard System<h2> <hr> <h4> Dear ' . $user->name .'</h4><p> There was a request for password  resetting eboard system generated password is <button style="color:#040d50">'. 
            implode($pass).' </button> </p>' ;
            $headers .= 'From: info@eboard.org'."\r\n".
            'Reply-To: info@eboard.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                 return response()->json(['error'=> false, 'success_msg'=> 'You have e-mailed your password']);
            }
            else{
                return back()->with('message2','Email does not exist try again!!');
            }
           
         
        }
        else{
            return back()->with('message','Email does not exist try again!!');
        }
     
 }
// Profile view Function
function profile(request $req){
    $user = user::find($req->id);
    
   return response()->json(['data'=>$user]);
}
// Edit profile

function edit_profile(request $req){

   

     $rules = [
            'email' => 'unique:users,email,' .$req->id.',id',
             'ssn' => 'unique:users,ssn,' .$req->ssn.',ssn'
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
       

     user::where('id',$req->id)->update([
      'name'=>$req->name,
      'email'=>$req->email,
      'contact'=>$req->contact,
      'image'=>$req->image,
      'street'=>$req->street,
      'city'=>$req->city,
      'state'=>$req->state,
      'zip'=>$req->zip,
      'country'=>$req->country,
      'ssn' => $req->ssn,
  ]);
       
           $user = user::where('id',$req->id)->first(); 
  return response()->json(['error'=> false, 'success_msg'=> 'Successfully Edit Profile' ,'data'=> $user]);
}

// change password
function change_password(request $req){
    $rules = [
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirmpassword' => 'same:newpassword',
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
  $user= user::find($req->id);

   if(password_verify($req->oldpassword,$user->password)){
        $user->password = bcrypt($req->newpassword);
 $user->save();
        return response()->json(['success_msg'=> 'Successfully Update Password']);
    }
    else{
         return response()->json(['error_msg'=> 'Old Password does not match try again']);
    }
}

    // Home Function
function home(request $req){


$branch = branch_user::where('user_id',$req->id)->first();

$mytime1 = Carbon::today()->addDays(-1)->format('y-m-d');  

$mytime = date('Y-m-d');

$all_employees = user_sale::with(['employee_detail'])->where('branch_id',$branch->branch_id)->orderBy('sales','desc')->where('date',$mytime)->get();
 
$previous_data = user_sale::with(['employee_detail'])->where('branch_id',$branch->branch_id )->orderBy('sales','desc')->where('date',$mytime1)->get();

$employee_of_day  =   user_sale::with(['employee_detail'])->where('branch_id',$branch->branch_id)->orderBy('date','desc')->orderBy('sales','desc')->first();

return response()->json(['data'=> $all_employees, 'data1'=>$employee_of_day,'data2' =>$previous_data]);
}

// Home chart
 function home_Chart(request $req) {
     return 1;
 }

// Reward function
function reward(request $req){
    $branch = branch_user::where('user_id',$req->id)->first();
    $active_reward = reward::where('branch_id',$branch->branch_id)->where('status',1)->orderBy('id','DESC')->get();
    $previous_reward = reward::where('branch_id',$branch->branch_id)->where('status',0)->orderBy('id','DESC')->take(30)->get();
    return response()->json(['data'=> $active_reward, 'data1'=>$previous_reward]);
}

// View license
function license(request $req){
      $licenses = certificate_name::all();
      $orgs =certificate_organization::all();
      $certificate = user_certificate::with(['certificate_names','certificate_org'])->where('user_id',$req->id)->orderBy('id','desc')->get();
      return response()->json(['data'=> $certificate,'data1'=>$licenses,'data2'=>$orgs]);
}
// edit license
public function edit_license_action(request $req)
  {
   if(isset($req->end_date)){
      $exp  = date('d-m-y', strtotime($req->end_date));
  }
  else{
    $exp = null;   
  }


  $user_id =user_certificate::where('id',$req->id)->first();
    user_certificate::where('id',$req->id)->update([
    'license_number' => $req->number,
    'certificate_name_id' =>$req->license_name,
    'certificate_organization_id' =>$req->org_name,
      'issue_date' =>date('d-m-y', strtotime($req->start_date)),
    'expiry_date' =>$exp,
    'credential_id' =>$req->credential_id,
    'url'=>$req->url,
    'user_id' =>$user_id->user_id
    ]);
  return response()->json(['error'=> false, 'success_msg'=> 'Successfully Edit License']);
  }
//   Delete license
  function license_delete(request $req){
      $certificate = user_certificate::find($req->id);
      $certificate->delete();
       return response()->json(['error'=> false, 'success_msg'=> 'Successfully Delete License']);
}

// create new license
public function create_license_action(request $req)
  {

  if(isset($req->end_date)){
      $exp  = date('y-m-d', strtotime($req->end_date));
  }
  else{
    $exp = null;   
  }
  

   $abc =  user_certificate::create([
    'license_number' => $req->number,
    'certificate_name_id' =>$req->license_name,
    'certificate_organization_id' =>$req->org_name,
    'issue_date' =>date('d-m-y', strtotime($req->start_date)),
    'expiry_date' => $exp,
    'credential_id' =>$req->credential_id,
    'url'=>$req->url,
    'user_id' =>$req->user_id
    ]);
    
  return $abc;
    
  return response()->json(['error'=> false, 'success_msg'=> 'Successfully created']);
  }
  
//   statistics fuction

public function statistics(request $req){
   $total_sale = user_sale::where('user_id',$req->id)->sum('sales');
  
   $data1 = user_sale::where('user_id',$req->id)->orderBy('sales','desc')->whereMonth('created_at', Carbon::now()->month)->get();
   
   $mytime1 = Carbon::today()->addDays(-7)->format('y-m-d');  
   $req1 =  user_sale::where('user_id',$req->id)->where('created_at' ,'>=', $mytime1)->get();
      
 
   
 return response()->json(['data'=> $total_sale,'data1'=>$data1,'graph'=>$req1]);
  
}

//   search filter
public function search_filter(request $req){
  
  $total_sale = user_sale::where('user_id',$req->id)->where('date','>=', date('Y-m-d', strtotime($req->from_date)))->where('date','<=' , date('Y-m-d', strtotime($req->to_date)))->sum('sales');
  
 $data1 = user_sale::where('user_id',$req->id)->orderBy('sales','desc')->where('date','>=', date('Y-m-d', strtotime($req->from_date)))->where('date','<=' , date('Y-m-d', strtotime($req->to_date)))->get();
   
 return response()->json(['data'=> $total_sale,'data1'=>$data1]);
  
}

// Add Reninder

public function add_reminder(request $req){
 $abc =  reminder::create([
    'user_id' => $req->user_id,
    'title' =>$req->title,
    'date' =>$req->date,
    'time' =>$req->time,
    'description' => $req->description,
    ]);
    
      return response()->json(['error'=> false, 'success_msg'=> 'Successfully created']);
    
}

// View reminder


public function view_reminder(request $req){
    
     $reminder= reminder::where('user_id',$req->user_id)->get();
       return response()->json(['Data'=> $reminder ]) ;
    
}


public function delete_reminder(request $req){
    
     $rem= reminder::find($req->id);
      $rem->delete();
       return response()->json(['error'=> false, 'success_msg'=> 'Successfully Delete']);
}



// Add Client

public function add_my_client(request $req){
    
   
 $abc =  my_client::create([
    'employee_id' => $req->employee_id,
    'name' =>$req->name,
    'email' =>$req->email,
    'contact' =>$req->contact,
     'subject' =>$req->subject,
      'address' =>$req->address
    ]);
    
      return response()->json(['error'=> false, 'success_msg'=> 'Successfully created']);
    
}

// edit Client

public function edit_my_client(request $req){

   
 $abc =  my_client::where('id',$req->id)->update([
    'name' =>$req->name,
    'email' =>$req->email,
    'contact' =>$req->contact,
    'subject' =>$req->subject,
    'address' =>$req->address
    ]);
    
    return response()->json(['error'=> false, 'success_msg'=> 'Successfully created']);
}



public function view_my_client(request $req){
  
    
     $client= my_client::where('employee_id',$req->employee_id)->get();
       return response()->json(['Data'=> $client ]) ;
    
}


public function delete_my_client(request $req){
    
     $rem= my_client::find($req->id);
      $rem->delete();
       return response()->json(['error'=> false, 'success_msg'=> 'Successfully Delete']);
}

public function weakly_sale(request $req){
    
  
    $mytime1 = Carbon::today()->addDays(-7)->format('y-m-d');  
  

      $req1 =  user_sale::where('user_id',$req->employee_id)->where('created_at' ,'>=', $mytime1)->get();
      
  return response()->json(['data'=> $req1]);  
}

public function yearly_sale(request $req){
    
  
    // $mytime1 = Carbon::today()->addDays(-7)->format('y-m-d');  
 
 $mon =  Carbon::now()->month;
 
      $req1 =  user_sale::where('user_id',$req->employee_id)->whereBetween('created_at',[Carbon::now()->subMonth(2), Carbon::now()])->groupBy('created_at')->selectRaw('sum(sales) as sum,created_at')->get();
      

  return response()->json(['data'=> $req1]);  
}






















}
