@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
      
        <div class="row">
           
         @include('front.layouts.sidebar')

      
        <div class="col-lg-9">
                @if(Session::has('updateMsg'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> <p>{{Session::get('updateMsg') }}</p> 
                      </div>
                    @endif 

                    <div class="col-lg-9">
                        @if(Session::has('img_upload'))
                            <div class="alert alert-success">
                                <strong>Success!</strong> <p>{{Session::get('img_upload') }}</p> 
                              </div>
                            @endif                     
                       

                <div class="card border-0 shadow mb-4">
                    <form name="updateForm" id="updateForm">        
                   @csrf
                        <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                         
                        <div class="mb-4">
                    
                        <label for="" class="mb-2">Name*</label>
                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $data->name }}">
                        <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $data->email }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation (Optional)</label>
                            <input type="text" name="designation" placeholder="Designation" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile (Optional)</label>
                            <input type="text" name="mobile" placeholder="Mobile" class="form-control">
                        </div>                        
                    </div>
                
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                
            </div>
            

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>


@endsection

@section('customJS')
<script type="text/javascript">




$("#updateForm").submit(function (e) { 
    e.preventDefault();

$.ajax({
    type: "post",
    url: "{{ route('account.update') }}",
    data: $("#updateForm").serializeArray(),
    dataType: "json",
    success: function (response) {
        
    if(response.status == true)
      {
      
    $("#name").removeClass("is-invalid"); 
    $("#name").siblings('p').removeClass("invalid-feedback")
    .html("");

    $("#email").removeClass("is-invalid"); 
    $("#email").siblings('p').removeClass("invalid-feedback")
    .html("");
        
    
    window.location.href = "{{ route('account.profile') }}";    

      }

    else
    {
var error = response.errors;
    if(error.name)
    {
        $("#name").addClass("is-invalid"); 
    $("#name").siblings('p').addClass("invalid-feedback")
    .html(error.name);

    }
else
{
    $("#name").removeClass("is-invalid"); 
    $("#name").siblings('p').removeClass("invalid-feedback")
    .html("");


}

    if(error.email)
    {
        $("#email").addClass("is-invalid"); 
    $("#email").siblings('p').addClass("invalid-feedback")
    .html(error.email);

    }

else
{

    $("#email").removeClass("is-invalid"); 
    $("#email").siblings('p').removeClass("invalid-feedback")
    .html("");


}

    }  

    }
});

    
});



	
</script>
	
@endsection

