@extends('user.layouts.app')
@section('content')
<!-- Button trigger modal to add notice-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpenditureModal">
  Add Expenditure
</button>
<a href="{{ route('expenditurePrintPreview') }}" class="btn btn-warning text-dark">Print Preview</a>

<!-- modal for adding notice -->
<div class="modal fade" id="addExpenditureModal" tabindex="-1" role="dialog" aria-labelledby="addExpenditureModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expenditure</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('addExpenditure') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" id="date">
                <span class="text-danger">
                    @error('date')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title">
                <span class="text-danger">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" name="amount" class="form-control" id="amount">
                <span class="text-danger">
                    @error('amount')
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
            <form class="d-flex h-100" action="{{ route('searchExpenditure') }}" method="get">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search Expenditure By Title" name="expenditures">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>


<!-- modal for editing notice -->
<div class="modal fade" id="editExpenditureModal" tabindex="-1" role="dialog" aria-labelledby="editExpenditureModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExpenditureModalLabel">Edit Expenditure</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('updateExpenditure') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" id="expenditure_id" name="expenditure_id" class="expenditure_id">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" id="editDate">
                <span class="text-danger">
                    @error('date')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="editTitle">
                <span class="text-danger">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" name="amount" class="form-control" id="editAmount">
                <span class="text-danger">
                    @error('amount')
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
<!-- code to show notices list in table -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if(count($expenditures) > 0)
                    @foreach($expenditures as $expenditure)
                    <tr>
                        <td>{{ $p++ }}</td>
                        <td>{{ $expenditure->date }}</td>
                        <td>{{ $expenditure->title }}</td>
                        <td>{{ $expenditure->amount }}</td>
                        <td><a href="{{ url('/delete-expenditure/'.$expenditure->id )}}" class="btn btn-danger">Delete</a><button type="button" class="btn btn-success editExpenditure" data-bs-toggle="modal" data-bs-target="#editExpenditureModal" data-id="{{ $expenditure->id }}">Edit</button></td>
                    </tr>
                    @endforeach
                  @else
                    <tr> 
                        <td colspan="5" class="text-danger text-center" >No Expenditure Added till now</td>
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
        $(".editExpenditure").click(function(){
            var expenditure_id = $(this).attr("data-id");
            var url = "{{ route("getExpenditureDetail","id") }}";
            url = url.replace("id",expenditure_id);
            $.ajax({
                url: url,
                type:"get",
                data:{id:expenditure_id},
                success: function(response){
                   var details = response.data;
                   $("#expenditure_id").val(details['id']);
                   $("#editDate").val(details['date']);
                   $("#editTitle").val(details['title']);
                   $("#editAmount").val(details['amount']);
                }
            });
        });
    });
</script>
@endsection