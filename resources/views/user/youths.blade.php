@extends('user.layouts.app')
@section('content')

<!-- Button trigger modal for adding youths-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addYouthsModal">
  Add Youths 
</button>
<a href="{{ route('youthPrintPreview') }}" class="btn btn-warning text-dark">Print Preview</a>

<!-- Modal to insert youths detail -->
<div class="modal fade" id="addYouthsModal" tabindex="-1" role="dialog" aria-labelledby="addYouthsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Youth</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('addYouths') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="youthName">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Youth's Name" value="{{ old('name') }}">
                <span>
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthGender">Gender:</label>
                <select name="gender" id="" class="form-control" value="{{ old('gender') }}">
                    <option value="">---Select Gender---</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span>
                    @error('gender')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthAddress">Address:</label>
                <input type="text" name="address" class="form-control" placeholder="Enter Youth's Address" value="{{ old('address') }}">
                <span>
                    @error('address')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthContact">Contact:</label>
                <input type="text" name="contact" class="form-control" placeholder="Enter Youth's Contact" value="{{ old('contact') }}">
                <span>
                    @error('contact')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthEmail">Email:</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Youth's Email" value="{{ old('email') }}">
                <span>
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthDOB">DOB:</label>
                <input type="date" name="dob" class="form-control" placeholder="Enter Youth's DOB" value="{{ old('dob') }}">
                <span>
                    @error('dob')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthJobStudy">Job/Study:</label>
                <input type="text" name="jobStudy" class="form-control" placeholder="Enter Youth's Job/Study" value="{{ old('jobStudy') }}">
                <span>
                    @error('jobStudy')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthPhoto">Photo:</label>
                <input type="file" name="photo" class="form-control" value="{{ old('photo') }}">
                <span>
                    @error('photo')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </div>
      </form>
  </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="search-field d-none d-md-block">
            <form class="d-flex h-100" action="{{ route('searchYouth') }}" method="get">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search youths" name="youths">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<!-- Modal to edit youths detail -->
<div class="modal fade" id="youthEditModal" tabindex="-1" role="dialog" aria-labelledby="youthEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Youth's Detail</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('updateYouth') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="youth_id" id="youth_id">
        <div class="modal-body">
            <div class="form-group">
                <label for="youthName">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Youth's Name"  id="name">
                <span>
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthGender">Gender:</label>
                <select name="gender" id="" class="form-control"  id="gender">
                    <option value="">---Select Gender---</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span>
                    @error('gender')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthAddress">Address:</label>
                <input type="text" name="address" class="form-control" placeholder="Enter Youth's Address"  id="address">
                <span>
                    @error('address')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthContact">Contact:</label>
                <input type="text" name="contact" class="form-control" placeholder="Enter Youth's Contact"  id="contact">
                <span>
                    @error('contact')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthEmail">Email:</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Youth's Email"  id="email">
                <span>
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthDOB">DOB:</label>
                <input type="date" name="dob" class="form-control" placeholder="Enter Youth's DOB" id="dob">
                <span>
                    @error('dob')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthJobStudy">Job/Study:</label>
                <input type="text" name="jobStudy" class="form-control" placeholder="Enter Youth's Job/Study" id="jobStudy">
                <span>
                    @error('jobStudy')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="youthPhoto">Photo:</label>
                <input type="file" name="photo" class="form-control" id="photo">
                <span>
                    @error('photo')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </div>
      </form>
  </div>
</div>


<br><br><br>
@if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show successMsg" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
<hr>
<!-- code to show youths list in table -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <table  class="table table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Job/Study</th>
                    <th>Photo</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @if(count($youths) >  0)
                   @foreach($youths as $youth)
                   <tr>
                        <td>{{ $a++ }}</td>
                        <td>{{ $youth->name }}</td>
                        <td>{{ $youth->gender }}</td>
                        <td>{{ $youth->address }}</td>
                        <td>{{ $youth->contact }}</td>
                        <td>{{ $youth->email }}</td>
                        <td>{{ $youth->dob }}</td>
                        <td>{{ $youth->jobStudy }}</td>
                        <td><img src="{{ asset('storage/photos/'.$youth->photo )}}" alt="" height="100px" width="100px" ></td>
                        <td><a href="{{ url('/delete-youth/'.$youth->id ) }}" class="btn btn-sm btn-danger">Delete</a><button type="button"  class="btn btn-sm btn-success editYouth" data-bs-toggle="modal" data-bs-target="#youthEditModal" data-id="{{ $youth->id }}">Edit</button></td>
                   </tr>
                   @endforeach
                   @else
                     <tr>
                        <td colspan="10" class="text-danger text-center">No Youths Added Till Now</td>
                     </tr>
                   @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".editYouth").click(function(){
            var youth_id = $(this).attr("data-id");
            var url = "{{ route("getYouthDetail","id") }}";
            url = url.replace('id',youth_id);
            $.ajax({
                url: url,
                type: "get",
                data:{id:youth_id},
                success: function(data){
                    var youth = data.response;
                    console.log(youth);
                    $("#name").val(youth[0].name);
                    $("#address").val(youth[0].address);
                    $("#contact").val(youth[0].contact);
                    $("#email").val(youth[0].email);
                    $("#dob").val(youth[0].dob);
                    $("#jobStudy").val(youth[0].jobStudy);
                    $("#youth_id").val(youth[0].id);
                }
            });
        });
    });

</script>

@endsection