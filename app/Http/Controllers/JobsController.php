<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jobs;
use App\Models\JobTypes;
use App\Models\JobNature;
use App\Models\applyJob;
use App\Models\savedJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class JobsController extends Controller
{

public function index(Request $request)
{
   
$categories = JobTypes::where('status',1)->orderBy('name','ASC')->get();    
$job_natures = JobNature::where('status',1)->orderBy('name','ASC')->get();

$jobs = Jobs::orderBy('created_at','DESC')->paginate(9); 

////keywords/title search
if(empty($request->keyword)==false)
  {
$pattern = '%'.$request->keyword.'%';  
$jobs  = Jobs::where('title', 'like', $pattern)->get();
  }

///// location search
if(empty($request->location)==false)
  {
$pattern = '%'.$request->location.'%';  
$jobs  = Jobs::where('location', 'like', $pattern)->get();

}



// category wise search
if(empty($request->category)==false)
  {
 $jobs  = Jobs::where('category_id',$request->category)->get();
 }



// jobType wise search
if(empty($request->job_type)==false)
  {
$arr =     explode(',',$request->job_type);
$jobs  = Jobs::whereIn('job_type_id',$arr)->get();

}

// experience wise search

if(empty($request->experience)==false)
  {

$jobs  = Jobs::where('experience',$request->experience)->get();

}

// sort wise search

//if($request->sort==1)
//$jobs = Jobs::orderBy('created_at','DESC')->paginate(9);
//else if($request->sort==0)
//$jobs = Jobs::orderBy('created_at','ASC')->paginate(9);

return view('front.jobs',[
    'categories' => $categories ,
    'job_natures' => $job_natures ,
    'jobs' => $jobs


]);


}

public function detail($id)
{

  $jobs =  Jobs::where('id',$id)->first();
  return view('front.job.jobDetail',[
       'jobs' => $jobs

      ]);

}


public function applyJob(Request $request)
{

$id = $request->id;
$job = Jobs::where('id',$id)->first();


$employer_id = $job->user_id;


// you can not apply your own job
if($employer_id == Auth::user()->id)
{
  $message = 'You can not apply on your own job.';
  session()->flash('apply',$message);

  return response()->json([
     'status' => false ,
     'msg' => $message
]);

}

$already_applied  = applyJob::where([
  'user_id' => Auth::user()->id ,
  'job_id'  => $id
])->count(); 

if($already_applied > 0)
{
  $message = 'You have already applied this job';
  session()->flash('already_applied',$message);
  
   return response()->json([
    'status' => false ,
    'msg' => $message
  ]);   


}


$apply_job = new applyJob();
$apply_job->job_id = $id;
$apply_job->user_id = Auth::user()->id;
$apply_job->employer_id = $employer_id;
$apply_job->applied_date = now();
$apply_job->save();


  $message = 'You have successfully applied';
  session()->flash('applied',$message);
  
   return response()->json([
    'status' => true ,
    'msg' => "success"
  ]);   










}

    

public function myJobApplications()
{

$applied_jobs =   applyJob::where('user_id',Auth::user()->id)->get();
return view('front.job.myJobApplications',[
    'applied_jobs' => $applied_jobs
]);

}

public function removeJobs(Request $request)

{
  
  applyJob::find($request->id)->delete();
  session()->flash('deleted','Job application removed successfully.');


  return response()->json([
    'status' => true,                
]);
  
  }


public function category_wise(Request $request)
{

$id = $request->id;
$jobs = Jobs::where('category_id',$id)->get();
$categories = JobTypes::where('status',1)->orderBy('name','ASC')->get();    
$job_natures = JobNature::where('status',1)->orderBy('name','ASC')->get();

return view('front.jobs',[
  'categories' => $categories ,
  'job_natures' => $job_natures ,
  'jobs' => $jobs


]);

}  

public function savedJobs(Request $request)

{

$saved_jobs = savedJob::orderBy('created_at','desc')->get();

return view('front.job.savedJobs',[
 'collection' => $saved_jobs 
]);  
  
 }

public function saveTheJob(Request $request)

{

$job_id = $request->id;
$user_id = Auth::user()->id;

$exist  = savedJob::where([
'job_id'  => $job_id
])->count(); 

if( $exist > 0 )
{

session()->flash("exist","You already saved this job");
return response()->json(['status' => false]);
 
}

else
{

$model = new savedJob();
$model->job_id = $job_id;
$model->user_id = $user_id;
$model->save();

session()->flash("save","Your job is saved Successfully");

return response()->json([
  'status' => true,                
]);
 
}


}


 public function delSavedJob(Request $request)

{

  $id = $request->id;
$data = savedJob::find($id);
$data->delete();

session()->flash('remove','Job is removed Successfully');

return response()->json([
  'status' => true,                
]);


}


}







