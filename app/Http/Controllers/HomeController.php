<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobTypes;
use App\Models\Jobs;

class HomeController extends Controller
{
    public function index()
    {

        $categories = JobTypes::where('status',1)->orderBy('name','ASC')
        ->take(8)->get();

        $jobs = Jobs::where('isFeatured',1)->orderBy('created_at','DESC')
        ->take(8)->get();

        $latest_jobs = Jobs::orderBy('created_at','DESC')
        ->take(6)->get();

        
     

        return view('front.home',[
            'categories' => $categories ,
            'jobs' => $jobs ,
            'latest_jobs' => $latest_jobs
        ]);

    }


    

}
