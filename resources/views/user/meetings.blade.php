@extends('user.layouts.app')
@section('content')

<!-- Button trigger modal to add notice-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMeetingsModal">
  Add Meetings
</button>

<br>
@if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show successMsg" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<!-- modal to add meetings -->
<div class="modal fade" id="addMeetingsModal" tabindex="-1" role="dialog" aria-labelledby="addMeetingsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Meetings</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('add-meetings') }}" method="post" >
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label >Date:</label>
                <input type="date" name="date" class="form-control" id="date">
                <span class="text-danger">
                    @error('date')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <button type="button" id="agendaBtn" class="btn-sm btn-light">Click here for adding agenda</button>
                <span id="InputAgenda"></span>
                
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                <span class="text-danger">
                    @error('description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
        </div>
        <div class="form-group">
            <button type="button" id="decisionBtn" class="btn-sm btn-light">Click here for adding decisions</button>
            <span id="InputDecision"></span>
            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <button type="button" class="btn btn-light btn-sm attendees">Click to Add Attendees Name</button>
                </div>
            </div>
            <div class="row">
                <span id="attendeesInputContainer"></span>
            </div>
           
        </div>
        <div class="modal-footer">
            <span id="msg" class="text-danger"></span>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
            
        </div>
        </div>
      </form>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var inputCounter = 0;
        var decisionInputCounter = 0;
        var attendeesCounter =  0;
        $("#agendaBtn").on("click",function(){
            inputCounter++;
            var newInput = $('<input>',{
                type:'text',
                name:'agendas['+inputCounter+'][description]',
                id:'agenda',
                class:'form-control countAgenda',
                placeholder:'Agenda'+inputCounter
            });

            $("#InputAgenda").append(newInput);
        });

        $("#decisionBtn").on("click",function(){
            var num_agenda = $(".countAgenda").length;
            var num_decision = $(".countDecision").length;
            if(num_decision >= num_agenda)
            {
                $("#msg").text("You have only " +num_agenda+ " agendas");
                setTimout(function(){
                    $("#msg").text("");
                },2000)
               
            }
            else
            {
                decisionInputCounter++;
                var newdecisionInput = $('<input>',{
                    type:'text',
                    name:'decisions['+decisionInputCounter+'][description]',
                    id:'decision',
                    class:'form-control countDecision',
                    placeholder:'Decision'+decisionInputCounter
                });
                $("#InputDecision").append(newdecisionInput);
            }
        });

        $(".attendees").click(function(){
            attendeesCounter++;
                var attendeesInput = $('<input>',{
                    type:'text',
                    name:'attendees['+attendeesCounter+'][name]',
                    class:'form-control',
                    placeholder:'Attendees'+attendeesCounter
                });
            $("#attendeesInputContainer").append(attendeesInput);
        });
    });

</script>

@endsection