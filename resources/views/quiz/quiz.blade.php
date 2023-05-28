<style>
  body {
    text-align: center;
    background-image: url("qbg.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: repeat;
  }
  h3 {
    margin-bottom: 10px;
    font-size: 24px; 
  }
  ol {
    text-align: left;
    margin-bottom: 20px;
    margin-left: 20px;
  }
  li {
    margin-bottom: 10px;
    font-size: 18px; 
    font-weight: bold;
  }
  #timer {
    text-align: center;
    color: #4d0357;
    border: 2px solid #4CAF50;
    background-color: #ffffcc;
    padding: 10px;
    margin-bottom: 20px;
    font-weight: bold;
    width: 10%;
    font-size: 20px; 
  }
  button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 20px; 
    margin-top: 20px;
  }
  .question {
    margin-bottom: 40px;
    border-bottom: 3px solid orangered;
    padding-bottom: 20px;
    text-align: center;
  }
  .back-link {
    margin-top: 20px;
    color: palevioletred;
    font-size: 20px; 
    text-align: left;
  }
</style>

<div class="back-link">
  <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</div><br>
<form action="{{ route('evaluate') }}" method="POST" name="quiz">
  @csrf
  <div id="timer">Time left: 00:00</div> <!-- display the timer -->
  @php $cnt=1; @endphp
  @foreach($questions as $question)
  <div class="question">
    <h3>{{$cnt++}}. {{ $question->question }}</h3>
    <ol>
      @if($question->answer !== null && $question->answer->count() > 0)
        @foreach($question['answer'] as $answer)
          <li>
              <input type="radio" name="answer_{{ $question->id }}" value="{{ $answer->id }}">
              {{ $answer->answer }}
          </li>
        @endforeach
      @else
        <p>No answers found for this question.</p>
      @endif
    </ol>
    <input type="hidden" name="questions[]" value="{{ $question->id }}">
  </div>
  @endforeach
  <input type="hidden" name="time" id="time" value="">
  <button type="submit">Submit</button>
</form>
<script>
  var timeLeft = 300; // set the time limit to 5 minutes (300 seconds)

  function formatTime(time) {
    var minutes = Math.floor(time / 60);
    var seconds = time % 60;
    return ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2);
  }

  function updateTimer() {
    var timerDiv = document.getElementById("timer");
    timerDiv.innerHTML = "Time left: " + formatTime(timeLeft);
    timeLeft--;
    if (timeLeft < 0) {
      clearInterval(timerInterval);
      document.getElementById("time").value = 300; 
      document.quiz.submit();
    }
  }

  var timerInterval = setInterval(updateTimer, 1000); 

  document.quiz.onsubmit = function() {
    clearInterval(timerInterval);
    document.getElementById("time").value = 300 - timeLeft;
    return true;
  };
</script>
