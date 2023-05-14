<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('quiz/sheet1.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('quiz/sheet2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <title>Add Question</title>
</head>
<body>
<div class="container-xl col-sm-12">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-2"><h2>Questions <b></b></h2></div>
                    <div class="col-sm-7"><a href="{{url('/add')}}"><button class="btn btn-primary">Add</button></a></div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-1">No.</th>
                        <th class="col-sm-9">Question</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($question)>0)
                        @foreach($question as $i=>$ques)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$ques->question}}</td>
                                <td><button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-id="{{$ques->id}}">Delete</button></td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="3">
                            Questions and Answers are not set
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div>
            <a href="{{url('/dashboard')}}"><button class="btn btn-primary">Return to Dashboard</button></a>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Delete Question</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteForm">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id" id="deleteId">
            <span>Are you sure you want to delete?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.delete').on('click', function() {
                var id = $(this).data('id');
                $('#deleteId').val(id);
                console.log(id);
            });

            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{route('delete')}}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success == true) {
                            window.location = "/add-question";
                        } else {
                        alert(data.msg);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
