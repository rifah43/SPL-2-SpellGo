<p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>
<form action="{{ route('evaluate') }}" method="POST" name="quiz">
    @csrf
    <div id="timer">Time left: 00:00</div> <!-- display the timer -->
    @php $cnt=1; @endphp
    @foreach($questions as $question)
    <h3>{{$cnt++}}. {{ $question->question }}</h3>
        <ol>
            @if($question->answer !== null && $question->answer->count() > 0)
                @foreach($question['answer'] as $answer)
                    <li>
                        <label>
                            <input type="radio" name="answer_{{ $question->id }}" value="{{ $answer->id }}">
                            {{ $answer->answer }}
                        </label>
                    </li>
                @endforeach
            @else
                <p>No answers found for this question.</p>
            @endif
        </ol>
        <input type="hidden" name="questions[]" value="{{ $question->id }}">
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
            document.getElementById("time").value = 300; // set the time to 5 minutes when the time is up
            document.quiz.submit();
        }
    }

    var timerInterval = setInterval(updateTimer, 1000); // update the timer every second

    document.quiz.onsubmit = function() {
        clearInterval(timerInterval);
        document.getElementById("time").value = 300 - timeLeft; // send the required time
        return true;
    };
</script>