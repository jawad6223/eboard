<?php

namespace App\Http\Controllers;
use  Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\user_sale;
use App\Models\company;
use App\Models\branch;
use App\Models\reward;
use App\Models\branch_user;
use App\Models\certificate_name;
use App\Models\certificate_organization;
use App\Models\subscription_package;
use App\Models\user_certificate;
use Illuminate\Support\Facades\File; 
class branchController extends Controller
{
  public function branch_login_action(request $req){
    
    $req->validate([
      'email' => 'required|email',
      'password'=> 'required',
    ]);
    if (Auth::attempt(['email' => $req->email, 'password' => $req->password,'role_id' => 2])) {
      if(auth::user()->role_id== 2 && auth::user()->status == 1){
              $id =  Auth::id();
      
              $mytime = Carbon::today()->addDays(-7)->format('y-m-d');  
           
             
        $license_count =user_certificate::where('user_id',$id)->where('expiry_date','>=', $mytime)->count();

        $branch_expiry = branch::where('user_id',$id)->where('subscription_expiry','>=', $mytime)->count();
        
       

        session(['key' => $license_count]);
         session(['key1' => $branch_expiry]);
        
      return redirect('branch/dashboard');
      }
      else{
        return back()->with(['error1'=> 'Password and Email does not match try again']);
      }
  }
    else{
      return back()->with(['error1'=> 'Password and Email does not match try again']);
    }
  
  }
  public function branch_dashboard()
  {
      $id = auth::id();
$total_companies = branch::where('is_headquater',1)->where('user_id',$id)->count();

$business = branch::with(['branch_employee','branch_reward'])->where('user_id',$id)->get();

$total_license = user_certificate::where('user_id',$id)->count();
// dd(count($business));

return view('branch.dashboard',compact('total_companies','business','total_license'));

  }  
  
//   Signup
  public function signup()
  {
  
    return view('branch.signup');
  }
  
  public function signupaction(request $req)
  {
  
     $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:16|min:6',
            'confirm_password' => 'required|max:16|min:6',
    ]);
    
     $randomNumber = random_int(100000, 999999);
       
    $user11 = User::create([
       'name'=>$req->name,
       'email'=>$req->email,
       'password'=>bcrypt($req->password),
       'role_id'=> 2,
       'verification' => $randomNumber
    ]);
    
    if($user11){
           
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $req->email;
            $from = 'info@eboard.org';
            $subject = 'SignUp (OTP) Confirmation';
            $message = '<h2 style="color:#040d50">Eboard System<h2> <hr> <h4> Dear ' . $req->name .'</h4><p> Thanks you for chossing eboard system use the following OTP to complete your SignUp procedures.</p>  <button style="color:#040d50">'. 
$randomNumber.' </button>';
            $headers .= 'From: info@eboard.org'."\r\n".
            'Reply-To: info@eboard.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
       
            if(mail($to, $subject, $message, $headers))
            {
                return redirect('branch/verification/'.$user11->id);
            }
      
  }
  }
//   verification
public function verification($id){
    return view('branch.verification',compact('id'));
}

public function verification_action(request $req){
   
   $user_check=  user::find($req->user_id);
   
   if($user_check->verification == $req->otp ){
       
    user::where('id',$req->user_id)->update([
      'status'=>1,
      'verification'=>null,
  ]);
       return redirect('branch/login');
   }
   else{
        return back()->with('error','incorrect otp try again!!');
   }
   
}

public function again_verification_action($id){
    
    $user = user::find($id);
       $randomNumber = random_int(100000, 999999);
       
    $user11 = user::where('id',$id)->update([
      
      'verification'=> $randomNumber,
  ]);
    
    if($user11){
           
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $user->email;
            $from = 'info@eboard.org';
            $subject = 'SignUp (OTP) Confirmation';
            $message = '<h2 style="color:#040d50">Eboard System<h2> <hr> <h4> Dear ' . $user->name .'</h4><p> Thanks you for chossing eboard system use the following OTP to complete your SignUp procedures.</p>  <button style="color:#040d50">'. 
$randomNumber.' </button>';
            $headers .= 'From: info@eboard.org'."\r\n".
            'Reply-To: info@eboard.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
       
            if(mail($to, $subject, $message, $headers))
            {
                return redirect('branch/verification/'.$user->id);
            }
      
  }

    return view('branch.verification',compact('id'));
}

// Forget
   public function forget(request $req)
 {
     
     
        $req->validate([
            'email' => 'required|email',

        ]);
    
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
                return back()->with('message1','djj');
            }
            else{
                return back()->with('message2','djj');
            }
           
         
        }
        else{
            return back()->with('message','djj');
        }
        
 } 
  //profile
  public function profile()
 {
    $id = auth::id();
    $user = user::find($id);
    
$card =branch::with(['branch_trans','branch_company'])->where('user_id',$id)->where('status',1)->get();

  $business = branch::with(['branch_employee','branch_reward','branch_trans'])->where('user_id',$id)->get();
  // return $business;
  
    
    return view('branch.profile',compact('user','business','card'));
  } 

  // Profile edit action
   public function profileeditaction(request $req)
   {
   
    $req->validate([
      'email' => 'unique:users,email,' .$req->id.',id',
      'ssn' => 'unique:users,ssn,' .$req->id.',id'
   ]);

    $id =Auth::id();
    $update  = user::find($id);
  
    // Image 

    if ($req->has('image')) {
    $req->validate([
    'image' => 'mimes:jpeg,jpg,bmp,png',
 ]);
     $image_path = 'storage/app/' . $update->image;
     File::delete($image_path);
     $filename = $req->file('image')->store('media');
    }
   else {
    $filename = $update->image;
    }
     user::where('id',$id)->update([
      'name'=>$req->name,
      'email'=>$req->email,
      'contact'=>$req->contact,
      'image'=>$filename,
      'street'=>$req->street,
      'city'=>$req->city,
      'state'=>$req->state,
      'zip'=>$req->zip,
      'country'=>$req->country,
      'ssn' => $req->ssn,
  ]);
  return redirect('branch/profile')->with('message1','Successfully Updated Profile');  
   }
  

  //My companies
      
      public function my_companies()
      {
        $id =auth::id();
       
        $business = branch::with(['branch_company'])->where('is_headquater',1)->where('user_id',$id)->orderBy('id','desc')->distinct()->get(['company_id']);
  
        return view('branch.my_companies',compact('business'));
      } 
    
   // Companies Detail
   public function companies_detail($id){
    

    $company = company::with(['company_branches.branch_employee','company_branches.branch_reward'])->find($id);
// dd($company);
    return view('branch.companies_detail',compact('company'));

    
  }


  public function edit_company_action(request $req){
 
    $update = company::find($req->id);
  
  
    if ($req->has('company_logo')) {
   
      $req->validate([
      'company_logo' => 'mimes:jpeg,jpg,bmp,png',
   ]);
       $image_path = 'storage/app/' . $update->logo;
       File::delete($image_path);
       $filename = $req->file('company_logo')->store('media');
      }
     else {
      $filename = $update->logo;
      }
  
  
      company::where('id',$req->id)->update([
      'name'=>$req->company_name,
      'email'=>$req->company_email,
      'contact'=>$req->company_contact,
      'logo'=>$filename,
      'street'=>$req->company_street,
      'city'=>$req->company_city,
      'state'=>$req->company_state,
      'zip'=>$req->company_zip,
      'country'=>$req->company_country,
      'ein' => $req->company_ein,
      'company_creation_date' => $req->company_date,
      'website' => $req->company_website,
    ]);
  
    return back()->with('message2','added');
  
   
  }

  public function company_delete($id){
    
  $check = branch::where('company_id',$id)->count();

  if($check == 0){

$company = company::find($id);

$destinationPath = 'storage/app/'.$company->logo;
 
 file::delete($destinationPath);


$company->delete();
 return back()->with('delete','delete');
  }

  else{
    return back()->with('error','error');
  }

  }

  
  // Business

  public function add_business()
  {
    $package= subscription_package::all();
    $company =company::with(['company_branches'])->get();
    return view('branch.add_business',compact('company','package'));
 
  }
  public function addbusinessaction(Request $req)
  {
    // return $req;

    $req->validate([
      'email' => 'unique:branch',
     'branch_number' => 'unique:branch',

   ]);
  
    $company_id =null;
  
    if ($req->filled('company_name1')) {
     
      $req->validate([
      'company_name1' => 'required',
   ]);
  
   $company_id  =  $req->company_name1;
  }
  else{
    $req->validate([
      'company_name' => 'required',
      'company_logo' =>'required|mimes:jpeg,jpg,bmp,png'
   ]);
  
   $filename = $req->file('company_logo')->store('media');
   
  
    $id =company::create([
    'name'=>$req->company_name,
    'email'=>$req->company_email,
    'contact'=>$req->company_contact,
    'logo'=>$filename,
    'street'=>$req->company_street,
    'city'=>$req->company_city,
    'state'=>$req->company_state,
    'zip'=>$req->company_zip,
    'country'=>$req->company_country,
    'ein' => $req->company_ein,
    'company_creation_date' => $req->company_date,
    'website' => $req->company_website,
  ]);
  
  $company_id =$id->id;
  }
  
  if ($req->has('is_headquater')) {
  
    $count = branch::where('is_headquater',1)->where('company_id',$company_id)->count();
  if($count != 1){
    $head =1;
    }
   else{
    return back()->with('message3','error');
   }
  }
    else{
      $head=0;
    }
  
  $user_id = auth::id();
  if ($req->has('free_trail')) {
    $mytime = Carbon::today()->addDays(7)->format('y-m-d');  
    }
    else{
  
  $mytime = Carbon::today()->addDays(90)->format('y-m-d');  
        
    }

 


 $branch_id =  branch::create([
    'user_id'=>$user_id,
    'company_id'=>$company_id,
    'branch_number'=>$req->branch_number,
    'email'=>$req->email,
    'contact'=>$req->branch_contact,
    'street'=>$req->branch_street,
    'city'=>$req->branch_city,
    'state'=>$req->branch_state,
    'zip'=>$req->branch_zip,
    'country'=>$req->branch_country,
    'is_headquater' => $head,
    'subscription_expiry'=>$mytime,
    'status' =>0
      
  ]);
  $id8 = $branch_id->id;

  
  if ($req->has('package_check')) {
  
    return redirect('branch/stripe/'.$id8);
  }
   else{
    return back()->with('message','error');
   }
  

  
  }
  
  public function edit_business_action(request $req){

    $req->validate([
      'email' => 'unique:branch,email,' .$req->id.',id',
      'branch_number' => 'unique:branch,branch_number,' .$req->id.',id'
   ]);
   $user_id = auth::id();
  
    branch::where('id',$req->id)->update([
      'user_id'=>$user_id,
      'company_id'=>$req->company_name1,
      'branch_number'=>$req->branch_number,
      'email'=>$req->email,
      'contact'=>$req->branch_contact,
      'street'=>$req->branch_street,
      'city'=>$req->branch_city,
      'state'=>$req->branch_state,
      'zip'=>$req->branch_zip,
      'country'=>$req->branch_country,
      'status' =>1,
      
    ]);
  
  return back()->with('message','edit');
  
  }
  
  public function view_business()
  {
    $companies =company::all();
    $id= auth::id();
    
  
    $business = branch::with(['branch_company','branch_employee'])->orderBy('id','desc')->where('user_id',$id)->get();
  

    return view('branch.view_business',compact('business','companies'));
  }
  
  public function business_delete($id){
  
  
    $check = branch_user::where('branch_id',$id)->count();
  
    if($check == 0){
  
  $branch = branch::find($id);
  
  $branch->delete();
   return back()->with('delete','delete');
    }
  
    else{
      return back()->with('error','error');
    }
  
  }
    //business_details
    public function business_detail($id)
    {
      $business = branch::with(['branch_company','branch_employee','branch_reward'])->find($id);
      //  dd($business->branch_employee->count());
  
$mytime1 = Carbon::today()->addDays(-1)->format('y-m-d');  
$mytime = date('Y-m-d');
$all_employees = user_sale::with(['employee_detail'])->where('branch_id',$id)->orderBy('sales','desc')->where('date',$mytime)->get();
$compares = user_sale::with(['employee_detail'])->where('branch_id',$id)->orderBy('sales','desc')->where('date',$mytime1)->get();

        // dd($all_employees);
  
      return view('branch.business_detail',compact('business','all_employees','compares'));
    }

  // Employee
  
 // Employees
 public function add_employees()
 {
   $id =auth::id();
   $business =branch::with('branch_company')->orderBy('id','desc')->where('status',1)->where('user_id',$id)->get();

   return view('branch.add_employees',compact('business'));
 } 

 public function add_employee_action(Request $req)
 {
  $req->validate([
      'email' => 'unique:users',
      'ssn' => 'unique:users',
   ]);

    $image_path = 'media/profile.png';
    // Password Create
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
 

       
     $id =  user::create([  
      'name'=>$req->name,
      'password'=>bcrypt(implode($pass)),
      'email'=>$req->email,
      'contact'=>$req->contact,
      'image'=>$image_path,
      'street'=>$req->street,
      'city'=>$req->city,
      'state'=>$req->state,
      'zip'=>$req->zip,
      'country'=>$req->country,
      'ssn' => $req->ssn,
      'role_id' =>3,
      'status' =>1
    ]);

    branch_user::create([

    'user_id' =>$id->id,
    'branch_id' =>$req->branch_id
    ]);
    $check = user::find($id->id);
    if($check){

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $req->email;
            $from = 'info@eboard.org';
            $subject = 'Eboard System Login Credientials';
            $headers .= 'From: info@eboard.org'."\r\n".
            'Reply-To: info@eboard.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
              $htmlContent = '
              
<!doctype html>
<html lang="en-US">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Bootstrap 4 Admin HTML Theme - New Account Email Template</title>
<meta name="description" content="New account email template. Bootstrap 4 Admin HTML Theme is a material design and bootstrap 4 based responsive dashboard template by propeller created mainly for admin and backend applications.">
<style type="text/css">
a:hover { text-decoration: underline !important; }
</style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f8f9;" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f8f9" style="@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500); font-family: sans-serif , Arial, Helvetica, sans-serif;">
  <tr>
    <td>
    	<table style="background-color: #f2f8f9; max-width:670px; margin:0 auto;" width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  			<tr>
    			<td style="height:80px;">&nbsp;</td>
         	</tr>
          <tr>
      			<td style="text-align:center;">
              <a href="#" title="Bootstrap 4 Admin Theme by Propeller"><img width="30%;" src="http://eboard.qubitars.com/public/assets/images/logo/logo.png"  ></a>
            </td>
      	  </tr>
          <tr>
    			  <td style="height:20px;">&nbsp;</td>
         	</tr>
          <tr>
          	<td>
              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12);-moz-box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12);box-shadow:0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 3px 0 rgba(0, 0, 0, 0.12)">
                  <tr>
                      <td style="height:40px;">&nbsp;</td>
                  </tr>
                  <tr>
                      <td style="padding:0 15px;">
                          <h1 style="color:#3075BA; font-weight:400; margin:0;font-size:32px;">Get started</h1>
                          <p style="font-size:15px; color:#171f23de; margin:8px 0 0; line-height:24px;">Your account has been created on the Eborad System <br>Below are your system generated credentials, <br><strong>please change the password immediately after login</strong>.</p>
                          <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                          <p style="color:rgba(23,31,35,.87); font-size:18px;line-height:20px; margin:0; font-weight: 500;">
                          	<strong style="display: block;font-size: 13px; margin: 0 0 4px; color:rgba(23,31,35,.64); font-weight:normal;">Email</strong>'.$req->email .'
                              <strong style="display: block; font-size: 13px; margin: 24px 0 4px 0; font-weight:normal; color:rgba(23,31,35,.64);">Password</strong>'.implode($pass).'                                  
                          </p>
                          
                          <a href="login.html" style="background:#3075BA;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 12px;display:inline-block;border-radius:3px;">Login to your Account</a>
                      </td>
                  </tr>
                  <tr>
                      <td style="height:40px;">&nbsp;</td>
                  </tr>
              </table>
            </td>
          </tr>
          <tr>
    			  <td style="height:20px;">&nbsp;</td>
         	</tr>
         
          <tr>
    			  <td style="height:80px;">&nbsp;</td>
         	</tr>
     	</table>
    </td>
  </tr>
</table><!--/100% body table-->
</body>
</html>';
            
            
            if(mail($to, $subject, $htmlContent, $headers))
            { 
                return back()->with('message','create');
            }
    }

 } 

 public function edit_employee_action(request $req){

   $req->validate([
     'email' => 'unique:users,email,' .$req->id.',id',
     'ssn' => 'unique:users,ssn,' .$req->ssn.',ssn'
  ]);

  $update  = user::find($req->id);
  // Image 

  if ($req->has('image')) {
    
  $req->validate([
   'image' => 'mimes:jpg,png,jpeg,gif'
]);

   $image_path = 'storage/app/' . $update->image;
   $url ='media/profile.pnp';


   if(strcmp($update->image,$url)){
   }
   else{
   File::delete($image_path);
   }

   $filename = $req->file('image')->store('media');
  }

 else {
  $filename = $update->image;
  }

  
    
  $id =  user::where('id',$req->id)->update([  
   'name'=>$req->name,
   'email'=>$req->email,
   'contact'=>$req->contact,
   'image' =>$filename,
   'street'=>$req->street,
   'city'=>$req->city,
   'state'=>$req->state,
   'zip'=>$req->zip,
   'country'=>$req->country,
   'ssn' => $req->ssn,
   'role_id' =>3
 ]);



 return redirect('branch/view_employee')->with('message1','create');

   
 }

 public function view_employees()
 {
   $id =auth::id();
   

   $business = branch::with('branch_company')->where('user_id',$id)->get();
   $employees_user= [];

   return view('branch.view_employees',compact('employees_user','business'));


 } 

 public function employee_show_action(request $req){

   $id =auth::id();
$business = branch::with('branch_company')->where('user_id',$id)->get();
$employees_user=  branch_user::with('employee','employee_branch.branch_company')->where('branch_id',$req->business_id)->orderBy('id','DESC')->get();

return view('branch.view_employees',compact('employees_user','business'));


 }
 public function employee_detail_Sale_action(request $req){
   
   $query = user_sale::query();
 
   $query->with(['employee_detail'])->where('user_id',$req->user_id)->orderBy('date','desc');
 
   
  
 
   if($req->from_date){
       $query->where('date','>=', $req->from_date);            
   }
   
   if($req->to_date){
   $query->where('date','<=' , $req->to_date);

   }
  
   $record1 = $query->get(); 
 
   $employee_user =  branch_user::with('employee','employee_branch.branch_company')->where('user_id',$req->user_id)->orderBy('id','DESC')->first();
 
   return view('branch.employee_detail',compact('employee_user','record1'));
   

 }
 public function employee_detail($id){

   $record1 =[];
   $employee_user =  branch_user::with('employee','employee_branch.branch_company')->where('user_id',$id)->orderBy('id','DESC')->first();
  
   return view('branch.employee_detail',compact('employee_user','record1'));
 }

 public function employee_delete($id){

   $update= user::find($id);

   $image_path = 'storage/app/' . $update->image;
 

   $url ='media/profile.pnp';
   

   if($image_path != 'storage/app/media/profile.png'){
   
     File::delete($image_path);
 
   }
  

   $update->delete();

   return redirect('branch/view_employee')->with('delete','delete');

 }

// Rewards
public function add_rewards()
{
  $id = auth::id();

  $business = branch::with('branch_company')->where('user_id',$id)->where('status',1)->get();
  

  return view('branch.add_rewards',compact('business'));
} 
public function add_reward_action(request $req)
{
    $id=auth::id();
 reward::create([
 'user_id' =>$id,
 'branch_id' =>$req->business_id,
 'rewards_name' =>$req->title,
 'rewards_price' =>$req->price,
 'reward_target' =>$req->target,
 'description' =>$req->description,
 'target_start_date' =>$req->start_date,
 'target_end_date' =>$req->end_date

 ]);

  return back()->with('message','added');
}

public function view_rewards(){
     $id=auth::id();

  $business = branch::with('branch_company')->get();
  

  $reward = reward::with(['branch_name.branch_company'])->where('user_id',$id)->where('status',1)->orderBy('id','DESC')->get();

  
  return view('branch.view_rewards',compact('reward','business'));
} 

public function edit_reward_action(Request $req){

  reward::where('id',$req->id)->update([

    'branch_id' =>$req->business_id,  
    'rewards_name' =>$req->title,
    'rewards_price' =>$req->price,
    'reward_target' =>$req->target,
    'description' =>$req->description,
    'target_start_date' =>$req->start_date,
    'target_end_date' =>$req->end_date
 
 
    ]);
 
     return back()->with('message','added');


}

public function active_reward_delete($id){

reward::where('id',$id)->update([
  'status' =>0
]);
return back()->with('delete','delete');

}

public function reward_history()
{
  $business = branch::with('branch_company')->get();
  
     $id=auth::id();
  $reward = reward::with(['branch_name.branch_company'])->where('user_id',$id)->where('status',0)->orderBy('id','DESC')->get();
 
  return view('branch.reward_history',compact('reward','business'));
} 

public function history_reward_delete($id){
$reward = reward::find($id);
$reward->delete();
  return back()->with('delete','delete');

  }

  
  // License
  public function add_license()
  { 
    
    $license = certificate_name::all();
    $org =certificate_organization::all();
    return view('branch.add_license',compact('license','org'));
   
  }
  public function add_license_action(Request $req)
  {
    
    $user_id =auth::id();
  
    user_certificate::create([
    'license_number' => $req->number,
    'certificate_name_id' =>$req->license_name,
    'certificate_organization_id' =>$req->org_name,
    'issue_date' =>$req->start_date,
    'expiry_date' =>$req->end_date,
    'credential_id' =>$req->credential_id,
    'url'=>$req->url,
    'user_id' =>$user_id
    ]);

    return back()->with('message','submit');
  }

  public function edit_license_action(Request $req)
  {
    
    $user_id =auth::id();
  

    user_certificate::where('id',$req->id)->update([
    'license_number' => $req->number,
    'certificate_name_id' =>$req->license_name,
    'certificate_organization_id' =>$req->org_name,
    'issue_date' =>$req->start_date,
    'expiry_date' =>$req->end_date,
    'credential_id' =>$req->credential_id,
    'url'=>$req->url,
    'user_id' =>$user_id
    ]);

    return back()->with('message','submit');
  }
  // view license
  public function view_license()
  {

    $licenses = certificate_name::all();
    $orgs =certificate_organization::all();
    $id = auth::id();

    $certificate = user_certificate::with(['certificate_names','certificate_org'])->where('user_id',$id)->orderBy('id','desc')->get();

    return view('branch.view_license',compact('licenses','orgs','certificate'));
  } 

  public function license_delete($id){

    $lic = user_certificate::find($id);
    $lic->delete();
    return back()->with('delete','delete');
  }
  
  public function transactions()
  {
    return view('branch.transactions');
  }
  
  // Logout
  public function logout()
  {
    return view('branch.logout');
  }
  
// Sale
  

public function add_sale()
{


$employees = [];
  $id = auth::id();
  $business = branch::with(['branch_company'])->where('user_id',$id)->orderBY('id','desc')->where('status',1)->get();


  return view('branch.add_sale',compact('business','employees'));
} 


public function add_sale_action(Request $req)
{


  $date = $req->date;
 $id = auth::id();
  $business = branch::with(['branch_company'])->where('user_id',$id)->get();
  $check =  user_sale::where('date',$req->date)->where('branch_id',$req->business_id)->count();
 
if($check ==  0){

$employees= branch_user::with(['employee.allsale'])->where('branch_id',$req->business_id)->get();

}

else{

$employees= user_sale::with(['employee'])->where('branch_id',$req->business_id)->where('date',$req->date)->get();

}


// return $employees;
  return view('branch.add_sale',compact('employees','business','date'));
} 

public function add_employee_sale_action(Request $req){



$input =$req->all();
$user_id =$req->user_id;

$check =  user_sale::where('date',$req->date)->where('branch_id',$req->branch_id)->count();

if($check ==  0){
  for($i=0; $i < count($user_id); $i++) {

    $data = [ 
      'branch_id' => $req->branch_id[$i],
      'user_id' => $req->user_id[$i],
      'sales' => $req->sale[$i], 
      'date'  =>$req->date[$i]
    ];
    user_sale::create($data);
  }
return redirect('branch/add_sale')->with('message','syccessfulyy');
}
else{ 
  for($i=0; $i < count($user_id); $i++) {
    // return $user_id;
    user_sale::where('user_id',$req->user_id[$i])->where('date',$req->date)->update([ 
      'branch_id' => $req->branch_id[$i],
      'user_id' => $req->user_id[$i],
      'sales' => $req->sale[$i], 
      'date'  =>$req->date[$i]
    ]);
  }
return redirect('branch/add_sale')->with('message1','syccessfulyy');
}
}


public function view_sale(){

  $record = [];
  $record1 = [];
  $record2 = [];



  $id = auth::id();
  $business = branch::with(['branch_company','branch_employee'])->where('user_id',$id)->where('status',1)->orderBY('id','desc')->get();
  $business1 = branch::with(['branch_employee.employee'])->where('user_id',$id)->get();

  return view('branch.view_sale',compact('business','business1','record','record1','record2'));
} 

public function view_sale_action(request $req){
  

  if ($req->filled('business_id')) {

   
$record=user_sale::with(['employee_detail'])->where('branch_id',$req->business_id)->where('date','>=', $req->start_date)->where('date','<=' , $req->end_date)->groupBy('user_id')->selectRaw('sum(sales) as sum, user_id')->get();

$record2=user_sale::where('branch_id',$req->business_id)->where('date','>=', $req->start_date)->where('date','<=' , $req->end_date)->groupBy('date')->selectRaw('sum(sales) as sum, date')->get();

//  return $record2;
$record1 =[];

    }

    elseif ($req->has('employee_id')) {
  
  
      $query = user_sale::query();

      $query->with(['employee_detail'])->where('user_id',$req->employee_id)->orderBy('date','desc');
    
      
     
    
      if($req->from_date){
          $query->where('date','>=', $req->from_date);          
           
      }
      
      if($req->to_date){
      $query->where('date','<=' , $req->to_date);
   
      }
      $record =[];
      $record1 = $query->get(); 
      $record2=user_sale::where('branch_id',$req->business_id)->get();

      }

    
      $id = auth::id();
      $business = branch::with(['branch_company','branch_employee'])->where('user_id',$id)->orderBY('id','desc')->get();
      $business1 = branch::with(['branch_employee.employee'])->where('user_id',$id)->get();
  
      return view('branch.view_sale',compact('business','business1','record1','record','record2'));

}

  //update password
  public function update_password()
  {
    return view('branch.update_password');
  }


  function update_password_action(request $req){

    $id =Auth::id();
    $user= user::find($id);
   if(password_verify($req->oldpassword,$user->password)){
   $user->password = bcrypt($req->newpassword);
   $user->save();
   return back()->with('message','Update');
    }
    else{
    return back()->with(['error'=> 'Old Password  does not match try again']);
      }

  }
// Logout

function  branchlogout(){
  auth::logout();
return redirect('/branch/login');

}


// Home

function home_contact_action(Request $req){
return $req;
}

}


