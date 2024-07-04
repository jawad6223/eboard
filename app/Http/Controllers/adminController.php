<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
use App\Models\subscription_transaction;
use App\Models\user_certificate;
use  Carbon\Carbon;
use Illuminate\Support\Facades\File; 
class adminController extends Controller
{
//  Admin Login action

  public  function adminloginaction(Request $req){
    $req->validate([
        'email' => 'required|email',
        'password'=> 'required',
      ]);
      if (Auth::attempt(['email' => $req->email, 'password' => $req->password,'role_id' => 1])) {
        if(auth::user()->role_id == 1 && auth::user()->status == 1){
             $id =  Auth::id();
              $mytime = Carbon::today()->addDays(-7)->format('y-m-d');  
           
             
        $license_count =user_certificate::where('user_id',$id)->where('expiry_date','>=', $mytime)->count();
      
        session(['key' => $license_count]);
        return redirect('admin/dashboard');
        
        
      
       
        }
        else{
          return back()->with(['error1'=> 'Password and Email does not match try again']);
        }
    }
      else{
        return back()->with(['error1'=> 'Password and Email does not match try again']);
      }
}
// Logout

    function  adminlogout(){
      auth::logout();
return redirect('/admin/login');

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

  // dashboard
  public function admin_dashboard()
  {

$total_companies = company::count();
$total_branches  = branch::where('status',1)->count();
$total_employees = branch_user::count();
$total_subscribers  =branch::orderBy('id','desc')->where('status',1)->count();




$id = auth::id();

$business = branch::with(['branch_employee','branch_reward'])->where('user_id',$id)->get();

$total_license = user_certificate::where('user_id',$id)->count();
// dd(count($business));

return view('admin.dashboard',compact('total_companies','total_subscribers','total_branches','total_employees','business','total_license'));


  }  


//business
public function add_business()
{
  $company =company::with(['company_branches'])->get();
  return view('admin.add_business',compact('company'));
}

public function addbusinessaction(Request $req)
{


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

branch::create([
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
  'subscription_expiry'=>date('y-m-d', strtotime(2070-02-20)),
  'status' =>1
    
]);
return back()->with('message','added');
}

public function edit_business_action(request $req){
 $user_id = auth::id();

 $req->validate([
  'email' => 'unique:branch,email,' .$req->id.',id',
  'branch_number' => 'unique:branch,branch_number,' .$req->id.',id'
]);

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
    'subscription_expiry'=>2070-02-17,
    'status' =>1,
    
  ]);

return back()->with('message','edit');

}

public function view_business()
{
  $companies =company::all();
  $id= auth::id();

  $business = branch::with(['branch_company','branch_employee'])->orderBy('id','desc')->where('status',1)->where('user_id',$id)->get();

  

  return view('admin.view_businesses',compact('business','companies'));
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

    return view('admin.business_detail',compact('business','all_employees','compares'));
  }

  //All companies
  public function companies()
  {
    $company = company::orderBy('id','desc')->get();

    return view('admin.companies',compact('company'));
  } 

  // Companies Detail
  public function companies_detail($id){
    

    $company = company::with(['company_branches.branch_employee','company_branches.branch_reward'])->find($id);

    
 
// dd($company);
    return view('admin.companies_detail',compact('company'));

    
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
    //My companies
    public function my_companies()
    {
      $id =auth::id();
     
      $business = branch::with(['branch_company'])->where('is_headquater',1)->where('user_id',$id)->orderBy('id','desc')->distinct()->get(['company_id']);

      return view('admin.my_companies',compact('business'));
    } 
  
  // add licnese method
  public function add_license()
  {
    $license = certificate_name::all();
    $org =certificate_organization::all();
    return view('admin.add_license',compact('license','org'));
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

    return view('admin.view_license',compact('licenses','orgs','certificate'));
  } 

  public function license_delete($id){

    $lic = user_certificate::find($id);
    $lic->delete();
    return back()->with('delete','delete');
  }
  // add subscription packages 
  public function add_pkg()
  {
    return view('admin.add_pkgs');
  } 

  public function add_pkg_action(Request $req)
  {
    
    subscription_package::create([
   'name' =>$req->name,
   'months' =>$req->month,
   'price' =>$req->price,
   'description' =>$req->description
    ]);

    return back()->with('message','Added');

  } 


  public function edit_pkg_action(Request $req)
  {
    
    subscription_package::where('id',$req->id)->update([
   'name' =>$req->name,
   'months' =>$req->month,
   'price' =>$req->price,
   'description' =>$req->description
    ]);

    return back()->with('message','Added');

  } 


  // view subscriptino packages
  public function view_pkg()
  {
    $sub =subscription_package::orderBy('id','desc')->get();
    return view('admin.view_pkgs',compact('sub'));
  }  

  public function pkg_delete($id){
   $check =branch::where('subscription_pkg_id',$id)->count();

   if($check == 0){
$pkg = subscription_package::find($id);
    $pkg->delete();
     return back()->with('delete','delete');
      }
    
      else{
        return back()->with('error','error');
      }




  }

  // active subscibers view method
  public function active_subscribers()
  {
    $business = branch::with(['branch_company','branch_employee'])->orderBy('id','desc')->where('status',1)->get();

    return view('admin.active_subscribers',compact('business'));
  } 

  //view blocked subscribers method
  public function blocked_subscribers()
  {
    $business = branch::with(['branch_company','branch_employee'])->orderBy('id','desc')->where('status',0)->get();

    return view('admin.blocked_subscribers',compact('business') );
  }  

  //add licenses organization
  public function lnc_org()
  {

    $org= certificate_organization::all();

    return view('admin.lnc_org',compact('org'));
  } 

  public function orgnameaction(request $req)
  {

    $req->validate([
      'logo' => 'mimes:jpeg,jpg,bmp,png',
   ]);

    $filename = $req->file('logo')->store('media');

    certificate_organization::create([
'name' => $req->name,
'logo' => $filename
    ]);
    return back()->with('message','Successfully');
  } 



  public function editorgnameaction(request $req)
  {

    
    $update  = certificate_organization::find($req->id);
    if ($req->has('logo')) {
      $req->validate([
      'image' => 'mimes:jpeg,jpg,bmp,png',
   ]);
       $image_path = 'storage/app/' . $update->image;

       File::delete($image_path);
       $filename = $req->file('logo')->store('media');
      }
     else {
      $filename = $update->logo;
      }
    certificate_organization::where('id',$req->id)->update([
      'name' => $req->name,
      'logo' =>$filename
    ]);
    return back()->with('message1','Successfully');
  } 

  public function org_delete($id){

    $check =user_certificate::where('certificate_organization_id',$id)->count();

    if($check == 0){
 $pkg = certificate_organization::find($id);
     $pkg->delete();
      return back()->with('delete','delete');
       }
       else{
         return back()->with('error','error');
       }
      }

  
  //add license names 
  public function licenses()
  {
    $license = certificate_name::all();
  
    return view('admin.licenses',compact('license'));
  } 
  // License name action
  public function licensesnameaction(request $req)
  {
    certificate_name::create([
'name' => $req->name,
'number' =>$req->number
    ]);
    return back()->with('message','Successfully');
  } 

  public function editlicensesnameaction(request $req)
  {
    certificate_name::where('id',$req->id)->update([
'name' => $req->name,
'number' =>$req->number
    ]);
    return back()->with('message1','Successfully');
  } 

  public function name_delete($id){

    $check =user_certificate::where('certificate_name_id',$id)->count();

    if($check == 0){
 $pkg = certificate_name::find($id);
     $pkg->delete();
      return back()->with('delete','delete');
       }

       else{
         return back()->with('error','error');
       }

  }


  //transaction details
  public function transactions()
  {
  $total_trans =   subscription_transaction::orderBy('id','desc')->get();
    return view('admin.transactions',compact('total_trans'));
  } 

  public function trans_delete($id){
    $del =subscription_transaction::find($id);
    $del->delete();
    return back()->with('delete','delete');
  }

  //profile
  public function profile()
  {
    $id = auth::id();
    $user = user::find($id);

$business = branch::with(['branch_employee','branch_reward'])->where('user_id',$id)->get();
    
    return view('admin.profile',compact('user','business'));
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
    //  dd($image_path);
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
  

  return redirect('admin/profile')->with('message1','Successfully Updated Profile');  
   }
  //update password
  public function update_password()
  {
    return view('admin.update_password');
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

  // Employees
  public function add_employees()
  {
    $id =auth::id();
    $business =branch::with('branch_company')->orderBy('id','desc')->where('user_id',$id)->get();

    return view('admin.add_employees',compact('business'));
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

 

  return redirect('admin/view_employees')->with('message1','create');

    
  }

  public function view_employees()
  {
    $id =auth::id();
    

    $business = branch::with('branch_company')->where('user_id',$id)->get();
    $employees_user= [];

    return view('admin.view_employees',compact('employees_user','business'));


  } 

  public function employee_show_action(request $req){


    $id =auth::id();
 $business = branch::with('branch_company')->where('user_id',$id)->get();
 $employees_user=  branch_user::with('employee','employee_branch.branch_company')->where('branch_id',$req->business_id)->orderBy('id','DESC')->get();

 return view('admin.view_employees',compact('employees_user','business'));


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
  
    return view('admin.employee_detail',compact('employee_user','record1'));
    

  }
  public function employee_detail($id){

    $record1 =[];
    $employee_user =  branch_user::with('employee','employee_branch.branch_company')->where('user_id',$id)->orderBy('id','DESC')->first();
   
    return view('admin.employee_detail',compact('employee_user','record1'));
  }

  public function employee_delete($id){

    $update= user::find($id);

    $image_path = 'storage/app/' . $update->image;
  

    $url ='media/profile.pnp';
    

    if($image_path != 'storage/app/media/profile.png'){
    
      File::delete($image_path);
  
    }
   

    $update->delete();

    return redirect('admin/view_employees')->with('delete','delete');

  }

  // Rewards
  public function add_rewards()
  {
    $id = auth::id();

    $business = branch::with('branch_company')->where('user_id',$id)->get();
    

    return view('admin.add_rewards',compact('business'));
  } 
  public function add_reward_action(request $req)
{
     $id=auth::id();
    
  $h1= reward::create([
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

  
    return view('admin.view_rewards',compact('reward','business'));
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
    $id=auth::id();
    $business = branch::with('branch_company')->get();

    
  $reward = reward::with(['branch_name.branch_company'])->where('user_id',$id)->where('status',0)->orderBy('id','DESC')->get();

    return view('admin.reward_history',compact('reward','business'));
  } 

  public function history_reward_delete($id){
$reward = reward::find($id);
$reward->delete();
    return back()->with('delete','delete');
  
    }

  // Sale
  

  public function add_sale()
  {


$employees = [];
    $id = auth::id();
    $business = branch::with(['branch_company'])->where('user_id',$id)->orderBY('id','desc')->get();
  

    return view('admin.add_sale',compact('business','employees'));
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
    return view('admin.add_sale',compact('employees','business','date'));
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
  return redirect('admin/add_sale')->with('message','syccessfulyy');
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
  return redirect('admin/add_sale')->with('message1','syccessfulyy');
  }
 }


public function view_sale(){
  
    $record = [];
    $record1 = [];
    $record2 = [];



    $id = auth::id();
    $business = branch::with(['branch_company','branch_employee'])->where('user_id',$id)->orderBY('id','desc')->get();
    $business1 = branch::with(['branch_employee.employee'])->where('user_id',$id)->get();

    return view('admin.view_sale',compact('business','business1','record','record1','record2'));
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
    
        return view('admin.view_sale',compact('business','business1','record1','record','record2'));

  }
}
