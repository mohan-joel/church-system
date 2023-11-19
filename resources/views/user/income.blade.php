@extends('user.layouts.app')
@section('content')
<!-- Button trigger modal to add income-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
  Add Income
</button>
<a href="{{ route('incomePrintPreview') }}" class="btn btn-warning text-dark">Print Preview</a>


<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="search-field d-none d-md-block">
            <form class="d-flex h-100" action="{{ route('searchIncome') }}" method="get">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search Income By Title" name="incomes">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>


<!-- modal for adding notice -->
<div class="modal fade" id="addIncomeModal" tabindex="-1" role="dialog" aria-labelledby="addIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Income</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('addIncome') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" id="income_id" name="income_id">
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


<!-- modal for editing income -->
<div class="modal fade" id="editIncomeModal" tabindex="-1" role="dialog" aria-labelledby="editIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Income</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('updateIncome') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="income_id" name="income_id" class="income_id">
        <div class="modal-body">
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
                   @if(count($incomes) > 0)
                    @foreach($incomes as $income)
                    <tr>
                        <td>{{ $p++ }}</td>
                        <td>{{ $income->date }}</td>
                        <td>{{ $income->title }}</td>
                        <td>{{ $income->amount }}</td>
                        <td><a href="{{ url('/delete-income/'.$income->id )}}" class="btn btn-danger">Delete</a><button type="button" class="btn btn-success editIncome" data-id="{{ $income->id }}" data-bs-toggle="modal" data-bs-target="#editIncomeModal">Edit</button></td>
                    </tr>
                    @endforeach
                   @else
                     <tr>
                        <td colspan="5" class="text-danger text-center">No Incomes Added Till Now</td>
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
        $(".editIncome").click(function(){
            var income_id = $(this).attr("data-id");
            var url = "{{ route("getIncomeDetail","id") }}";
            url = url.replace("id",income_id);
            $.ajax({
                url: url,
                type:"get",
                data:{id:income_id},
                success: function(response){
                    $(".income_id").val(response.data[0]['id']);
                    $("#editDate").val(response.data[0]['date']);
                    $("#editTitle").val(response.data[0]['title']);
                    $("#editAmount").val(response.data[0]['amount']);
                }

            });
        });
    });
</script>

@endsection