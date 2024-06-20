<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Jobs;
use App\Models\JobTypes;
use App\Models\JobNature;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function registration()
    {

return view('front.account.registration');

    }

    public function process_registration(Request $request)
    {

$validator = Validator::make($request->all(),[
      'name'     => 'required',
      'email'    => 'required|email',
      'password' =>  'required|min:5|same:confirm_password',
      'confirm_password' => 'required'

]);

if($validator->passes())
{

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

    session()->flash('success','You are registered successfully');

    return response()->json([
        'status' => true ,
        'errors' => []
    ]);

   



}

else
{

return response()->json([
    'status' => false ,
    'errors' => $validator->errors()
]);

}




    }    

    public function login()
    {

return view('front.account.login');
        
    }    

    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email'    => 'required|email',
            'password' =>  'required'
      
      ]);

      if($validator->passes())
      {
    
    
 if(Auth::attempt(['email' => $request->email, 'password' => $request->password]) == true)
 {

return redirect()->route('account.profile');

}

else
     {  

return redirect()->route('account.login')
->with('error','Either email or password is incorrect')
->withInput($request->only('email'));


    }
      

}

    else
    {
        
    return redirect()->route('account.login')
     ->withErrors($validator)->withInput($request->only('email'));

    }  


        
    } 


public function profile()
{

$id =  Auth::user()->id;
$data = User::where('id',$id)->first();
$img_name = $data->image;

return view('front.account.profile',['data' => $data]);

}

public function update(Request $request)
{

$id =  Auth::user()->id;

$name = $request->name;
$email = $request->email;
$mob = $request->mobile;
$designation = $request->designation;

$validator = Validator::make($request->all(),[
    'name'    => 'required',
    'email' => 'required|email|unique:users',

]);

if($validator->passes())
{

User::where('id', $id)->update(['name' => $name]);
User::where('id', $id)->update(['email' => $email]);

session()->flash('updateMsg','Profile Updated Success');

return response()->json([
    'status' => true ,
    'errors' => []
]);


}

else
{

return response()->json([
        'status' => false ,
        'errors' => $validator->errors()
    ]);

}
    


}


public function updateProfilePic(Request $request)
{


    $validator = Validator::make($request->all(),[
        'image'    => 'required|image'
         ]);

         if($validator->passes())
{

    $id =  Auth::user()->id;
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $image_name = $id.'-'.time().'.'.$ext;
    $image->move(public_path('/profile/thumb'),$image_name);
User::where('id', $id)->update(['image' => $image_name]);

session()->flash('img_upload','Image Uploaded Success');

return response()->json([
    'status' => true ,
    'errors' => []
]);

}

else
{

return response()->json([
        'status' => false ,
        'errors' => $validator->errors()
    ]);

}

}

public function PostJob()
{

$Job_Types = JobTypes::where('status', 1)->orderBy('name', 'asc')->get();
$Job_Nature = JobNature::where('status', 1)->orderBy('name', 'asc')->get();


return view('front.job.postjob',[
      'job_types' => $Job_Types ,
      'job_natures' => $Job_Nature ,

]);

}


public function saveJob(Request $request)
{

    $validator = Validator::make($request->all(),[
        'title'    => 'required' ,
        'category' => 'required' ,
        'job_nature' => 'required' ,
        'vacancy' => 'required' ,
        'location' => 'required' ,
        'company_name' => 'required' ,
        'keywords' => 'required'

         ]);

if($validator->passes())
{

//// save data in database
$job = new Jobs();
$job->title = $request->title;
$job->category_id = $request->category;
$job->job_type_id = $request->job_nature;
$job->user_id = Auth::user()->id;
$job->vacancy = $request->vacancy;
$job->salary = $request->salary;
$job->location = $request->location;
$job->description = $request->description;
$job->benefits = $request->benefits;
$job->responsibility = $request->responsibility;
$job->qualifications = $request->qualifications;
$job->keywords = $request->keywords;
$job->company_name = $request->company_name;
$job->company_location = $request->company_location;
$job->company_website = $request->company_website;
$job->save();

session()->flash("postJob","Job Added Success");


    return response()->json([
        'status' => true ,
        'errors' => []
        ]);  

}   

else
{

return response()->json( 
[
'status' => false ,
'errors' => $validator->errors()
]

);
  


}


}


public function myJobs()
{

$id =  Auth::user()->id;
$my_jobs = Jobs::where('user_id', $id)->orderBy('created_at', 'desc')->get();


if ($my_jobs->isEmpty()) 
{

    
    return view('front.job.my-jobs',[
        'my_jobs' => $my_jobs 
       ]);    

}

else
{

$category_id = $my_jobs->first()->category_id;
$category_row = JobTypes::where('id', $category_id)->first();
$category_name = $category_row->name;

return view('front.job.my-jobs',[
    'my_jobs' => $my_jobs ,
    'category_name' => $category_name
 
 ]);

}




}

public function editJob($id)
{

$Job_Types = JobTypes::where('status', 1)->orderBy('name', 'asc')->get();
$Job_Nature = JobNature::where('status', 1)->orderBy('name', 'asc')->get();
$Jobs = Jobs::where('id', $id)->first();
 
return view('front.job.edit',[
    'job_types' => $Job_Types ,
    'job_natures' => $Job_Nature ,
    'job_id' => $id ,
    'jobs'       => $Jobs

]);


}


public function deleteJob(Request $request)
{

$job_id = $request->id;
$del_job = Jobs::find($job_id);
$del_job->delete();

session()->flash('job_deleted','Job deleted successfully');

return response()->json([
  'status' => true
]);




}

public function logout()
{

Auth::logout();
    return redirect()->route('account.login')
    ->with("msg","Thank You Visit Again");

}


}
