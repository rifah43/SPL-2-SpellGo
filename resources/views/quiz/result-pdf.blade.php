<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz Result</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid black;
        }
        table td, table th {
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #002173;
            color: #faf7e3;
            font-weight: bold;
            text-align: center;
            width: 20%;
        }
        #summary td, #summary th {
            padding: 8px;
            text-align: center;
        }
        #summary th {
            background-color: #4b0163;
            margin-bottom: 1px solid #faf7e3;
            color: #faf7e3;
            font-weight: bold;
            text-align: center;
            width: 30%;
        }
        #summary{
            border-collapse:separate;
        }
    </style>
</head>
<body>
    <h2>Quiz Result</h2>

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
    </table><br>

    <table>
        <tr>
            <th>Question No.</th>
            <th>Question</th>
            <th>Selected Answer</th>
            <th>Correct Answer</th>
            <th>Status</th>
        </tr>
        @php $cnt=1; @endphp
        @foreach($results as $question)
            <tr>
                <td>{{ $cnt++ }}</td>
                <td>{{ $question['question'] }}</td>
                <td>{{ $question['selected_answer'] }}</td>
                <td>{{ $question['correct_answer_text'] }}</td>
                <td>{{ $question['correct_answer'] }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
