<!DOCTYPE html>
<html>
<head>
    <title>Game World</title>
    <style>
        body{
            background-color: #1d1f1e;
        }
        .button-container {
        margin: auto;
        display: flex;
        }
        button{
            background-color: whitesmoke;
            height: 35px;
        }
        a{
            color: black;
        }
    </style>
</head>
<body>
    <p class="button-container">
        <button><a class="right" href="{{ route('dashboard') }}">Back to Dashboard</a></button>
    </p>
    <iframe src="{{ asset('game/index.html') }}" width="100%" height="650"></iframe>
</body>
</html>
