@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post a Job</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
           
            @include('front.layouts.sidebar')

            <div class="col-lg-9">
                @if(Session::has('postJob'))
                <div class="alert alert-success">
                    <strong>Success!</strong> <p>{{Session::get('postJob') }}</p> 
                  </div>
                @endif 
            <form  id="postForm" name="postForm">    
                @csrf 
                <div class="card border-0 shadow mb-4 ">
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <div class="row">
                          
                            <div class="col-md-6 mb-4">
                               
                                <label for="" class="mb-2">Title<span class="req">*</span></label>
                                <input  class="form-control" type="text" id="title"  name="title" value={{ $jobs->title }} >
                            
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Category<span class="req">*</span></label>
                                <select name="category" id="category" class="form-control">
                                  
                        @foreach ($job_types as $job_type)
                        @if($jobs->category_id == $job_type->id)
                    <option value={{ $job_type->id }} selected>{{ $job_type->name }}</option> 
                    @else     
                    <option value={{ $job_type->id }}>{{ $job_type->name }}</option> 
                    @endif
                    @endforeach 

                               
                                </select>
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                <select name="job_nature" id="job_nature" class="form-control">
                                 
                                    @foreach ($job_natures as $job_nature)
                                    @if($jobs->job_type_id == $job_nature->id)
                                    <option value={{ $job_type->id }} selected>{{ $job_nature->name }}</option> 
                                  @else     
                                  <option value={{ $job_nature->id }}>{{ $job_nature->name }}</option> 
                                 @endif
                                    @endforeach 
                                      
                                         
                                
                                </select>
                                <p></p>
                            </div>
                            <div class="col-md-6  mb-4">
                                <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                <input type="number" min="1" value={{ $jobs->vacancy }} id="vacancy" name="vacancy" class="form-control">
                                <p></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Salary</label>
                                <input type="text" value={{ $jobs->salary }} id="salary" name="salary" class="form-control">
                                <p></p>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location<span class="req">*</span></label>
                                <input type="text" value={{ $jobs->location }} id="location" name="location" class="form-control">
                                <p></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Description<span class="req"></span></label>
                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" > {{ $jobs->description }}</textarea>
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Benefits</label>
                            <textarea class="form-control" value="{{ $jobs->benefits }}" name="benefits" id="benefits" cols="5" rows="5">{{ $jobs->benefits }}</textarea>
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Responsibility</label>
                            <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $jobs->responsibility }}</textarea>
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Qualifications</label>
                            <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $jobs->qualifications }}</textarea>
                            <p></p>
                        </div>
                        
                        

                        <div class="mb-4">
                            <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                            <input type="text" value="{{ $jobs->keywords }}" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                            <p></p>
                        </div>

                        <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Name<span class="req">*</span></label>
                                <input type="text"  value="{{ $jobs->company_name }}" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                <p></p>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="" class="mb-2">Location</label>
                                <input type="text" value="{{ $jobs->company_location }}" placeholder="Location" id="company_location" name="company_location" class="form-control">
                                <p></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="" class="mb-2">Website</label>
                            <input type="text" value="{{ $jobs->company_website }}" placeholder="Website" id="website" name="website" class="form-control">
                            <p></p>
                        </div>
                    </div> 
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Save Job</button>
                    </div>               
            </div>
        </form>
        </div>
    </div>
</section>

@endsection

@section('customJS')
<script type="text/javascript">




$("#postForm").submit(function (e) { 
    e.preventDefault();

    $.ajax({
    type: "post",
    url: "{{ route('account.SaveJob') }}",
    data: $("#postForm").serializeArray(),
    dataType: "json",
    success: function (response) {
        
    if(response.status == true)
      {

        $("#title").removeClass("is-invalid"); 
    $("#title").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#category").removeClass("is-invalid"); 
    $("#category").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#job_nature").removeClass("is-invalid"); 
    $("#job_nature").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#vacancy").removeClass("is-invalid"); 
    $("#vacancy").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#keywords").removeClass("is-invalid"); 
    $("#keywords").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#company_name").removeClass("is-invalid"); 
    $("#company_name").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#location").removeClass("is-invalid"); 
    $("#location").siblings('p').removeClass("invalid-feedback")
    .html("");




    window.location.href = "{{ route('account.MyJobs') }}";    
      
      }

    else
    {

        var error = response.errors;

/////////// title        
    if(error.title)
    {
        $("#title").addClass("is-invalid"); 
    $("#title").siblings('p').addClass("invalid-feedback")
    .html(error.title); 
    }      
    else
    {
        $("#title").removeClass("is-invalid"); 
    $("#title").siblings('p').removeClass("invalid-feedback")
    .html(""); 
    }

//////// category
    if(error.category)
    {
        $("#category").addClass("is-invalid"); 
    $("#category").siblings('p').addClass("invalid-feedback")
    .html(error.category); 
    }      
    else
    {
        $("#category").removeClass("is-invalid"); 
    $("#category").siblings('p').removeClass("invalid-feedback")
    .html("");
    }

//////// job_nature   
if(error.category)
    {
        $("#job_nature").addClass("is-invalid"); 
    $("#job_nature").siblings('p').addClass("invalid-feedback")
    .html(error.job_nature); 
    }      
    else
    {
        $("#job_nature").removeClass("is-invalid"); 
    $("#job_nature").siblings('p').removeClass("invalid-feedback")
    .html("");
    }

////////// vacancy  
if(error.vacancy)
    {
        $("#vacancy").addClass("is-invalid"); 
    $("#vacancy").siblings('p').addClass("invalid-feedback")
    .html(error.vacancy); 
    }      
    else
    {
        $("#vacancy").removeClass("is-invalid"); 
    $("#vacancy").siblings('p').removeClass("invalid-feedback")
    .html("");
    } 
 
/////////// location
if(error.location)
    {
        $("#location").addClass("is-invalid"); 
    $("#location").siblings('p').addClass("invalid-feedback")
    .html(error.location); 
    }      
    else
    {
        $("#location").removeClass("is-invalid"); 
    $("#location").siblings('p').removeClass("invalid-feedback")
    .html("");
    } 

/////////// keywords

if(error.keywords)
    {
        $("#keywords").addClass("is-invalid"); 
    $("#keywords").siblings('p').addClass("invalid-feedback")
    .html(error.keywords); 
    }      
    else
    {
        $("#keywords").removeClass("is-invalid"); 
    $("#keywords").siblings('p').removeClass("invalid-feedback")
    .html("");
    } 

////////////// company_name
if(error.company_name)
    {
        $("#company_name").addClass("is-invalid"); 
    $("#company_name").siblings('p').addClass("invalid-feedback")
    .html(error.company_name); 
    }      
    else
    {
        $("#company_name").removeClass("is-invalid"); 
    $("#company_name").siblings('p').removeClass("invalid-feedback")
    .html("");
    } 


    }  
    
    

}
   
});

});	

</script>

@endsection