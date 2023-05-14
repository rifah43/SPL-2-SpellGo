<h1>Your Quiz Result</h1>
    <p>You scored {{ $data['score'] }}</p><br>
    <p>Correct Answer: {{$data['correct']}} and Wrong Answer: {{$data['incorrect']}}</p><br>
    <p><a href="{{ route('perform-quiz') }}">Take another quiz</a></p>
    <p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>