@extends('front.layouts.app')

@section('main')



<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
               
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
                        <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
            </div>
        </div>
       
        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
        <form  action="" name="searchForm" id="searchForm">       
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Keywords</h2>
                        <input type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Location</h2>
                        <input type="text" name="location" id="location" placeholder="Location" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                          
                        @if($categories->isNotEmpty())  
                          @foreach($categories as $category)
                    <option value=" {{ $category->id }} " {{ (Request::get('category') == $category->id) ? 'selected' : '' }}>{{ $category->name  }}</option>
                          @endforeach
                              @endif
                        
                            </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>

                        @if($job_natures->isNotEmpty())
                         @foreach($job_natures as $job_nature)
           <div class="form-check mb-2"> 
               <input class="form-check-input " name="job_type" type="checkbox" value="{{ $job_nature->id }}">    
                <label class="form-check-label " for="">{{ $job_nature->name }}</label>
                     </div>
                @endforeach
                @endif
                    </div>

  


                    <div class="mb-4">
                        <h2>Experience</h2>
                        <select name="experience" id="experience" class="form-control">
                            <option value="">Select Experience</option>
                            <option value="1">1 Year</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                            <option value="4">4 Years</option>
                            <option value="5">5 Years</option>
                            <option value="6">6 Years</option>
                            <option value="7">7 Years</option>
                            <option value="8">8 Years</option>
                            <option value="9">9 Years</option>
                            <option value="10">10 Years</option>
                            
                        </select>
                    </div>
            <button type="submit" class="btn btn-primary">Search</button><br> 
            <button href="{{ route('jobDetail') }}" type="submit" class="btn btn-danger">Reset</button>                           
                </div>
            </form> 

            </div>
        
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                        
               

                    @if($jobs->isNotEmpty())  
                      @foreach($jobs as $job)  
                       
                      <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                    <p>We are in need of a Web Developer for our company.</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{ $job->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{ $job->category->name }}</span>
                                        </p>
                                     
                                        @if(is_null($job->salary)==false)
                                      <p class="mb-0">
                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                        <span class="ps-1">{{ $job->salary }}</span>
                                    </p>
                                       @endif
                                       <p class="mb-0">
                                        <span class="fw-bolder">Experience:-</span>
                                        <span class="ps-1">{{ $job->experience }} Years</span>
                                    </p>
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{ route('jobDetail',$job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        @endforeach    
                        @endif
                        
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection

@section('customJS')
<script>

$("#searchForm").submit(function (e) { 
    e.preventDefault();

    var url = '{{ route("account.jobs") }}?';

    var keyword = $("#keyword").val();
    var location = $("#location").val();
    var category = $("#category").val();
    var experience = $("#experience").val();
    var sort = $("#sort").val();

    if (keyword != " ")
    url =  url +'&keyword='+keyword;
    
    if (location != " ")
    url =  url +'&location='+location;

    if (category != " ")
    url =  url +'&category='+category;

    if (experience != " ")
    url =  url +'&experience='+experience;

    if (experience != " ")
    url =  url +'&experience='+experience;

if(sort == 1)
{
url =  url +'&sort='+sort;

}
else if(sort==0)
{
    url =  url +'&sort='+sort;

}
window.location.href=url;




 



});

$("#sort").change(function (e) { 
 
$("#searchForm").submit();
    
   
});

</script>

@endsection