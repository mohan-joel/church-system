@extends('user.layouts.app')
@section('content')

<!-- Button trigger modal to add fellowship-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFellowshipsModal">
  Add Fellowships
</button>
<a href="{{ route('fellowshipPrintPreview') }}" class="btn btn-warning text-dark">Print Preview</a>


<!-- modal for adding fellowship -->
<div class="modal fade" id="addFellowshipsModal" tabindex="-1" role="dialog" aria-labelledby="addFellowshipsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fellowship</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/add-fellowships') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="fellowshipName">Fellowship Name:</label>
                <input type="text" name="fellowship_name" class="form-control" placeholder="Enter Fellowship Name" >
                <span class="text-danger">
                    @error('fellowship_name')
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
            <form class="d-flex h-100" action="{{ route('searchFellowship') }}" method="get">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search Fellowship" name="fellowships">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>


<!-- modal for editing fellowship -->
<div class="modal fade" id="editFellowshipModal" tabindex="-1" role="dialog" aria-labelledby="editFellowshipModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Fellowship</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/update-fellowships') }}" method="post">
        <input type="hidden" id="fellowship_id" name="fellowship_id">
        @csrf
        @method('put')
        <div class="modal-body">
            <div class="form-group">
                <label for="fellowshipName">Fellowship Name:</label>
                <input type="text" name="fellowship_name" class="form-control" id="fellowship_name">
                <span class="text-danger">
                    @error('fellowship_name')
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($fellowships) >  0)
                        @foreach($fellowships as $fellowship)
                        <tr>
                                <td>{{ $a++ }}</td>
                                <td>{{ $fellowship->fellowship_name }}</td>
                                <td><a href="{{ url('/delete-fellowship/'.$fellowship->id ) }}" class="btn btn-sm btn-danger">Delete</a><button type="button" class="btn btn-sm btn-success editFellowship" data-bs-toggle="modal" data-bs-target="#editFellowshipModal" data-id="{{ $fellowship->id }}" data-fellowship="{{ $fellowship->fellowship_name }}">Edit</button></td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-danger text-center">No Fellowships Added Till Now</td>
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
        $(".editFellowship").click(function(){
            var fellowship_id = $(this).attr("data-id");
            var fellowship_name = $(this).attr("data-fellowship");
            $("#fellowship_id").val(fellowship_id);
            $("#fellowship_name").val(fellowship_name);
        });
    });
</script>


@endsection