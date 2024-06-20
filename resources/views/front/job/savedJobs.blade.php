@extends('front.layouts.app')

@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Saved Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
   
        <div class="row">
           
            @include('front.layouts.sidebar')

            <div class="col-lg-9">

                @if(Session::has('remove'))
                <div class="alert alert-success">
                    <strong>Success!</strong> <p>{{Session::get('remove') }}</p> 
                  </div>
                @endif
              
            <div class="card border-0 shadow mb-4 p-3">
                   

                    <div class="card-body card-form">
                        @if($collection->isNotEmpty())
                        <h3 class="fs-4 mb-1">Saved Jobs</h3>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                               
                                        
                                    @foreach ($collection as $item)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $item->job->title }}</div>
                                            <div class="info1">{{ $item->job->job_type->name }} . {{ $item->job->location }}</div>
                                        </td>
                                        <td>05 Jun, 2023</td>
                                        <td>130 Applications</td>
                                        <td>
                                            <div class="job-status text-capitalize">active</div>
                                        </td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('jobDetail',$item->job_id)  }}" > <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <li><a class="dropdown-item" onclick="getJobSavedId({{ $item->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>  
                                    @endforeach    
                                @else
                               
                                <p style="text-align:center; font-size:22px;">
                                You haven't save any jobs yet.</p>
                                
                               @endif
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

</section>



@endsection

@section('customJS')
<script type="text/javascript">

function getJobSavedId(id)
{

    if (confirm("Are you sure you want to remove?")) {
$.ajax({
    type: "post",
    url: '{{ route('account.delSavedJob') }}',
    data: {id: id},
    dataType: "json",
    success: function (response) {
    
if(response.status)
window.location.href= "{{ route('account.savedJobs') }}";                

    }

});

    }

}

</script>
@endsection