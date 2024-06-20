@extends('front.layouts.app')

@section('main')

@if(is_null($jobs)==false)


<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="jobs.html"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
           <div class="col-md-8">

            @if(Session::has('apply'))
            <div class="alert alert-danger">
                 <p>{{Session::get('apply') }}</p> 
              </div>
            @endif

       

            @if(Session::has('already_applied'))
            <div class="alert alert-warning">
                 <p>{{Session::get('already_applied') }}</p> 
              </div>
            @endif

            @if(Session::has('save'))
            <div class="alert alert-success">
                 <p>{{Session::get('save') }}</p> 
              </div>
            @endif

            @if(Session::has('applied'))
            <div class="alert alert-success">
                 <p>{{Session::get('applied') }}</p> 
              </div>
            @endif

            
            @if(Session::has('exist'))
            <div class="alert alert-danger">
                <strong>Error!</strong> <p>{{Session::get('exist') }}</p> 
              </div>
            @endif

         


                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                              
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $jobs->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i>{{ $jobs->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> Part-time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>
                            <p>Variations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            <ul>
                                <li>The applicants should have experience in the following areas.</li>
                                <li>Have sound knowledge of commercial activities.</li>
                                <li>Leadership, analytical, and problem-solving abilities.</li>
                                <li>Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.</li>
                            </ul>
                        </div>
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            <ul>
                                <li>The applicants should have experience in the following areas.</li>
                                <li>Have sound knowledge of commercial activities.</li>
                                <li>Leadership, analytical, and problem-solving abilities.</li>
                                <li>Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.</li>
                            </ul>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                           
                            <a href="#" onclick="saveTheJob({{ $jobs->id }})" class="btn btn-secondary">Save</a>
                            <a href="#" onclick="get_id({{ $jobs->id }})" class="btn btn-primary">Apply</a>
                        </div>
                   
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>12 Nov, 2019</span></li>
                                <li>Vacancy: <span>2 Position</span></li>
                                <li>Salary: <span>50k - 120k/y</span></li>
                                <li>Location: <span>California, USA</span></li>
                                <li>Job Nature: <span> Full-time</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>XYZ Company</span></li>
                                <li>Locaion: <span>Noida</span></li>
                                <li>Webite: <span>www.example.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@else
{{ "job not found" }}

@endif

@endsection

@section('customJS')
<script type="text/javascript">

function get_id(id)
{


if(confirm("Do you want to apply this job ?"))
{

    $.ajax({
    type: "get",
    url: "{{ route('applyJob') }}",
    data: {'id':id},
    dataType: "json",
    success: function (response) {
        
        if(response.status == false)
   window.location.href = "{{ url()->current() }}"; 
else
window.location.href = "{{ url()->current() }}"; 


    }
});

  }

}

</script>

<script type="text/javascript">

    function saveTheJob(id)
    {
    
     if(confirm("Do you want to apply this job ?"))
    {
    
        $.ajax({
        type: "post",
        url: "{{ route('account.saveTheJob') }}",
        data: {'id':id},
        dataType: "json",
        success: function (response) {
            
            if(response.status == false)
       window.location.href = "{{ url()->current() }}"; 
    else
    window.location.href = "{{ url()->current() }}"; 
    
    
        }
    });
    
      }
    
    }
    
    </script>
@endsection