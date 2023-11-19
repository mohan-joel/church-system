@extends('user.layouts.app')
@section('content')

<!-- Button trigger modal to add notice-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoticesModal">
  Add Notices
</button>
<a href="{{ route('noticePrintPreview') }}" class="btn btn-warning text-dark">Print Preview</a>


<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="search-field d-none d-md-block">
            <form class="d-flex h-100" action="{{ route('searchNotice') }}" method="get">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search Notice By Date" name="notices">
              </div>
            </form>
          </div>
        </div>
    </div>
</div>

<!-- modal for adding notice -->
<div class="modal fade" id="addNoticesModal" tabindex="-1" role="dialog" aria-labelledby="addNoticesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fellowship</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('addNotices') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="fellowshipName">Fellowship Name:</label>
                <select name="fellowship" id="fellowship" class="form-control">
                    <option value="">---Select Fellowship---</option>
                    @foreach($fellowships as $fellowship)
                    <option value="{{ $fellowship->fellowship_name }}">{{ $fellowship->fellowship_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('fellowship_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="vanue">Vanue</label>
                <input type="text" class="form-control" id="vanue" name="vanue" placeholder="Enter Vanue ">
                <span class="text-danger">
                    @error('vaue')
                        {{ $message }}
                    @enderror
                </span>
            </div>
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
                <label for="leadBy">Lead By:</label>
                <select name="leadBy" id="" class="form-control">
                    <option value="">---Select Lead By---</option>
                    @foreach($leaders as $lead)
                    <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('leadBy')
                        {{ $message }}
                    @enderror
                </span>
        </div>
        <div class="form-group">
                <label for="sermonBy">Sermon By:</label>
                <select name="sermonBy" id="" class="form-control">
                    <option value="">---Select Lead By---</option>
                    @foreach($preachers as $preach)
                    <option value="{{ $preach->id }}">{{ $preach->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('leadBy')
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

<!-- modal for editing Notice -->
<div class="modal fade" id="editNoticeModal" tabindex="-1" role="dialog" aria-labelledby="editNoticeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Notice</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('updateNotice') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="notice_id" name="notice_id">
        <div class="modal-body">
            <div class="form-group">
                <label for="fellowshipName">Fellowship Name:</label>
                <select name="fellowship" id="editFellowship" class="form-control">
                    <option value="">---Select Fellowship---</option>
                    @foreach($fellowships as $fellowship)
                    <option value="{{ $fellowship->fellowship_name }}">{{ $fellowship->fellowship_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('fellowship_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="vanue">Vanue</label>
                <input type="text" class="form-control" id="editVanue" name="vanue">
                <span class="text-danger">
                    @error('vaue')
                        {{ $message }}
                    @enderror
                </span>
            </div>
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
                <label for="leadBy">Lead By:</label>
                <select name="leadBy" id="editLeadBy" class="form-control">
                    <option value="">---Select Lead By---</option>
                    @foreach($leaders as $lead)
                    <option value="{{ $lead->id }}">{{ $lead->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('leadBy')
                        {{ $message }}
                    @enderror
                </span>
        </div>
        <div class="form-group">
                <label for="sermonBy">Sermon By:</label>
                <select name="sermonBy" id="editSermonBy" class="form-control">
                    <option value="">---Select Lead By---</option>
                    @foreach($preachers as $preach)
                    <option value="{{ $preach->id }}">{{ $preach->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('leadBy')
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
                        <th>Fellowship Name</th>
                        <th>Date</th>
                        <th>Lead By</th>
                        <th>Sermon By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($notices) > 0)
                    @foreach($notices as $notice)
                        <tr>
                            <td>{{ $c++ }}</td>
                            <td>{{ $notice->fellowship }}</td>
                            <td>{{ $notice->date }}</td>
                            <td>{{ $notice->lead->name }}</td>
                            <td>{{ $notice->sermon->name }}</td>
                            <td><a href="{{ url('/delete-notice/'.$notice->id ) }}" class="btn btn-danger">Delete</a><button type="button" class="btn btn-success editNotice" data-bs-toggle="modal" data-bs-target="#editNoticeModal" data-id="{{ $notice->id }}">Edit</button><a href="{{ url('/show-print-preview/'.$notice->lead_id.'/'.$notice->sermon_id ) }}" class="btn btn-warning text-dark">Print Preview</a></td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-danger text-center">No Notices Added Till Now</td>
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
        $(".editNotice").click(function(){
            var notice_id = $(this).attr("data-id");
            var url = "{{ route("getNoticeDetail","id") }}";
            url = url.replace('id',notice_id);
            $.ajax({
                url:url,
                type: "get",
                data: {id:notice_id},
                success: function(data){
                    console.log(data.data[0]);
                    var notice = data.data[0];
                    $("#editFellowship").val(notice['fellowship']);
                    $("#editDate").val(notice['date']);
                    $("#notice_id").val(notice['id']);
                    $("#editVanue").val(notice['vanue']);
                }
            });
        });
    });
</script>

@endsection