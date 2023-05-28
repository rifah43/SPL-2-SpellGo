<style>
    p {
        color: green;
    }
    #summary td,
    #summary th {
        padding: 8px;
        text-align: center;
    }
    #summary th {
        background-color: #4b0163;
        color: #faf7e3;
        font-weight: bold;
    }
    #summary {
        margin: 0 auto;
        width: 50%;
        border-collapse: separate;
    }
    .left {
        margin-left: 10px;
    }
    .right {
        margin-right: 10px;
    }
    h1 {
        text-align: center;
    }
    button {
        height: 50px;
        width: 140px;
        background-color: #4b0163;
    }
    a {
        color: #faf7e3;
    }

    .button-container {
        margin: 100 auto;
        width: 70%;
        display: flex;
        justify-content: space-between;
    }
</style>

<br><br>
<h1>Your Quiz Result</h1><br><br>
<table id="summary">
    <tr>
        <th>Score</th>
        <td>{{ $data['score'] }}</td>
    </tr>
    <tr>
        <th>Number of Correct Answers</th>
        <td>{{ $data['correct'] }}</td>
    </tr>
    <tr>
        <th>Number of Incorrect Answers</th>
        <td>{{ $data['incorrect'] }}</td>
    </tr>
</table>
<br>
<p class="button-container">
    <button><a class="left" href="{{ route('perform-quiz') }}">Take another quiz</a></button>
    <button><a class="right" href="{{ route('dashboard') }}">Back to Dashboard</a></button>
</p>

